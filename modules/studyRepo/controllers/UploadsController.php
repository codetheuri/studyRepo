<?php
namespace app\modules\studyRepo\controllers;

use Yii;
use yii\web\Controller;
use app\modules\studyRepo\models\UploadForm;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

class UploadsController extends Controller
{
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->image1 = UploadedFile::getInstance($model, 'image1');
            if ($model->upload()) {
                Yii::$app->getSession()->setFlash('success', 'My success message!');
             } else {
                Yii::$app->getSession()->setFlash('error', 'My error message!');
            }
        
        }
        return $this->render('image', ['model' => $model]);
    
}
}