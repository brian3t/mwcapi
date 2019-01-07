<?php

namespace app\models\base;

use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "geolocation".
 *
 * @property string $id
 * @property string $cuser_id
 * @property string $created_at
 * @property string $latitude
 * @property string $longitude
 * @property integer $accuracy
 * @property string $provider
 * @property string $altitude
 * @property string $time
 * @property integer $commuter_id
 * @property string $trip_id
 * @property string $start_lat
 * @property string $start_lng
 * @property string $end_lat
 * @property string $end_lng
 * @property boolean $is_end_of_trip
 *
 * @property \app\models\Cuser $cuser
 */
class Geolocation extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'time'], 'safe'],
            [['latitude', 'longitude', 'altitude', 'start_lat', 'start_lng', 'end_lat', 'end_lng'], 'number'],
            [['accuracy', 'commuter_id'], 'integer'],
            [['is_end_of_trip'], 'boolean'],
            [['id', 'cuser_id'], 'string', 'max' => 26],
            [['provider'], 'string', 'max' => 80],
            [['trip_id'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geolocation';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuser_id' => 'Cuser ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'accuracy' => 'Accuracy',
            'provider' => 'Provider',
            'altitude' => 'Altitude',
            'time' => 'Time',
            'commuter_id' => 'Commuter ID',
            'trip_id' => 'Trip ID',
            'start_lat' => 'Start Lat',
            'start_lng' => 'Start Lng',
            'end_lat' => 'End Lat',
            'end_lng' => 'End Lng',
            'is_end_of_trip' => 'Is End Of Trip',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuser()
    {
        return $this->hasOne(\app\models\Cuser::className(), ['id' => 'cuser_id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
}
