<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trip".
 *
 * @property int $id
 * @property int $userId
 * @property int $from
 * @property int $to
 * @property string $date
 * @property int $seatCounts
 * @property float $duration
 * @property float $price
 * @property int $currencyId
 * @property int $status
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Currency $currency
 * @property Place $from0
 * @property Message[] $messages
 * @property Place $to0
 * @property User $user
 */
class Trip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'from', 'to', 'date', 'seatCounts', 'duration', 'price', 'currencyId'], 'required'],
            [['userId', 'from', 'to', 'seatCounts', 'currencyId', 'status'], 'integer'],
            [['date', 'createdAt', 'updatedAt'], 'safe'],
            [['duration', 'price'], 'number'],
            [['currencyId'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyId' => 'id']],
            [['from'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['from' => 'id']],
            [['to'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['to' => 'id']],
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
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'date' => Yii::t('app', 'Date'),
            'seatCounts' => Yii::t('app', 'Seat Counts'),
            'duration' => Yii::t('app', 'Duration'),
            'price' => Yii::t('app', 'Price'),
            'currencyId' => Yii::t('app', 'Currency ID'),
            'status' => Yii::t('app', 'Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyId']);
    }

    /**
     * Gets query for [[From0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(Place::className(), ['id' => 'from']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['tripId' => 'id']);
    }

    /**
     * Gets query for [[To0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(Place::className(), ['id' => 'to']);
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
