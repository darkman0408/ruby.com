<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ProductCharacteristics".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $material
 * @property string $dimension
 * @property string $weight
 * @property string $size
 * @property string $type_of_stone
 * @property string $unit_of_measure
 * @property string $sex
 *
 * @property Products $productCode
 */
class ProductCharacteristics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ProductCharacteristics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code'], 'required'],
            [['product_code', 'material', 'dimension', 'weight', 'size', 'type_of_stone', 'unit_of_measure'], 'string', 'max' => 20],
            [['sex'], 'string', 'max' => 10],
            [['product_code'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_code' => 'product_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'material' => 'Material',
            'dimension' => 'Dimension',
            'weight' => 'Weight',
            'size' => 'Size',
            'type_of_stone' => 'Type Of Stone',
            'unit_of_measure' => 'Unit Of Measure',
            'sex' => 'Sex',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCode()
    {
        return $this->hasOne(Products::className(), ['product_code' => 'product_code']);
    }
}
