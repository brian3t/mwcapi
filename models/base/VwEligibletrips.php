<?php

namespace app\models\base;

/**
 * This is the base model class for table "vw_eligibletrips".
 *
 * @property string $id_trip
 * @property string $id_incentive
 * @property string $created_at
 *
 * @property \app\models\EligibletripPayment[] $eligibletripPayments
 * @property \app\models\TblIncentive $incentive
 * @property \app\models\TblTripreceipt $trip
 */
class VwEligibletrips extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_trip', 'id_incentive'], 'required'],
            [['created_at'], 'safe'],
            [['id_trip'], 'string', 'max' => 39],
            [['id_incentive'], 'string', 'max' => 26]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_eligibletrips';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_trip' => 'Id Trip',
            'id_incentive' => 'Id Incentive',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEligibletripPayments()
    {
        return $this->hasMany(\app\models\EligibletripPayment::className(), ['id_trip' => 'id_trip', 'id_incentive' => 'id_incentive'])->inverseOf('trip');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncentive()
    {
        return $this->hasOne(\app\models\TblIncentive::className(), ['id_incentive' => 'id_incentive'])->inverseOf('vwEligibletrips');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(\app\models\TblTripreceipt::className(), ['id_trip' => 'id_trip'])->inverseOf('vwEligibletrips');
    }
    }
