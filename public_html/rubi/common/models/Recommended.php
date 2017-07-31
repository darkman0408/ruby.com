<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Recommended".
 *
 * @property int $id
 * @property string $product_code
 * @property string $product_name
 * @property string $recommended_url
 *
 * @property Products $productCode
 */
class Recommended extends \yii\db\ActiveRecord
{
    public $image; // image file

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Recommended';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code'], 'required'],
            [['recommended_url'], 'string'],
            [['product_code'], 'string', 'max' => 20],
            [['product_name'], 'string', 'max' => 255],
            [['product_code'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_code' => 'product_code']],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            'product_name' => 'Product Name',
            'recommended_url' => 'Recommended Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCode()
    {
        return $this->hasOne(Products::className(), ['product_code' => 'product_code']);
    }

    /**
    * upload image
    */
    public function upload()
    {
        if($this->validate())
        {
            $path = Yii::$app->params['recommendedUploadUrl'] . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->image = null;
            $this->image_url = $path;

            return true;
        }
        else
            return false;
    }
}
