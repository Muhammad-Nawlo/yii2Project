<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $uId
 * @property string $userName
 * @property string $email
 * @property string $password
 * @property int $status
 * @property int $contactEmail
 * @property int $contactPhone
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Message[] $messages
 * @property Message[] $messages0
 * @property PhoneNumber[] $phoneNumbers
 * @property Trip[] $trips
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uId', 'userName', 'email', 'password'], 'required'],
            [['status', 'contactEmail', 'contactPhone'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['uId', 'password'], 'string', 'max' => 60],
            [['userName'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uId' => Yii::t('app', 'U ID'),
            'userName' => Yii::t('app', 'User Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'status' => Yii::t('app', 'Status'),
            'contactEmail' => Yii::t('app', 'Contact Email'),
            'contactPhone' => Yii::t('app', 'Contact Phone'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['fromUserId' => 'id']);
    }

    /**
     * Gets query for [[Messages0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages0()
    {
        return $this->hasMany(Message::className(), ['toUserId' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::className(), ['userId' => 'id']);
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['userId' => 'id']);
    }
}
