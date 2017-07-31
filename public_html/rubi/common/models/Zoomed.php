<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "Zoomed".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $product_name
 * @property string $slug
 * @property string $zoomed_url
 *
 * @property ProductImages $productCode
 */
class Zoomed extends \yii\db\ActiveRecord
{

    public $image; //image file

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
        return 'Zoomed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'product_name'], 'required'],
            [['slug', 'zoomed_url'], 'string'],
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
            'slug' => 'Slug',
            'zoomed_url' => 'Zoomed Url',
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
            $path = Yii::$app->params['zoomedUploadUrl'] . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->image = null;
            $this->zoomed_url = $path;

            return true;
        }
        else
            return false;
    }

    /**
    * inner join with ProductImages to get right image for magnifying
    */
    /*public function getZoomed($image_id)
    {

        //$products = new Products();

        $zooms = Zoomed::find()->innerJoinWith('productImagesImage')
            ->where(['product_images_image_id' => $image_id])
            ->all();

        return $zooms;    
    }*/

    /**
    * get image with specific id
    */
    public function getImage($product_code)
    {
        $images = Zoomed::find()
            ->where(['product_code' => $product_code])
            ->all();

        return $images;
    }
}
