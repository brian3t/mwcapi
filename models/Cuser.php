<?php

namespace app\models;

use app\models\base\Cuser as BaseCuser;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cuser".
 */
class Cuser extends BaseCuser
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

            ];
        }
        return [];
    }

    public function beforeValidate()
    {
        if (empty($this->id)) {
            $this->id = uniqid() . uniqid();
        }
        return parent::beforeValidate();
    }

    public function getCommuter_data_array()
    {
        try {
            return json_decode($this->commuter_data, true);
        } catch (\Exception $e) {
            error("Bad commuter data. Message: {$e->getMessage()}. Cuser: " . json_encode($this->attributes));
            return '';
        }
    }

    public function getName()
    {
        $name = $this->first_name;

        if (isset($this->commuter_data_array['commuterName'])) {
            $name = $this->commuter_data_array['commuterName'];
        }
        return $name;
    }

    public function getPhone()
    {
        $phone = '';
        if (isset($this->commuter_data_array['hphone'])) {
            $phone = $this->commuter_data_array['hphone'];
        }
        return $phone;
    }

    public function fields()
    {
        $fields = parent::fields();
//        unset($fields['updated_at']);
        return array_merge(['name', 'phone'], $fields);
    }

    public function getUsername_and_id()
    {
        return $this->username . ' - ' . $this->id;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        //check to see if other cusers are holding the same apns_device_reg_id. If they do, clear them.
        $connection = Yii::$app->getDb();
        if (isset(Yii::$app->params['IS_MYSQL']) && Yii::$app->params['IS_MYSQL'] == true) {
            $sql = 'UPDATE cuser SET apns_device_reg_id = NULL WHERE apns_device_reg_id = :apns AND id != :id ;';
            $command = $connection->createCommand($sql, [':apns' => $this->apns_device_reg_id, ':id' => $this->id]);
        } else {
            $sql = ' UPDATE "cuser" SET "apns_device_reg_id" = NULL WHERE "apns_device_reg_id" = \'' . $this->apns_device_reg_id . '\' AND "id" != \'' . $this->id . '\' ';
            $command = $connection->createCommand($sql);
        }

        //0818 quickfix to link with incentive 10002 MWCOG
        if (isset($changedAttributes['has_agreement'])) {
            if ($this->has_agreement) {
                $cuser_incen = new CuserIncentive();
                $cuser_incen->id_incentive = '10002';
                $cuser_incen->cuser_id = $this->id;
                try {
                    $cuser_incen->save();
                } catch (\Exception $exception) {
                    Yii::error($exception);
                }
            } else {
                \app\models\base\CuserIncentive::deleteAll(['cuser_id' => $this->id, 'id_incentive' => '10002']);
            }
        }
        //end 0818 quickfix to link with incentive 10002 MWCOG
    }

    /**
     * Pulls the rider that this cuser is driving
     * @return mixed false if there is no rider (this cuser is not a driver). \Cuser object, if there is a rider
     */
    public function pull_rider()
    {
        $offer = $this->offer;
        if (!is_object($offer)) {
            return false;
        }
        return $offer->requestCuser;
    }

    public function pull_request()
    {
        if (count($this->requests) !== 1) {
            return false;
        }
        $requests = $this->requests;
        return (is_array($requests) ? $requests[0] : false);
    }
}
