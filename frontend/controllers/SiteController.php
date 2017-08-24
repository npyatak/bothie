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

use common\models\User;
use common\models\Post;
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

        if ($model->load(Yii::$app->request->post())) {
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

                return $this->redirect(['index']);
            }
        } 

        return $this->render('participate', [
            'model' => $model,
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

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
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

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
