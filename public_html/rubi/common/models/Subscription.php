<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $name
 * @property string $braintreeId
 * @property string $braintreePlan
 * @property integer $quantity
 * @property string $trialEndAt
 * @property string $endAt
 * @property string $createdAt
 * @property string $updatedAt
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'name', 'braintreeId', 'braintreePlan', 'quantity'], 'required'],
            [['userId', 'quantity'], 'integer'],
            [['trialEndAt', 'endAt', 'createdAt', 'updatedAt'], 'safe'],
            [['name', 'braintreeId', 'braintreePlan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'name' => 'Name',
            'braintreeId' => 'Braintree ID',
            'braintreePlan' => 'Braintree Plan',
            'quantity' => 'Quantity',
            'trialEndAt' => 'Trial End At',
            'endAt' => 'End At',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
