<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductCategories;

/**
 * ProductCategoriesSearch represents the model behind the search form about `common\models\ProductCategories`.
 */
class ProductCategoriesSearch extends ProductCategories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['product_category_code', 'product_category_name','product_subcategory', 'subcategory_description'], 'safe'],
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
        $query = ProductCategories::find();

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

        $query->andFilterWhere(['like', 'product_category_code', $this->product_category_code])
            ->andFilterWhere(['like', 'product_category_name', $this->product_category_name])
            ->andFilterWhere(['like', 'product_subcategory', $this->product_subcategory])
            ->andFilterWhere(['like', 'subcategory_description', $this->subcategory_description]);

        return $dataProvider;
    }
}
