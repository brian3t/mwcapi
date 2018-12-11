<?php

namespace app\models\base;

/**
 * This is the base model class for table "cuser".
 *
 * @property string $id
 * @property string $first_name
 * @property string $cuser_status
 * @property string $status_code
 * @property string $created_at
 * @property string $updated_at
 * @property string $status_description
 * @property integer $commuter
 * @property string $hashed_password
 * @property integer $enrolled
 * @property string $email
 * @property string $username
 * @property string $commuter_data
 * @property array $commuter_data_array
 * @property string $lat
 * @property string $lng
 * @property string $address_realtime
 * @property string $apns_device_reg_id
 * @property boolean $has_agreement
 *
 * @property string $name
 * @property string $phone
 * @property \app\models\Offer $offer
 * @property \app\models\Request[] $requests
 * @property \app\models\RiderHistory[] $riderHistories
 * @property \app\models\TblTripreceipt[] $tblTripreceipts
 *
 */
class Cuser extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'],'required'],
            [['commuter','enrolled'],'number'],
            [['has_agreement'], 'boolean'],
            [['lat', 'lng'], 'number'],
            [['id','first_name','status_description','username'],'string','max'=>80],
            [['cuser_status'], 'string'],
            [['status_code'],'string','max'=>20],
            [['created_at','updated_at'],'string'],
            [['hashed_password'],'string','max'=>28],
            [['email'],'string','max'=>125],
            [['commuter_data'], 'string', 'max' => 8000],
            [['address_realtime'], 'string', 'max' => 800],
            [['apns_device_reg_id'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuser';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'first_name'=>'First Name',
            'status_code'=>'Status Code',
            'status_description'=>'Status Description',
            'commuter'=>'Commuter',
            'hashed_password'=>'Hashed Password',
            'enrolled'=>'Enrolled',
            'email'=>'Email',
            'username'=>'Username',
            'lat' => 'Current Lat',
            'lng' => 'Current Lng',
            'address_realtime' => 'Current Address',
            'has_agreement' => 'Has Agreement',
        ];
    }

      /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(\app\models\Request::className(),['cuser_id'=>'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiderHistories()
    {
        return $this->hasMany(\app\models\RiderHistory::className(), ['cuser_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblTripreceipts()
    {
        return $this->hasMany(\app\models\TblTripreceipt::className(), ['id_rider' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(\app\models\Offer::className(),['cuser_id'=>'id']);
    }

}