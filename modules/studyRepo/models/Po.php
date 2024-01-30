<?php

namespace app\modules\studyRepo\models;

use Yii;

/**
 * This is the model class for table "po".
 *
 * @property int $id
 * @property int $po_id
 * @property string $description
 *
 * @property PoItem[] $poItems
 */
class Po extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'po';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'description'], 'required'],
            [['po_id'], 'string'],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'po_id' => 'Po ID',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[PoItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoItems()
    {
        return $this->hasMany(PoItem::class, ['po_id' => 'id']);
    }
}
