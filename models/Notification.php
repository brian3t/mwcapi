<?php

namespace app\models;

use app\models\base\Notification as BaseNotification;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "notification".
 */
class Notification extends BaseNotification
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
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id'], 'required'],
            [['created_at', 'updated_at', 'concluded_at'], 'safe'],
            [['user_id'], 'string', 'max' => 36],
            [['type', 'message_sent'], 'string', 'max' => 255],
            [['apns_id'], 'string', 'max' => 80],
            [['server_reply'], 'string', 'max' => 2000]
        ]);
    }

    public function beforeValidate()
    {
        if(empty($this->id))
        {
            $this->id=uniqid() . uniqid();
        }
        if (!is_string($this->message_sent)){
            $this->message_sent = '';
        }
        if (!is_string($this->server_reply)){
            $this->server_reply = '';
        }
        return parent::beforeValidate();
    }

}
