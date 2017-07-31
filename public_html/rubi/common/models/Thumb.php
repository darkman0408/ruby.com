<?php

namespace common\models;

use Yii;
use common\models\Products;
use common\models\ProductCharacteristics;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "Thumb".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $product_name
 * @property string slug
 * @property string $thumb_url
 *
 * @property Products $productCode
 */
class Thumb extends \yii\db\ActiveRecord
{

    public $thumb; // image file

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
        return 'Thumb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'product_name'], 'required'],
            [['slug', 'thumb_url'], 'string'],
            [['product_code'], 'string', 'max' => 20],
            [['product_name'], 'string', 'max' => 255],
            [['product_code'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_code' => 'product_code']],
            [['thumb'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            'slug' => 'Slug',
            'thumb_url' => 'Thumb Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCode()
    {
        return $this->hasOne(Products::className(), ['product_code' => 'product_code']);
    }

    public function getProductCharacteristics()
    {
        return $this->hasOne(ProductCharacteristics::className(), ['product_code' => 'product_code']);
    }

    /**
    * upload image
    */
    public function uploadThumb()
    {
        if($this->validate())
        {
            $path = Yii::$app->params['thumbUploadUrl'] . $this->thumb->baseName . '.' . $this->thumb->extension;
            $this->thumb->saveAs($path);
            $this->thumb = null;
            $this->thumb_url = $path;

            return true;
        }
        else
            return false;
    }

    /**
    * inner join with ProductImages to get right thumbnail
    */
    public function getThumbs($product_subcategory)
    {

        //$products = new Products();

        $thumbs = Thumb::find()
            ->innerJoinWith('productCode')
            ->where(['Products.product_subcategory' => $product_subcategory])
            ->all();

        return $thumbs;    
    }

    /**
    * get thumnails for checkbox queries
    */
    public function getThumbsCheckbox($product_subcategory)
    {
        $thumbs = Thumb::find()
            ->innerJoinWith('productCode')
            ->select('thumb_url')
            ->where(['Products.product_subcategory' => $product_subcategory])
            ->all();

        return $thumbs;
    }
}
