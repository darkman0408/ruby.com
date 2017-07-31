<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "ProductImages".
 *
 * @property integer $image_id
 * @property string $product_code
 * @property string product_name
 * @property string product_slug
 * @property string $image_url
 *
 * @property Products $productCode
 */
class ProductImages extends \yii\db\ActiveRecord
{

    public $image; // image file

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'product_name',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ProductImages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'product_name'], 'required'],
            [['slug', 'image_url'], 'string'],
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
            'image_id' => 'Image ID',
            'product_code' => 'Product Code',
            'product_name' => 'Product Name',
            'slug' => 'Slug',
            'image_url' => 'Image Url',
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
            $path = Yii::$app->params['imageUploadUrl'] . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->image = null;
            $this->image_url = $path;

            return true;
        }
        else
            return false;
    }

    /**
    * get image with specific id
    */
    public function getImage($product_code)
    {
        $images = ProductImages::find()
            ->where(['ProductImages.product_code' => $product_code])
            ->all();

        return $images;
    }
}
