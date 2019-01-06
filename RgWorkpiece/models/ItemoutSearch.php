<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Itemout;

/**
 * ItemoutSearch represents the model behind the search form of `app\models\Itemout`.
 */
class ItemoutSearch extends Itemout
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemoutId', 'itemoutItem', 'itemoutAmount'], 'integer'],
            [['itemoutComment'], 'safe'],
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
    public function search($id)
    {
        $query = Itemout::find()
            ->where(['itemoutItem' => $id])
            ->orderBy('itemoutId');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
