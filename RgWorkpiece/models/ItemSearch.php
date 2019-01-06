<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Item;

/**
 * ItemSearch represents the model behind the search form of `app\models\Item`.
 */
class ItemSearch extends Item
{
    public $itemcategoryname;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemId', 'itemCategory', 'itemMinStock', 'itemActStock'], 'integer'],
            [['itemName', 'itemcategoryname'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Item::find();

        // add conditions that should always apply here
        $query->joinWith(['itemcategoryname']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['itemcategoryname'] = [
            'asc' => ['category.categoryName' => SORT_ASC],
            'desc' => ['category.categoryName' => SORT_DESC],
            'default' => SORT_ASC,
        ];
        
        $dataProvider->sort->defaultOrder = [
            'itemcategoryname' => SORT_ASC,
            'itemName' => SORT_ASC
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'itemId' => $this->itemId,
            'itemCategory' => $this->itemCategory,
            'itemMinStock' => $this->itemMinStock,
            'itemActStock' => $this->itemActStock,
        ]);

        $query->andFilterWhere(['like', 'itemName', $this->itemName])
              ->andFilterWhere(['like', 'category.categoryName', $this->itemcategoryname]);

        return $dataProvider;
    }
    
    public function searchlow($params)
    {
        $query = Item::find()
            ->select('item.*')
            ->joinWith(['itemcategoryname'])
            ->innerJoin('itemin', 'itemin.iteminItem = item.itemId')
            ->where('itemActStock <= itemMinStock');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['itemcategoryname'] = [
            'asc' => ['category.categoryName' => SORT_ASC],
            'desc' => ['category.categoryName' => SORT_DESC],
            'default' => SORT_ASC,
        ];
        
        $dataProvider->sort->defaultOrder = [
            'itemcategoryname' => SORT_ASC,
            'itemName' => SORT_ASC
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'itemId' => $this->itemId,
            'itemCategory' => $this->itemCategory,
            'itemMinStock' => $this->itemMinStock,
            'itemActStock' => $this->itemActStock,
        ]);

        $query->andFilterWhere(['like', 'itemName', $this->itemName])
              ->andFilterWhere(['like', 'category.categoryName', $this->itemcategoryname]);

        return $dataProvider;
    }
}
