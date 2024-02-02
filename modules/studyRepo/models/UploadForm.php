<?php
namespace app\modules\studyRepo\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $image1;

    public function rules()
    {
        return [
            [['imageFile','image1'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg,gif'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/homeimages/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->image1->saveAs('uploads/homeimages/' . $this->image1->baseName . '.' . $this->image1->extension);
            return true;
        } else {
            return false;
        }
    }
}