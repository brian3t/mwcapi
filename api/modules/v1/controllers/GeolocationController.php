<?php

namespace app\api\modules\v1\controllers;

use app\api\base\controllers\BaseActiveController;
use app\helpers\Logistic;
use app\models\Cuser;
use app\models\Geolocation;
use app\models\TblTripreceipt;
use app\models\TripreceiptPoint;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\web\ServerErrorHttpException;

class GeolocationController extends BaseActiveController
{
    public $modelClass = 'app\models\Geolocation';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Methods' => ['GET', 'POST', 'OPTIONS', 'DELETE', 'PUT', 'PATCH'],
                    'Access-Control-Request-Headers' => ['Content-Type']
                ],
            ],
        ], parent::behaviors());
    }

    public function actionCreate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $new_geolocation = null;
        $entityBody = file_get_contents('php://input');
        try {
//            Yii::error($entityBody);
//            return $entityBody;
            $entityBody = json_decode($entityBody, true);
            if (is_array($entityBody)) {
                $new_geolocation = array_pop($entityBody);
            } else {
                return false;
            }
//            unset ($new_geolocation['speed'], $new_geolocation['bearing'], $new_geolocation['locationProvider']);
            //convert time from epoch to timestamp
            if (isset($new_geolocation['time'])) {
                try {
                    $datetime_obj = (new \DateTime())->setTimestamp(substr($new_geolocation['time'], 0, -3))
                        ->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                    $time_string = $datetime_obj->format('Y-m-d h:i:s');
                    $new_geolocation['time'] = $time_string;
                } catch (\Exception $e) {
                    $new_geolocation['time'] = null;
                }
            }
            $new_geol = new Geolocation();
            $new_geol->setAttributes($new_geolocation);
            $save_result = false;
            try {
                $save_result = $new_geol->save();
            } catch (\Exception $exception) {
                Yii::error(json_encode($exception->getMessage()));
            }
            if (!$save_result) {
                Yii::error(json_encode($new_geol->errors));
            }
        } catch (Exception $e) {
            \Yii::error("Bad input " . $e->getMessage());
            \Yii::$app->response->setStatusCode(400);
            return;
        }
    }

}



