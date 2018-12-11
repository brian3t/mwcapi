<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "tbl_incentive".
 *
 * @property string $id_incentive
 * @property string $name
 * @property string $region
 * @property integer $status
 * @property string $incentive_cap
 * @property string $incentive_amount
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\VwEligibletrips[] $vwEligibletrips
 */
class TblIncentive extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_incentive'], 'required'],
            [['status'], 'integer'],
            [['incentive_cap', 'incentive_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['id_incentive'], 'string', 'max' => 26],
            [['name'], 'string', 'max' => 50],
            [['region'], 'string', 'max' => 800]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_incentive';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_incentive' => 'Id Incentive',
            'name' => 'Name',
            'region' => 'Region',
            'status' => 'Status',
            'incentive_cap' => 'Incentive Cap',
            'incentive_amount' => 'Incentive Amount',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVwEligibletrips()
    {
        return $this->hasMany(\app\models\VwEligibletrips::className(), ['id_incentive' => 'id_incentive'])->inverseOf('incentive');
    }
    }
