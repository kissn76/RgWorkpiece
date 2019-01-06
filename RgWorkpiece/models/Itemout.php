<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemout".
 *
 * @property int $itemoutId
 * @property int $itemoutItem
 * @property int $itemoutAmount
 * @property string $itemoutComment
 */
class Itemout extends \yii\db\ActiveRecord
{
    public $parentItem;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemoutItem', 'itemoutAmount'], 'required'],
            [['itemoutItem', 'itemoutAmount'], 'integer'],
            ['itemoutAmount', 'number', 'min' => 0, 'max' => $this->parentItem->itemActStock],
            [['itemoutComment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'itemoutId' => Yii::t('app', 'ID'),
            'itemoutItem' => Yii::t('app', 'Item'),
            'itemoutAmount' => Yii::t('app', 'Amount'),
            'itemoutComment' => Yii::t('app', 'Comment'),
        ];
    }
    
    public function getParentitem()
    {
        return Item::findOne('itemoutItem');
    }
}
