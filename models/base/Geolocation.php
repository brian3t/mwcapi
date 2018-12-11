<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "geolocation".
 *
 * @property string $id
 * @property string $cuser_id
 * @property string $created_at
 * @property string $lat
 * @property string $lng
 * @property string $device_id
 * @property integer $accuracy
 *
 * @property \app\models\Cuser $cuser
 */
class Geolocation extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuser_id'], 'required'],
            [['created_at'], 'safe'],
            [['lat', 'lng'], 'number'],
            [['accuracy'], 'integer'],
            [['id', 'cuser_id'], 'string', 'max' => 26],
            [['device_id'], 'string', 'max' => 80]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geolocation';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuser_id' => 'Cuser ID',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'device_id' => 'Device ID',
            'accuracy' => 'Accuracy',
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
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null,
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
}
