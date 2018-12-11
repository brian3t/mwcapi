<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "rider_history".
 *
 * @property string $id
 * @property string $cuser_id
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $dropoff_full_address
 * @property string $dropoff_lat
 * @property string $dropoff_lng
 * @property string $pickup_full_address
 * @property string $pickup_lat
 * @property string $pickup_lng
 * @property string $trigger_col
 * @property string $pickup_actual_lat
 * @property string $pickup_actual_lng
 * @property string $pickup_actual_full_address
 * @property string $dropoff_actual_lat
 * @property string $dropoff_actual_lng
 * @property string $dropoff_actual_full_address
 * @property string $request_id
 * @property string $rider_id
 * @property string $origin
 * @property string $destination
 * @property string $time_of_request
 *
 * @property \app\models\Cuser $cuser
 */
class RiderHistory extends \yii\db\ActiveRecord
{
//    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuser_id', 'dropoff_lat', 'dropoff_lng', 'pickup_lat', 'pickup_lng'], 'required'],
            [['status'], 'string'],
            [['created_at', 'updated_at', 'trigger_col', 'time_of_request'], 'safe'],
            [['dropoff_lat', 'dropoff_lng', 'pickup_lat', 'pickup_lng', 'pickup_actual_lat', 'pickup_actual_lng', 'dropoff_actual_lat', 'dropoff_actual_lng'], 'number'],
            [['id', 'cuser_id'], 'string', 'max' => 36],
            [['dropoff_full_address', 'pickup_full_address', 'pickup_actual_full_address', 'dropoff_actual_full_address', 'origin', 'destination'], 'string', 'max' => 400],
            [['request_id', 'rider_id'], 'string', 'max' => 26]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rider_history';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuser_id' => 'Cuser ID',
            'status' => 'Status',
            'dropoff_full_address' => 'Dropoff Full Address',
            'dropoff_lat' => 'Dropoff Lat',
            'dropoff_lng' => 'Dropoff Lng',
            'pickup_full_address' => 'Pickup Full Address',
            'pickup_lat' => 'Pickup Lat',
            'pickup_lng' => 'Pickup Lng',
            'trigger_col' => 'Trigger Col',
            'pickup_actual_lat' => 'Pickup Actual Lat',
            'pickup_actual_lng' => 'Pickup Actual Lng',
            'pickup_actual_full_address' => 'Pickup Actual Full Address',
            'dropoff_actual_lat' => 'Dropoff Actual Lat',
            'dropoff_actual_lng' => 'Dropoff Actual Lng',
            'dropoff_actual_full_address' => 'Dropoff Actual Full Address',
            'request_id' => 'Request ID',
            'rider_id' => 'Rider ID',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'time_of_request' => 'Time Of Request',
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
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }
}
