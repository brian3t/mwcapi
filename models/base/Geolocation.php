<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "geolocation".
 *
 * @property string $id
 * @property string $cuser_id
 * @property string $created_at
 * @property string $latitude
 * @property string $longitude
 * @property string $device_id
 * @property integer $accuracy
 * @property string $provider
 * @property string $altitude
 * @property string $time
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
            [['latitude', 'longitude', 'altitude'], 'number'],
            [['accuracy'], 'integer'],
            [['id', 'cuser_id'], 'string', 'max' => 26],
            [['device_id', 'provider'], 'string', 'max' => 80]
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
            'device_id' => 'Device ID',
            'accuracy' => 'Accuracy',
            'provider' => 'Provider',
            'altitude' => 'Altitude',
            'time' => 'Time',
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
