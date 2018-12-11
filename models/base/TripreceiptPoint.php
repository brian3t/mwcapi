<?php

namespace app\models\base;

/**
 * This is the base model class for table "tripreceipt_point".
 *
 * @property string $id
 * @property string $cuser_id
 * @property string $id_trip
 * @property string $lat
 * @property string $lng
 * @property string $created_at
 *
 * @property \app\models\Request $request
 * @property \app\models\TblTripreceipt $trip
 */
class TripreceiptPoint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lat', 'lng'], 'required'],
            [['lat', 'lng'], 'number'],
            [['created_at'], 'safe'],
            [['id'], 'string', 'max' => 26],
            [['cuser_id'], 'string', 'max' => 36],
            [['id_trip'], 'string', 'max' => 39]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tripreceipt_point';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuser_id' => 'Cuser ID',
            'id_trip' => 'Id Trip',
            'lat' => 'Lat',
            'lng' => 'Lng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(\app\models\Request::className(), ['cuser_id' => 'cuser_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(\app\models\TblTripreceipt::className(), ['id_trip' => 'id_trip']);
    }

}
