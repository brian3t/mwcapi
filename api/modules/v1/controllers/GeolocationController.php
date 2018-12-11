<?php

namespace app\api\modules\v1\controllers;

use app\api\base\controllers\BaseActiveController;
use app\helpers\Logistic;
use app\models\Cuser;
use app\models\TblTripreceipt;
use app\models\TripreceiptPoint;
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
        header("Access-Control-Allow-Origin: *");

        $entityBody = file_get_contents('php://input');
        try {
//            Yii::error($entityBody);
//            return $entityBody;
            $entityBody = json_decode($entityBody);
            //if cuser exists, return its id
            if (property_exists($entityBody, 'commuter')) {
                $cuser = Cuser::find()->where(array('username' => ucwords($entityBody->username)))->one();
                if (is_object($cuser) && isset($cuser->id)) {
                    /** @var Cuser $cuser */
                    if (property_exists($entityBody, 'commuter_data')) {
                        $cuser->commuter_data = $entityBody->commuter_data;
                        if (!$cuser->save()) {
                            \Yii::error("Failed saving cuser " . json_encode($cuser));
                        };
                    }
                    echo '{"status":"successful", "id":"' . $cuser->id . '"}';
                    \Yii::$app->response->setStatusCode(200);
                    return;
                }
            }
            //else, try creating one
            $new_cuser = new Cuser();
            $new_cuser->load(['Cuser' => (array)$entityBody]);
            try {
                $new_cuser->save();
                echo '{"status":"successful", "id":"' . $new_cuser->id . '"}';
                \Yii::$app->response->setStatusCode(201);
                return;
            } catch (Exception $e) {
                \Yii::error("Cant create new cuser " . json_encode($entityBody) . $e->getMessage());
                \Yii::$app->response->setStatusCode(400);
                return;
            }
        } catch (Exception $e) {
            \Yii::error("Bad input " . $e->getMessage());
            \Yii::$app->response->setStatusCode(400);
            return;
        }
    }

}



