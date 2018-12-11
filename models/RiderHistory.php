<?php

namespace app\models;

use app\models\base\RiderHistory as BaseRiderHistory;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "rider_history".
 */
class RiderHistory extends BaseRiderHistory
{

    public function beforeValidate()
    {
        if(empty($this->id))
        {
            $this->id=uniqid() . uniqid();
        }
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        $is_mysql = isset(Yii::$app->params['IS_MYSQL']) && Yii::$app->params['IS_MYSQL'] == true;
        $is_pg = isset(Yii::$app->params['IS_PG']) && Yii::$app->params['IS_PG'] == true;
        $is_oracle = isset(Yii::$app->params['IS_ORACLE']) && Yii::$app->params['IS_ORACLE'] == true;

        if ($is_mysql) {
            return [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => false,
                    'updatedAtAttribute' => 'updated_at',
                    'value' => new \yii\db\Expression('NOW()'),
                ],
            ];

        }
        if ($is_oracle){
            return [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => false,
                    'updatedAtAttribute' => 'updated_at',
                    'value' => new \yii\db\Expression('SYSDATE'),
                ],
            ];
        }
        if ($is_pg){
            return [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => false,
                    'updatedAtAttribute' => 'updated_at',
                    'value' => new \yii\db\Expression('current_timestamp'),
                ],
            ];
        }
        return [];
    }
	
}
