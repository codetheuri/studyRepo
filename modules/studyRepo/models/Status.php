<?php

namespace app\modules\studyRepo\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property int $status_code
 * @property string $status_name
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_code', 'status_name'], 'required'],
            [['status_code'], 'integer'],
            [['status_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_code' => 'Status Code',
            'status_name' => 'Status Name',
        ];
    }
}
