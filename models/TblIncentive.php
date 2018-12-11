<?php

namespace app\models;

use \app\models\base\TblIncentive as BaseTblIncentive;

/**
 * This is the model class for table "tbl_incentive".
 */
class TblIncentive extends BaseTblIncentive
{
    public function beforeValidate()
    {
        if (empty($this->id_incentive)){
            $this->id_incentive = uniqid().uniqid();
        }
        return parent::beforeValidate();
    }

    public static $COLUMNS = ['id_incentive','name','region','status','incentive_cap','incentive_amount','created_at','updated_at'];

    public function pull_detail(){
        return implode(', ', [$this->name, $this->incentive_amount]);
    }
}
