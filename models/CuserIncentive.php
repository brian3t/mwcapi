<?php

namespace app\models;

use \app\models\base\CuserIncentive as BaseCuserIncentive;

/**
 * This is the model class for table "cuser_incentive".
 */
class CuserIncentive extends BaseCuserIncentive
{
    /**
     * @inheritdoc
     */
    /*public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['cuser_id', 'id_incentive'], 'required'],
            [['created_at'], 'safe'],
            [['cuser_id'], 'string', 'max' => 36],
            [['id_incentive'], 'string', 'max' => 26],
        ]);
    }*/
	
}
