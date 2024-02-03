<?php

namespace app\modules\studyRepo\controllers;
use yii;
use app\modules\studyRepo\models\Home;
use app\modules\studyRepo\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * HomeController implements the CRUD actions for Home model.
 */
class HomeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {    return [
        'access' => [
            'class' => AccessControl::class,
            'only' => ['index','view','create','update','delete'],
            'rules' => [
            

                [
                    'actions' => ['index','view','create','update','delete'],
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return User::isUserAdmin(Yii::$app->user->identity->username);
                    }
                ],
              
            ],
        ],
       
    ];
    }

    /**
     * Lists all Home models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Home::findOne(['id' => 1]);
        $dataProvider = new ActiveDataProvider([
            'query' => Home::find(),
            
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            
        ]);
    
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'heading' => $model->heading1,
        ]);
    }
    /**
     * Displays a single Home model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Home model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Home();
      
        if ($this->request->isPost) {
                                 
                if ($model->load($this->request->post())&&  $model->save())  {
                $image = UploadedFile::getInstance($model, 'image');
                if(isset($image->size)){
                
                    $image->saveAs('uploads/homeimages/' . $image->baseName . '.' . $image->extension);

                }
                $model->image = 'uploads/homeimages/' . $image->baseName . '.' . $image->extension;
                $model->save();
               
                    return $this->redirect(['view', 'id' => $model->id]); 
                
                
               
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    /**
     * Updates an existing Home model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $image = UploadedFile::getInstance($model, 'image');
            if(isset($image->size)){
                
                $image->saveAs('uploads/homeimages/' . $image->baseName . '.' . $image->extension);

            }
            $model->image = 'uploads/homeimages/' . $image->baseName . '.' . $image->extension;
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Home model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Home model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Home the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Home::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
   
}
