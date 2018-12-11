<?php

namespace app\models;

use app\models\base\VwEligibletrips as BaseVwEligibletrips;

/**
 * This is the model class for table "vw_eligibletrips".
 *
 * @property string $trip_detail
 */
class VwEligibletrips extends BaseVwEligibletrips
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['id_trip', 'id_incentive'], 'required'],
                [['created_at'], 'safe'],
                [['id_trip'], 'string', 'max' => 39],
                [['id_incentive'], 'string', 'max' => 26]
            ]);
    }

    public function getIncentive()
    {
        return parent::getIncentive()->select(\app\models\TblIncentive::$COLUMNS);//this is to avoid Oracle columns such as SDO_GEOMETRY. php oci does not support that
    }

    public function getTrip_detail()
    {
        return $this->trip->print_detail();
    }

    /**
     * @return int
     */
    public function paid_amt()
    {
        $paid_amt = 0;
        foreach ($this->eligibletripPayments as $eligibletripPayment){
            $paid_amt += floatval($eligibletripPayment->amount);
        }
        return $paid_amt;
    }

}
