<?php

namespace app\models;

use app\models\base\TblTripreceipt as BaseTblTripreceipt;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "tbl_tripreceipt".
 */
class TblTripreceipt extends BaseTblTripreceipt
{
    /**
     * @inheritdoc
     * @return mixed
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
    }

    public static function query_not_completed()
    {
        $active_query = TblTripreceipt::find()->where(["not", ['status' => 'completed']]);
        /** @var ActiveQuery $active_query */
        $sql = $active_query->createCommand()->getRawSql();
        return $active_query;
    }

    public function beforeValidate()
    {
        if (empty($this->status)){
            $this->status = 'pending';
        }
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        $is_mysql = isset(Yii::$app->params['IS_MYSQL']) && Yii::$app->params['IS_MYSQL'] == true;
        $is_pg = isset(Yii::$app->params['IS_PG']) && Yii::$app->params['IS_PG'] == true;
        $is_oracle = isset(Yii::$app->params['IS_ORACLE']) && Yii::$app->params['IS_ORACLE'] == true;

        if ($insert){
            $this->id_trip = uniqid() . uniqid();
        }
        if (empty($this->status)){
            $this->status = 'pending';
        }
        if ($is_oracle){
            $start = \DateTime::createFromFormat('Y-m-d H:i:s', $this->start_datetime);
            if (is_object($start)){
                $this->start_datetime = strtoupper($start->format('d-M-y h.i.s.u A'));
            }//20-SEP-17 08.32.47.411000000 PM
            $end = \DateTime::createFromFormat('Y-m-d H:i:s', $this->end_datetime);
            if (is_object($end)){
                $this->end_datetime = strtoupper($end->format('d-M-y h.i.s.u A'));
            }//20-SEP-17 08.32.47.411000000 PM
        }
        return parent::beforeSave($insert);
    }

    /**
     * Get the trip receipt of a user, using cuser_id
     * Return null if tripreceipt not found
     * If _create_new = true: create a new tripreceipt with cuser_id as driver
     *
     * @param int $cuser_id
     * @param $create_new bool
     * @return mixed
     */
    public static function get_trip_receipt_from_cuser_last_60min($cuser_id = null, $create_new = false)
    {
        $trip = false;
        if (is_null($cuser_id)){
            return $trip;
        }
        $trip_receipt = TblTripreceipt::query_not_completed();
        $trip_receipt->andWhere(['id_driver' => $cuser_id]);
        if ($trip_receipt->count() == 1){
            $trip = $trip_receipt->one();
        } else if ($create_new){
            $trip = new TblTripreceipt();
            $trip->id_driver = $cuser_id;
        }

        return $trip;
    }

    public function print_detail()
    {
        return "Driver: " . $this->driver->name . " | Started on: " . $this->start_datetime;
    }

}
