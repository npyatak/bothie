<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\imagine\Image;

use backend\models\IgParseData;
use common\models\User;
use common\models\Week;
use common\models\Post;

class ParserController extends Controller {

	public function actionData($hashtag = 'fridaytvnight') {
        $baseUrl = "https://www.instagram.com/explore/tags/$hashtag/?__a=1";
        $url = $baseUrl;
        $igParseDataIds = IgParseData::find()->select('ig_post_id')->asArray()->column();
        //print_r($igParseDataIds);exit;
        //print_r(htmlentities('#sd'));
        //exit;

        while(1) {
            $page = 1;
            $json = json_decode(file_get_contents($url));
            // echo '<pre>';
            // print_r($json->tag->media->nodes);
            // echo '</pre>';
            // echo '<br>';
            // echo 'page = '.$page;
            $page++;
            foreach ($json->tag->media->nodes as $node) {
                if(!in_array($node->id, $igParseDataIds)) {
                    $parseData = new IgParseData;
                    $parseData->ig_post_id = $node->id;
                    $parseData->ig_user_id = $node->owner->id;
                    //$parseData->ig_caption = htmlentities($node->caption);
                    $parseData->image = $node->display_src;
                    $parseData->status = IgParseData::STATUS_PENDING;

                    $parseData->save();
                }
            }
            if(!$json->tag->media->page_info->has_next_page) break;
            $url = $baseUrl.'&max_id='.$json->tag->media->page_info->end_cursor;
        }
	}

	public function actionImages() {
		$parseData = IgParseData::find()->where(['status' => IgParseData::STATUS_PENDING])->limit(10)->all();
        $userIgIds = User::find()->select('ig_id')->asArray()->column();
        
        foreach ($parseData as $data) {
            if(!in_array($data->ig_user_id, $userIgIds)) {
                $user = new User;
                $user->ig_id = $data->ig_user_id;

                $user->save();
            } else {
                $user = User::find()->where(['ig_id' => $data->ig_user_id])->one();
            }

            $currentWeek = Week::getCurrent();

            $post = new Post();
            $post->scenario = 'parse';
            $post->user_id = $user->id;
            $post->is_from_ig = 1;
            $post->ig_parse_data_id = $data->id;
            $post->week_id = $currentWeek->id;

            if($post->save()) {
	            $path = $post->imageSrcPath;
	            if(!file_exists($path)) {
	                mkdir($path, 0775, true);
	            }
	            
	            $post->ig_image = md5('ig'.time()).'.jpg';
	            $fileName = $path.$post->ig_image;

	            $ch = curl_init($data->image);
	            $fp = fopen($fileName, 'wb');
	            curl_setopt($ch, CURLOPT_FILE, $fp);
	            curl_setopt($ch, CURLOPT_HEADER, 0);
	            curl_exec($ch);
	            curl_close($ch);
	            fclose($fp);
	            
				$fileWidth = getimagesize($fileName)[0];
				$fileHeight = getimagesize($fileName)[1];

				$newWidth = Yii::$app->params['postImageSize']['width'];
				$newHeight = Yii::$app->params['postImageSize']['height'];

				if($fileWidth > $fileHeight) {
					$newWidth = $newWidth * 2;
					$post->image_orientation = Post::IMAGE_HORIZONTAL;
                } elseif($fileWidth == $fileHeight) {
                    $post->image_orientation = Post::IMAGE_SQUARE;
				} else {
					$newHeight = $newHeight * 2;
					$post->image_orientation = Post::IMAGE_VERTICAL;
				}

				Image::thumbnail($fileName, $newWidth, $newHeight)->save($fileName);

				$post->save(false, ['ig_image', 'image_orientation']);

	            $data->status = IgParseData::STATUS_PROCESSED;
	            $data->save(false);
	        }

        }
	}
}