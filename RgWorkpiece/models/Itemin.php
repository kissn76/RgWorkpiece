<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemin".
 *
 * @property int $iteminId
 * @property int $iteminItem
 * @property int $iteminAmount
 * @property string $iteminComment
 */
class Itemin extends \yii\db\ActiveRecord
{
    public $parentItem;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iteminItem', 'iteminAmount'], 'required'],
            [['iteminItem', 'iteminAmount'], 'integer'],
            ['iteminAmount', 'number', 'min' => 0],
            [['iteminComment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iteminId' => Yii::t('app', 'ID'),
            'iteminItem' => Yii::t('app', 'Item'),
            'iteminAmount' => Yii::t('app', 'Amount'),
            'iteminComment' => Yii::t('app', 'Comment'),
        ];
    }
    
    public function getParentitem()
    {
        return Item::findOne('iteminItem');
    }
}
