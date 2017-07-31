<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yz\shoppingcart\CartPositionTrait;
use yz\shoppingcart\CartPositionInterface;

/**
 * This is the model class for table "Products".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $product_category_code
 * @property string $product_subcategory
 * @property string $product_name
 * @property string $buying_price
 * @property string $selling_price
 * @property string $product_description
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property ProductCharacteristics $productCharacteristics
 * @property ProductImages[] $productImages
 * @property ProductCategories $productCategoryCode
 */
class Products extends \yii\db\ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Products';
    }

    /**
    * automatic insertion of created_at, updated_at,
    * created_by and updated_by
    */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],   
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'product_category_code', 'product_subcategory', 'product_name', 'buying_price', 'selling_price', 'product_description'], 'required'],
            [['buying_price', 'selling_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_code'], 'string', 'max' => 20],
            [['product_category_code'], 'string', 'max' => 10],
            [['product_name'], 'string', 'max' => 255],
            [['product_description', 'created_by', 'updated_by'], 'string', 'max' => 45],
            [['product_code'], 'unique'],
            [['product_category_code'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategories::className(), 'targetAttribute' => ['product_category_code' => 'product_category_code']],
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
            'product_category_code' => 'Product Category Code',
            'product_subcategory' => 'Product Subcategory',
            'product_name' => 'Product Name',
            'buying_price' => 'Buying Price',
            'selling_price' => 'Selling Price',
            'product_description' => 'Product Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCharacteristics()
    {
        return $this->hasOne(ProductCharacteristics::className(), ['product_code' => 'product_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['product_code' => 'product_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategoryCode()
    {
        return $this->hasOne(ProductCategories::className(), ['product_category_code' => 'product_category_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendeds()
    {
        return $this->hasMany(Recommended::className(), ['product_code' => 'product_code']);
    }

    /**
    * find product_category_code based on product_subcategory
    */
    public function findProductCategoryCode($subcategory = null)
    {
        $items = Products::find()->where(['product_subcategory' => $subcategory])->all();

        $category_code = [];

        foreach($items as $item)
        {
            $category_code = [
                'category' => $item['product_category_code'],
            ];
        }

        if($category_code != null)
            return $category_code;
        else
            return false; 
    }

    /**
    * return product data
    */
    public function getProductData($product_code)
    {
        $data = Products::find()->where(['product_code' => $product_code])->one();

        return $data;
    }

    // cart function to get price
    public function getPrice()
    {
        return $this->selling_price;
    }

    // cart function to get product id
    public function getId()
    {
        return $this->id;
    } 
}
