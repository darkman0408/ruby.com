<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Customers".
 *
 * @property integer $id
 * @property string $username
 * @property string $customer_first_name
 * @property string $customer_last_name
 * @property string $customer_email
 * @property string $customer_phone
 *
 * @property User $username0
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username', 'customer_first_name', 'customer_last_name', 'customer_email'], 'string', 'max' => 255],
            [['customer_phone'], 'string', 'max' => 20],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'customer_first_name' => 'Customer First Name',
            'customer_last_name' => 'Customer Last Name',
            'customer_email' => 'Customer Email',
            'customer_phone' => 'Customer Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }
}
