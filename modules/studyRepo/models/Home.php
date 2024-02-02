<?php

namespace app\modules\studyRepo\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "home".
 *
 * @property int $id
 * @property string $heading1
 * @property string $opening_text
 * @property string $image

 */
class Home extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'home';
    }

    /**
     * {@inheritdoc}
     */
  

    public function rules()
    {
        return [
         
            [['heading1', 'opening_text','image'], 'string'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
           
          
        ];
         
    }

    /**
     * {@inheritdoc} // $model->image1 = UploadedFile::getInstance($model, 'image1');
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'heading1' => 'Heading1',
            'opening_text' => 'Opening Text',
            'image' => 'Image',
        ];
    }
    // public function upload()

    // {
    //     if ($this->validate()) {
    //         $this->image1->saveAs('uploads/homeimages/' . $this->image1->baseName . '.' . $this->image1->extension);
    //         $this->imagedir = ' $this->image1->baseName. '.' . $this->image1->extension';
                      
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
