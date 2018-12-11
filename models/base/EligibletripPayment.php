<?php

namespace app\models\base;

/**
 * This is the base model class for table "eligibletrip_payment".
 *
 * @property string $id
 * @property string $id_trip
 * @property string $id_incentive
 * @property string $amount
 *
 * @property \app\models\VwEligibletrips $trip
 * @property \app\models\TblIncentive $incentive
 */
class EligibletripPayment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_trip', 'id_incentive'], 'required'],
            [['amount'], 'number'],
            [['id', 'id_incentive'], 'string', 'max' => 26],
            [['id_trip'], 'string', 'max' => 39]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eligibletrip_payment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_trip' => 'Id Trip',
            'id_incentive' => 'Id Incentive',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(\app\models\VwEligibletrips::className(), ['id_trip' => 'id_trip'])->inverseOf('eligibletripPayments');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncentive()
    {
        $query = $this->hasOne(\app\models\TblIncentive::className(), ['id_incentive' => 'id_incentive']);
        $query->select('name, region, status, incentive_cap, incentive_amount, created_at, updated_at');
        return $query;
    }

}
