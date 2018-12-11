<?php

namespace app\models;

use app\models\base\TripreceiptPoint as BaseTripreceiptPoint;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tripreceipt_point".
 */
class TripreceiptPoint extends BaseTripreceiptPoint
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function beforeValidate()
    {
        if (empty($this->id)) {
            $this->id = uniqid() . uniqid();
        }
        if (empty($this->cuser_id)) {
            $this->cuser_id = null;
        }
        return parent::beforeValidate();
    }

    public function behaviors()
    {
        $is_mysql = isset(Yii::$app->params['IS_MYSQL']) && Yii::$app->params['IS_MYSQL'] == true;
        $is_pg = isset(Yii::$app->params['IS_PG']) && Yii::$app->params['IS_PG'] == true;
        $is_oracle = isset(Yii::$app->params['IS_ORACLE']) && Yii::$app->params['IS_ORACLE'] == true;

        if ($is_oracle) {
            return [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => false,
                    'updatedAtAttribute' => 'created_at',
                    'value' => new \yii\db\Expression('SYSDATE'),
                ],
            ];
        }
        return [];
    }
}
