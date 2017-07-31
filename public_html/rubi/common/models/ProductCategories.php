<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ProductCategories".
 *
 * @property integer $id
 * @property string $product_category_code
 * @property string $product_category_name
 * @property string $product_subcategory
 * @property string $subcategory_description
 *
 * @property Products[] $products
 */
class ProductCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ProductCategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_category_code', 'product_category_name', 'product_subcategory'], 'required'],
            [['product_category_code'], 'string', 'max' => 10],
            [['subcategory_description'], 'string'],
            [['product_category_name', 'product_subcategory'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_category_code' => 'Product Category Code',
            'product_category_name' => 'Product Category Name',
            'product_subcategory' => 'Product Subcategory',
            'subcategory_description' => 'Subcategory Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['product_category_code' => 'product_category_code']);
    }

    /**
    * return category briljantin menu items
    */
    public static function getCategoryBriliant()
    {
        $items = ProductCategories::find()->where(['product_category_code' => 'BRI001'])->all();

        $result = [];

        foreach($items as $item)
        {
            $result[] = [
                'label' => $item['product_subcategory'],
                'url' => ['site/category', 'product_subcategory' => $item['product_subcategory']],
                'code' => $item['product_subcategory'],
            ];
        }

        return $result;
    } 

    /**
    * return category nakit menu items
    */
    public static function getCategoryJewelry()
    {
        $items = ProductCategories::find()->where(['product_category_code' => 'NAK001'])->all();

        $result = [];

        foreach($items as $item)
        {
            $result[] = [
                'label' => $item['product_subcategory'],
                'url' => ['site/category', 'product_subcategory' => $item['product_subcategory']],
                'code' => $item['product_subcategory'],
            ];
        }

        return $result;
    }

    /**
    * return category metal menu items
    */
    public static function getCategoryMetal()
    {
        $items = ProductCategories::find()->where(['product_category_code' => 'MET001'])->all();

        $result = [];

        foreach($items as $item)
        {
            $result[] = [
                'label' => $item['product_subcategory'],
                'url' => ['site/category', 'product_subcategory' => $item['product_subcategory']],
                'code' => $item['product_subcategory'],
            ];
        }

        return $result;
    }

    /**
    * return category investicije menu items
    */
    public static function getCategoryInvestment()
    {
        $items = ProductCategories::find()->where(['product_category_code' => 'INV001'])->all();

        $result = [];

        foreach($items as $item)
        {
            $result[] = [
                'label' => $item['product_subcategory'],
                'url' => ['site/category', 'product_subcategory' => $item['product_subcategory']],
                'code' => $item['product_subcategory'],
            ];
        }

        return $result;
    }

    /**
    * return subcategory description
    */
    public function getSubDesc($product_code)
    {
        $desc = ProductCategories::find()
            ->select('subcategory_description')
            ->innerJoinWith('products')
            ->where(['product_code' => $product_code])
            ->one();

        return $desc;
    }

    /**
    * get subcategory of product
    */
    public function getSubcategoryBriliant()
    {
        $items = ProductCategories::find()
            ->select('product_subcategory')
            ->where(['product_category_code' => 'BRI001'])
            ->all();

        return $items;
    }
}
