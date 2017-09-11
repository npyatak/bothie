<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\UploadedFile;
use frontend\widgets\cropimage\helpers\Image;
use yii\web\NotFoundHttpException;

use common\models\User;
use common\models\Post;
use common\models\PostAction;
use common\models\Week;
use common\models\IndexAdvice;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $currentWeek;

    public function behaviors()
    {
        return [
            'eauth' => [
                // required to disable csrf validation on OpenID requests
                'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                'only' => ['login'],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'participate', 'user-action'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'participate', 'user-action'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function init() {
        $this->currentWeek = Week::getCurrent();
    }

    public function actionIndex()
    {
        $posts = Post::find()->where(['week_id' => $this->currentWeek->id, 'status' => Post::STATUS_ACTIVE])->limit(12)->orderBy(new \yii\db\Expression('rand()'))->all();
        $indexAdvices = IndexAdvice::find()->where(['status' => IndexAdvice::STATUS_ACTIVE])->all();

        return $this->render('index', [
            'currentWeek' => $this->currentWeek,
            'posts' => $posts,
            'indexAdvices' => $indexAdvices,
        ]);
    }

    public function actionParticipate() {
        $model = new Post();

        if(!Yii::$app->user->isGuest && $model->load(Yii::$app->request->post())) {
            $model->is_from_ig = 0;
            $model->user_id = Yii::$app->user->id;
            $model->week_id = Week::getCurrent();

            $model->frontImageFile = UploadedFile::getInstance($model, 'frontImageFile');
            $model->backImageFile = UploadedFile::getInstance($model, 'backImageFile');

            $model->front_image = md5('front'.time()).'.'.$model->frontImageFile->extension;;
            $model->back_image = md5('back'.time()).'.'.$model->backImageFile->extension;;

            if($model->save()) {
                $path = $model->imageSrcPath;
                if(!file_exists($path)) {
                    mkdir($path, 0775, true);
                }
                $model->frontImageFile->saveAs($path.$model->front_image);
                $model->backImageFile->saveAs($path.$model->back_image);
                
                Image::cropImageSection($path.$model->front_image, $path.$model->front_image, [
                    'width' => $model->front_w,
                    'height' => $model->front_h,
                    'y' => $model->front_y,
                    'x' => $model->front_x,
                    'scale' => $model->front_scale,
                    'angle' => $model->front_angle,
                ]);
                Image::cropImageSection($path.$model->back_image, $path.$model->back_image, [
                    'width' => $model->back_w,
                    'height' => $model->back_h,
                    'y' => $model->back_y,
                    'x' => $model->back_x,
                    'scale' => $model->back_scale,
                    'angle' => $model->back_angle,
                ]);

                return $this->redirect(['participate']);
            }
        } 

        return $this->render('participate', [
            'weeks' => Week::find()->all(),
            'model' => $model,
        ]);
    }

    public  function actionImage($id){
        $post = $this->findPost($id);

        if($post->is_from_ig) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $x = getimagesize($post->frontImageUrl)[0];
        $y = getimagesize($post->frontImageUrl)[1];

        $outputImage = imagecreatetruecolor($x*2, $y);

        $frontImage = imagecreatefromjpeg($post->frontImageUrl);
        $backImage = imagecreatefromjpeg($post->backImageUrl);

        imagecopymerge($outputImage, $frontImage, 0, 0, 0, 0, $x, $y, 100);
        imagecopymerge($outputImage, $backImage, $x, 0, 0, 0, $x, $y, 100);

        header('Content-type: image/jpeg');
        imagejpeg($outputImage);

        imagedestroy($outputImage);
        imagedestroy($frontImage);
        imagedestroy($backImage);
    }

    public function actionVote() {
        $limit = 12;
        $count = Post::find()->where(['week_id' => $this->currentWeek->id, 'status' => Post::STATUS_ACTIVE])->count();

        $query = Post::find()
            ->where(['week_id' => $this->currentWeek->id, 'status' => Post::STATUS_ACTIVE])
            ->limit($limit)
            ->orderBy(new \yii\db\Expression('rand()'));

        if (Yii::$app->request->isAjax && isset($_GET['ids'])) {
            $posts = $query->andWhere(['not in', 'id', $_GET['ids']])->all();

            return $this->renderPartial('_bothie_blocks', [
                'posts' => $posts,
                'noMorePosts' => $count + count($_GET['ids']) >= $limit ? false : true,
            ]);
        }

        $posts = $query->all();
        $noMorePosts = $count >= $limit ? false : true;

        return $this->render('vote', [
            'posts' => $posts,
            'noMorePosts' => $noMorePosts,
        ]);
    }

    public function actionUserAction($id, $type=null) {        
        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            switch ($type) {
                case 'vk':
                    $type = PostAction::TYPE_SHARE_VK;
                    break;
                case 'fb':
                    $type = PostAction::TYPE_SHARE_FB;
                    break;                
                default:
                    $type = PostAction::TYPE_LIKE;
                    break;
            }
            $post = $this->findPost($id);
            if($post !== null && $post->userCan($type)) {
                PostAction::create($id, $type);

                $newScore = Post::find()->select('score')->where(['id' => $id])->column();
                return ['status' => 'success', 'score' => $newScore];
            } else {
                return ['status' => 'error'];
            }
        }
    }

    public function actionPost($id) {
        $userPost = $this->findPost($id);

        $posts = Post::find()->where(['week_id' => $this->currentWeek->id, 'status' => Post::STATUS_ACTIVE])->limit(12)->orderBy(new \yii\db\Expression('rand()'))->all();

        return $this->render('post', [
            'userPost' => $userPost,
            'posts' => $posts,
        ]);
    }

    public function actionLogin2() {
        $user = User::findOne(5);
        Yii::$app->getUser()->login($user);
        return $this->redirect('/');
    }

    public function actionLogin() {
        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        
        if (isset($serviceName)) {
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Url::toRoute('site/participate'));
            $eauth->setCancelUrl(Url::toRoute('site/login'));
            
            try {
                if ($eauth->authenticate()) {
                    $user = User::findByService(/*$serviceName, */$eauth->id);
                    if(!$user) {
                        $user = new User;
                        $user->ig_id = $eauth->attributes['id'];
                        $user->username = $eauth->attributes['username'];
                        $user->full_name = $eauth->attributes['full_name'];
                        $user->image = $eauth->attributes['profile_picture'];
                        $user->website = $eauth->attributes['website'];
                        $user->bio = $eauth->attributes['bio'];

                        $user->save();
                    } elseif(!$user->username) {                        
                        $user->username = $eauth->attributes['username'];
                        $user->full_name = $eauth->attributes['full_name'];
                        $user->image = $eauth->attributes['profile_picture'];
                        $user->website = $eauth->attributes['website'];
                        $user->bio = $eauth->attributes['bio'];

                        $user->save();
                    }
                    Yii::$app->user->login($user);
                    // special redirect with closing popup window
                    $eauth->redirect();
                } else {
                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                    $eauth->redirect($eauth->getCancelUrl());
                }
            } catch (\nodge\eauth\ErrorException $e) {
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());

                // close popup window and redirect to cancelUrl
                $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
        }

        return $this->render('login');
    }

    public function actionHowToWin() {
        return $this->render('how_to_win', [
            'currentWeek' => $this->currentWeek,
            'weeks' => Week::find()->all(),
        ]);
    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRules(){
        $completePath = __DIR__.'/../web/pdf/rules.pdf';
        $filename = '/pdf/rules.pdf';
        return Yii::$app->response->sendFile($completePath, $filename, ['inline'=>true]);
    }

    private function findPost($id) {
        $post = Post::findOne($id);

        if($post === null || $post->status === Post::STATUS_BANNED) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $post;
    }
}
