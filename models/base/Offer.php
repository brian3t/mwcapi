<?php

namespace app\models\base;

use mootensai\behaviors\UUIDBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "offer".
 *
 * @property string $cuser_id
 * @property string $request_cuser
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 *
 * @property \app\models\Cuser $requestCuser
 * @property \app\models\Cuser $cuser
 * @property \app\models\TripreceiptPoint[] $tripreceiptPoints
 */
class Offer extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuser_id', 'request_cuser'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'string'],
            [['cuser_id', 'request_cuser'], 'string', 'max' => 26]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cuser_id' => 'Cuser ID',
            'request_cuser' => 'Request Cuser',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestCuser()
    {
        return $this->hasOne(\app\models\Cuser::className(), ['id' => 'request_cuser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuser()
    {
        return $this->hasOne(\app\models\Cuser::className(), ['id' => 'cuser_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTripreceiptPoints()
    {
        return $this->hasMany(\app\models\TripreceiptPoint::className(), ['cuser_id' => 'cuser_id']);
    }

    /**
     * @inheritdoc
     * @return mixed
     */
    public function behaviors()
    {
        $behaviors = [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
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
