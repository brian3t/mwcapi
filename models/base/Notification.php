<?php

namespace app\models\base;

use mootensai\behaviors\UUIDBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "notification".
 *
 * @property string $id
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $concluded_at
 * @property string $type
 * @property string $apns_id
 * @property string $message_sent
 * @property string $server_reply
 *
 * @property \app\models\Cuser $user
 */
class Notification extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['created_at', 'updated_at', 'concluded_at'], 'safe'],
            [['id', 'user_id'], 'string', 'max' => 36],
            [['type', 'message_sent'], 'string', 'max' => 255],
            [['apns_id'], 'string', 'max' => 80],
            [['server_reply'], 'string', 'max' => 2000]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'concluded_at' => 'Concluded At',
            'type' => 'Type',
            'apns_id' => 'Apns ID',
            'message_sent' => 'Message Sent',
            'server_reply' => 'Server Reply',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\Cuser::className(), ['id' => 'user_id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        $behaviors = [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
        $is_mysql = isset(Yii::$app->params['IS_MYSQL']) && Yii::$app->params['IS_MYSQL'] == true;
        $is_pg = isset(Yii::$app->params['IS_PG']) && Yii::$app->params['IS_PG'] == true;
        $is_oracle = isset(Yii::$app->params['IS_ORACLE']) && Yii::$app->params['IS_ORACLE'] == true;

        if ($is_mysql) {
            $behaviors[] =
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created_at',
                    'updatedAtAttribute' => 'updated_at',
                    'value' => new \yii\db\Expression('NOW()'),
                ];

        }
        if ($is_oracle) {
            $behaviors[] =
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created_at',
                    'updatedAtAttribute' => 'updated_at',
                    'value' => new \yii\db\Expression('SYSDATE'),
                ];
        }
        if ($is_pg) {
            $behaviors[] =
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created_at',
                    'updatedAtAttribute' => 'updated_at',
                    'value' => new \yii\db\Expression('current_timestamp'),
                ];
        }
        return $behaviors;
    }
}
