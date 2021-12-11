<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phone_number".
 *
 * @property int $id
 * @property int $userId
 * @property int $countryId
 * @property string $number
 * @property string $verificationCode
 * @property int $verified
 * @property int $active
 * @property string $createdAt
 *
 * @property Country $country
 * @property User $user
 */
class PhoneNumber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phone_number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'countryId', 'number', 'verificationCode'], 'required'],
            [['userId', 'countryId', 'verified', 'active'], 'integer'],
            [['createdAt'], 'safe'],
            [['number', 'verificationCode'], 'string', 'max' => 45],
            [['number'], 'unique'],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User ID'),
            'countryId' => Yii::t('app', 'Country ID'),
            'number' => Yii::t('app', 'Number'),
            'verificationCode' => Yii::t('app', 'Verification Code'),
            'verified' => Yii::t('app', 'Verified'),
            'active' => Yii::t('app', 'Active'),
            'createdAt' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'countryId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
