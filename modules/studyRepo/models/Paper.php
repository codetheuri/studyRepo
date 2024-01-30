<?php

namespace app\modules\studyRepo\models;

use Yii;

/**
 * This is the model class for table "paper".
 *
 * @property int $id
 * @property string $papername
 * @property string $unit
 * @property string $papercode
 * @property string $created_at
 */
class Paper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paper';
    }

    /**
     * {@inheritdoc}
     */
     

    public function rules()
    {
        return [
            [['papername', 'unit', 'papercode', ], 'required', 'message' => 'Please fill the field'],
            [['created_at',], 'safe'],
            [['papername', 'unit', 'papercode', 'created_at'], 'string', 'max' => 255],
            
            [['file'], 'file', 'extensions' => 'pdf,txt']
      
          
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'papername' => 'Papername',
            'unit' => 'Unit',
            'papercode' => 'Papercode',
            'created_at' => 'Created At',
            'file'=>'file',
        ];
    }


}
