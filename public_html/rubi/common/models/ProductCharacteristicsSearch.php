<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductCharacteristics;

/**
 * ProductCharacteristicsSearch represents the model behind the search form about `common\models\ProductCharacteristics`.
 */
class ProductCharacteristicsSearch extends ProductCharacteristics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['product_code', 'material', 'dimension', 'weight', 'size', 'type_of_stone', 'unit_of_measure', 'sex'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = ProductCharacteristics::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'dimension', $this->dimension])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'type_of_stone', $this->type_of_stone])
            ->andFilterWhere(['like', 'unit_of_measure', $this->unit_of_measure])
            ->andFilterWhere(['like', 'sex', $this->sex]);

        return $dataProvider;
    }
}
