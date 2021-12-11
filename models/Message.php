<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $fromUserId
 * @property int $toUserId
 * @property int $tripId
 * @property string $text
 * @property string $createdAt
 *
 * @property User $fromUser
 * @property User $toUser
 * @property Trip $trip
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fromUserId', 'toUserId', 'tripId', 'text'], 'required'],
            [['fromUserId', 'toUserId', 'tripId'], 'integer'],
            [['text'], 'string'],
            [['createdAt'], 'safe'],
            [['fromUserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fromUserId' => 'id']],
            [['toUserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['toUserId' => 'id']],
            [['tripId'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::className(), 'targetAttribute' => ['tripId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fromUserId' => Yii::t('app', 'From User ID'),
            'toUserId' => Yii::t('app', 'To User ID'),
            'tripId' => Yii::t('app', 'Trip ID'),
            'text' => Yii::t('app', 'Text'),
            'createdAt' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[FromUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fromUserId']);
    }

    /**
     * Gets query for [[ToUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'toUserId']);
    }

    /**
     * Gets query for [[Trip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(Trip::className(), ['id' => 'tripId']);
    }
}
