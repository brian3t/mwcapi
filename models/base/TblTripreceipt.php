<?php

namespace app\models\base;

/**
 * This is the base model class for table "tbl_tripreceipt".
 *
 * @property string $id_trip
 * @property string $id_driver
 * @property string $id_rider
 * @property string $status
 * @property double $requested_start_lat
 * @property double $requested_start_lng
 * @property double $requested_end_lat
 * @property double $requested_end_lng
 * @property string $actual_start_lat
 * @property string $actual_start_lng
 * @property string $actual_end_lat
 * @property string $actual_end_lng
 * @property string $start_datetime
 * @property string $end_datetime
 * @property double $trip_length
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Cuser $driver
 * @property \app\models\Cuser $rider
 * @property \app\models\TripreceiptPoint[] $tripreceiptPoints
 * @property \app\models\VwEligibletrips[] $vwEligibletrips
 */
class TblTripreceipt extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'required'],
            [['status'], 'string'],
            [['requested_start_lat', 'requested_start_lng', 'requested_end_lat', 'requested_end_lng', 'actual_start_lat', 'actual_start_lng', 'actual_end_lat', 'actual_end_lng', 'trip_length'], 'number'],
            [['id_trip', 'start_datetime', 'end_datetime', 'created_at', 'updated_at'], 'safe'],
            [['id_trip'], 'string', 'max' => 39],
            [['id_driver', 'id_rider'], 'string', 'max' => 26]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tripreceipt';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_trip' => 'Id Trip',
            'id_driver' => 'Id Driver',
            'id_rider' => 'Id Rider',
            'status' => 'Status',
            'requested_start_lat' => 'Requested Start Lat',
            'requested_start_lng' => 'Requested Start Lng',
            'requested_end_lat' => 'Requested End Lat',
            'requested_end_lng' => 'Requested End Lng',
            'actual_start_lat' => 'Actual Start Lat',
            'actual_start_lng' => 'Actual Start Lng',
            'actual_end_lat' => 'Actual End Lat',
            'actual_end_lng' => 'Actual End Lng',
            'start_datetime' => 'Start Datetime',
            'end_datetime' => 'End Datetime',
            'trip_length' => 'Trip Length',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(\app\models\Cuser::className(), ['id' => 'id_driver'])->inverseOf('tblTripreceipts');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRider()
    {
        return $this->hasOne(\app\models\Cuser::className(), ['id' => 'id_rider'])->inverseOf('tblTripreceipts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTripreceiptPoints()
    {
        return $this->hasMany(\app\models\TripreceiptPoint::className(), ['id_trip' => 'id_trip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVwEligibletrips()
    {
        return $this->hasMany(\app\models\VwEligibletrips::className(), ['id_trip' => 'id_trip'])->inverseOf('trip');
    }
}
