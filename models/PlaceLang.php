<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place_lang".
 *
 * @property int $id
 * @property int $placeId
 * @property string $locality
 * @property string $country
 * @property string $lang
 *
 * @property Place $place
 */
class PlaceLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['placeId', 'locality', 'country', 'lang'], 'required'],
            [['placeId'], 'integer'],
            [['locality', 'country'], 'string', 'max' => 45],
            [['lang'], 'string', 'max' => 2],
            [['placeId'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['placeId' => 'id']],
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
            'locality' => Yii::t('app', 'Locality'),
            'country' => Yii::t('app', 'Country'),
            'lang' => Yii::t('app', 'Lang'),
        ];
    }

    /**
     * Gets query for [[Place]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'placeId']);
    }
}
