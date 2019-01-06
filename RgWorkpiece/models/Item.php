<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "item".
 *
 * @property int $itemId
 * @property string $itemName
 * @property int $itemCategory
 * @property int $itemMinStock
 * @property int $itemActStock
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemName', 'itemCategory'], 'required'],
            [['itemName'], 'string'],
            [['itemCategory', 'itemMinStock', 'itemActStock'], 'integer'],
            [['itemName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'itemId' => Yii::t('app', 'ID'),
            'itemName' => Yii::t('app', 'Item name'),
            'itemCategory' => Yii::t('app', 'Category'),
            'itemMinStock' => Yii::t('app', 'Minimal stock'),
            'itemActStock' => Yii::t('app', 'Actual stock'),
            'itemcategoryname' => Yii::t('app', 'Category'),
        ];
    }
    
    public function getItemcategoryname()
    {
        return $this->hasOne(Category::className(), ['categoryId' => 'itemCategory']);
    }
    
    public function getInnumber()
    {
        $query = new Query;
        
        $query->select('iteminId')
            ->from('itemin')
            ->where(['iteminItem' => $this->itemId]);
            
        $count = $query->count();
        
        return $count;
    }
}
