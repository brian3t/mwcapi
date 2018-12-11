<?php

namespace app\models;

use app\models\base\EligibletripPayment as BaseEligibletripPayment;

/**
 * This is the model class for table "eligibletrip_payment".
 *
 */
class EligibletripPayment extends BaseEligibletripPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'id_trip', 'id_incentive'], 'required'],
            [['amount'], 'number'],
            [['id', 'id_incentive'], 'string', 'max' => 26],
            [['id_trip'], 'string', 'max' => 39]
        ]);
    }

    public function beforeValidate()
    {
        if (empty($this->id)){
            $this->id = uniqid() . uniqid();
        }
        return parent::beforeValidate();
    }

}
