<?php

namespace app\modules\studyRepo\controllers;
use app\modules\studyRepo\models\LoginForm;
use app\modules\studyRepo\models\SignupForm;
use app\modules\studyRepo\models\User;
use app\modules\studyRepo\models\VerifyEmailForm;
use app\modules\studyRepo\models\PasswordResetRequestForm;
use app\modules\studyRepo\models\ResetPasswordForm;
use app\modules\studyRepo\models\ResendVerificationEmailForm;
use yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\base\InvalidArgumentException;


class UserController extends Controller
{
    public function behaviors() 
    {
        return [
            'access' => [
            'class' => AccessControl::class,
            'only' => ['logout', 'signup'],
            'rules' => [
                [
                   'actions' => ['login','index','register', 'error'],
                   'allow' => true,
                ],
                [
                    
                   'allow' => true,
                   'roles' => ['@'],
                ],
             ],
            ],
            'verbs' => [
                            'class' => VerbFilter::class,
                            'actions' => [
                                 'logout' => ['post'],
                            ],
                        ],
        ];
     }     
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
    public function actionIndex()
    {
        return $this->layout('Blayout');
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack(); //djust the login route accordingly
        }
        $this->layout = 'login_layout';
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            Yii::$app->user->identity = $model->getUser();
            return $this->redirect(['admin/index']);
        } 
        else if($model->load(Yii::$app->request->post()) && $model->login()){
            Yii::$app->user->identity = $model->getUser();
            return $this->goHome();
        }

        else {


        return $this->render('login', [
            'model' => $model,
        ]);
    }
}


    public function actionRegister()
    {
        $this->layout = 'login_layout';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
                     Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }
      
        return $this->render('register', ['model' => $model, 'layout' => 'login_layout',]);
    }
    
    public function actionLogout()
    {   $this->layout = 'Alayout';
        if (Yii::$app->user->logout()) {
            return $this->goHome();
            // return $this->redirect(['user/login']);
        }
    else{
        // return $this->redirect(['user/login']);
    }
    
    }
    public function actionRequestPasswordReset()
    {
        $this->layout = 'blank';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
        $this->layout = 'blank';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
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

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        $this->layout = 'blank';
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $this->layout = 'blank';
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}


