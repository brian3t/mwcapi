<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "cuser_incentive".
 *
 * @property string $cuser_id
 * @property string $id_incentive
 * @property string $created_at
 *
 * @property \app\models\Cuser $cuser
 * @property \app\models\TblIncentive $incentive
 */
class CuserIncentive extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuser_id', 'id_incentive'], 'required'],
            [['created_at'], 'safe'],
            [['cuser_id'], 'string', 'max' => 36],
            [['id_incentive'], 'string', 'max' => 26],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuser_incentive';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cuser_id' => 'Cuser ID',
            'id_incentive' => 'Id Incentive',
        ];
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
    public function getIncentive()
    {
        return $this->hasOne(\app\models\TblIncentive::className(), ['id_incentive' => 'id_incentive']);
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
                    'createdAtAttribute' => 'created_at',
                    'value' => new \yii\db\Expression('NOW()'),
                ],
            ];

        }
        if ($is_oracle){
            return [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created_at',
                    'value' => new \yii\db\Expression('SYSDATE'),
                ],
            ];
        }
        if ($is_pg){
            return [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created_at',
                    'value' => new \yii\db\Expression('current_timestamp'),
                ],
            ];
        }
        return [];
    }
}
