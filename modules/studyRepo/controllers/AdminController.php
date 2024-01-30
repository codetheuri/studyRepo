<?php

namespace app\modules\studyRepo\controllers;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\studyRepo\models\LoginForm;
use app\modules\studyRepo\models\SignupForm;
use app\modules\studyRepo\models\User;
use yii\helpers\Url;


class AdminController extends \yii\web\Controller

{   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout','signup','login','delete-user'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['login','error'   ],
                        'allow' => true,
                        
                    ],
                    [
                        'actions' => ['logout','users','delete-user'],
                        'allow' => true,
                        'roles' => ['@'],
                        'denyCallback' => function () {
                            return $this->redirect(Url::to(['/studyRepo/admin/login']));
                         }// Allo
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function goHome($defaulturl = null)
    {
        // Customize the home page redirection logic here
        if ($defaulturl === null) {
            $defaulturl = ['admin/index']; // Change this to your desired home page URL
        }

        return $this->redirect($defaulturl);
    }
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['admin/login']); // Adjust the login route accordingly
        }

        return $this->redirect(['paper/index']);
    }
    public function actionUsers()
    {
        $users = User::find()->all();

        return $this->render('users', [
            'users' => $users,
        ]);
    }
   
public function actionDeleteUser($id)
{
    $user = User::findOne($id);

    // Handle deleting user logic here
    $user->delete();

    return $this->redirect(['users']);
}

public function actionLogin()
{

    if (!Yii::$app->user->isGuest) {
        return $this->redirect(['admin/index']); // Adjust the login route accordingly
    }

    $this->layout = 'login2_layout';
    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        Yii::$app->session->setFlash('success', 'Welcome to the admin panel.');
        return $this->goHome();
    }

    else {


    return $this->render('login', [
        'model' => $model,
    ]);
}
}

    

public function actionLogout()
{   
    if (Yii::$app->user->logout()) {
      
        return $this->redirect(['admin/login']);
    }
else{
     return $this->redirect(['admin/login']);
}

}
}
