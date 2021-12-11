<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string $placeId
 * @property string $lat
 * @property string $lng
 * @property string $countryCode
 * @property int $isCountry
 *
 * @property PlaceLang[] $placeLangs
 * @property Trip[] $trips
 * @property Trip[] $trips0
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['placeId', 'lat', 'lng', 'countryCode', 'isCountry'], 'required'],
            [['isCountry'], 'integer'],
            [['placeId', 'lat', 'lng'], 'string', 'max' => 45],
            [['countryCode'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'placeId' => Yii::t('app', 'Place ID'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
            'countryCode' => Yii::t('app', 'Country Code'),
            'isCountry' => Yii::t('app', 'Is Country'),
        ];
    }

    /**
     * Gets query for [[PlaceLangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceLangs()
    {
        return $this->hasMany(PlaceLang::className(), ['placeId' => 'id']);
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['from' => 'id']);
    }

    /**
     * Gets query for [[Trips0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips0()
    {
        return $this->hasMany(Trip::className(), ['to' => 'id']);
    }
}
