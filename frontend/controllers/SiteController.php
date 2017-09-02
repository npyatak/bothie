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

use common\models\User;
use common\models\Post;
use common\models\PostAction;
use common\models\Week;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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
                'only' => ['login', 'logout', 'participate'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'participate'],
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
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



                return $this->redirect(['index']);
            }
        } 

        return $this->render('participate', [
            'weeks' => Week::find()->all(),
            'model' => $model,
        ]);
    }

    public  function actionImage($id){
        $post = Post::findOne($id);

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
        $query = Post::find();
        if(!Yii::$app->user->isGuest) {
            $query->select(['post.*', 'post_action.*'])
                ->leftJoin([
                'post_action' => PostAction::find()
                    ->select(['MAX(post_action.id) as last_user_action_id', 'MAX(post_action.created_at) as last_user_action_time', 'post_action.type', 'post_action.post_id'])
                    ->where(['post_action.user_id'=>Yii::$app->user->id])
                    ->groupBy('post_action.type, post_action.post_id')
                    ->orderBy('post_action.id DESC, post_action.type')
                    ->asArray()
                ], 
                'post_action.post_id = post.id');
        }        
        $query->where(['status'=>Post::STATUS_ACTIVE])->limit(12)->orderBy(new \yii\db\Expression('rand()'))->asArray();
        
        $posts = $query->all();

        return $this->render('vote', [
            'posts' => $posts,
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
            $post = Post::findOne($id);
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
        $post = Post::findOne($id);
        if($post === null || $post->status === Post::STATUS_BANNED) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('post', [
            'post' => $post,
        ]);
    }

    public function actionLogin() {
        $user = User::findOne(1);
        Yii::$app->getUser()->login($user);
        return $this->redirect('/');

        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        
        if (isset($serviceName)) {
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Yii::$app->request->referrer);
            $eauth->setCancelUrl(Url::toRoute('site/login'));
            
            try {
                if ($eauth->authenticate()) {
                    echo '<pre>';
                    print_r($eauth);
                    echo '</pre>';
                    exit;
                    $user = User::findByService($serviceName, $eauth->id);
                    if(!$user) {
                        $user = new User;
                        $user->name = $eauth->first_name;
                        $user->surname = $eauth->last_name;
                        $user->soc = $serviceName;
                        $user->sid = $eauth->id;
                        $user->sex = $eauth->sex;
                        if(isset($eauth->email)) $user->email = $eauth->email;
                        if(isset($eauth->country)) $user->country = $eauth->country;
                        if(isset($eauth->city)) $user->city = $eauth->city;
                        if(isset($eauth->photo_url)) $user->ava_soc = $eauth->photo_url;
                        if(isset($eauth->bdate)) $user->birthdate = $eauth->bdate;
                        $user->lang_id = Yii::$app->controller->cLangId;
                        $user->save();
                    }
                    Yii::$app->getUser()->login($user);
                    // special redirect with closing popup window
                    $eauth->redirect();
                }
                else {
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

    public function actionHowToWin()
    {
        return $this->render('how_to_win');
    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionRules(){
        $completePath = __DIR__.'/../web/pdf/rules.pdf';
        $filename = '/pdf/rules.pdf';
        return Yii::$app->response->sendFile($completePath, $filename, ['inline'=>true]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
