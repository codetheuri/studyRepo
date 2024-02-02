<?php

namespace app\modules\studyRepo\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\modules\studyRepo\models\Paper;
use app\modules\studyRepo\models\User;
use app\modules\studyRepo\models\PaperSearch;
use yii\behaviors\TimestampBehavior;

/**
 * PaperController implements the CRUD actions for Paper model.
 */
class PaperController extends Controller
{
    /**
     * @inheritDoc
     */
  
     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::class,
                 'only' => ['download','create','index', 'create','update','delete','view'], // Apply the filter only to the 'download' action
                 'rules' => [
                     [
                         'actions' => ['download','create',],
                         'allow' => true,
                         'roles' => ['@'], 
                        //  'denyCallback' => function () {
                        //     return $this->redirect(Url::to(['/studyRepo/admin/login']));
                        //  }// Allow only authenticated users
                     ],
                     [
                        'actions' => ['index','update','delete','view','create'],
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
     * Lists all Paper models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PaperSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paper model.
     * @param int $id ID
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
     * Creates a new Paper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {//  if (\Yii::$app->user->isGuest) {
    //     return $this->redirect(['admin/login']); // Adjust the login route accordingly
    // }
        $model = new Paper();
        $model->created_at = date('Y-m-d, H:i:s');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $file= UploadedFile::getInstance($model, 'file');
                if(isset($file->size)){

                $file->saveAs('uploads/papers/'.$model->papercode .'-'.$model->papername. '.'. $file->extension);
                $model->file= 'uploads/papers/'.$model->papercode .'-'.$model->papername. '.'. $file->extension;
                }
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
     * Updates an existing Paper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->created_at = date('Y-m-d, H:i:s');
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $file= UploadedFile::getInstance($model, 'file');
            if(isset($file->size)){

            $file->saveAs('uploads/papers/'.$model->papercode .'-'.$model->papername. '.'. $file->extension);
            $model->file= 'uploads/papers/'.$model->papercode .'-'.$model->papername. '.'. $file->extension;
            // $model->filePath= $model->file;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Paper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Paper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Paper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paper::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested paper does not exist.');
    }
    public function actionDownload($id)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(['user/login']); // Adjust the login route accordingly
        }

        $model = $this->findModel($id);

        if ($model->file && file_exists(Yii::getAlias('@webroot/' . $model->file))) {
            // Set the content type header
            Yii::$app->response->headers->set('Content-Type', 'application/pdf');
    
            // Display the PDF file inline in the browser
            return Yii::$app->response->sendFile(Yii::getAlias('@webroot/' . $model->file),$model->papercode.$model->papername . '.pdf', ['inline' => true]);
        } else {
            throw new NotFoundHttpException('The requested file does not exist.');
        }
      

        return $this->redirect(['index']);
    }
}
