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

class CuserController extends BaseActiveController
{
    public $modelClass = 'app\models\Cuser';
    const MAX_COORDS_DIFF = 1;
    const MAX_ITEMS = 5;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
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

    public function actionQuery()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        header("Access-Control-Allow-Origin: *");

        $data = \Yii::$app->request->get('data');

        if (!$data) {
            \Yii::error("Bad input ");
            \Yii::$app->response->setStatusCode(400);
            return;
        }
        //data is array of cuser ids
        $cusers = Cuser::find()->where(['id' => $data])->asArray()->all();
        $result = [];
        foreach ($cusers as $cuser) {
            $commuter_data = json_decode($cuser['commuter_data'], true);
            $name = $cuser['first_name'];
            if (isset($commuter_data['commuterName'])) {
                $name = $commuter_data['commuterName'];
            }
            $phone = '';
            if (isset($commuter_data['hphone'])) {
                $phone = $commuter_data['hphone'];
            }
            $result[$cuser['id']] = [$name, $phone];
        }
        echo json_encode($result);
        return;
    }

    /**
     * @param null $cur_lat
     * @param null $cur_lng
     * @return array All drivers
     */
    public function actionGetDrivers($cur_lat = null, $cur_lng = null)
    {
        if (is_null($cur_lat)) {
            $cur_lat = 38.900571;
        }
        if (is_null($cur_lng)) {
            $cur_lng = -77.008910;
        }


        $drivers = Cuser::find()->select(['id', 'lat', 'lng'])->where(['>=', 'lat', $cur_lat - self::MAX_COORDS_DIFF])
            ->andWhere(['<=', 'lat', $cur_lat + self::MAX_COORDS_DIFF])
            ->andWhere(['>=', 'lng', $cur_lng - self::MAX_COORDS_DIFF,])
            ->andWhere(['<=', 'lng', $cur_lng + self::MAX_COORDS_DIFF])
            ->andWhere(['<>', 'id', \Yii::$app->request->get('rider')])
            ->andWhere(['=', 'cuser_status', 'driver_idle'])//driveridle
            ->limit(self::MAX_ITEMS);
        return $drivers->all();

    }

    public function actionRandom()
    {
        $select = new Query();
        $select->select('username')->from('cuser');
        $all_username = $select->all();
        $key = array_rand($all_username);
        $value = $all_username[$key];
        if (key_exists('username', $value)) {
            $value = $value['username'];
        }
        return $value;
    }

    public function actionReset()
    {
        $result = [];
        $message = '';
        $id = \Yii::$app->request->getBodyParam('id');
        if (is_null($id)) {
            return $result;
        }
        $user = Cuser::findOne($id);
        /** @var Cuser $user */
        if (!is_object($user)) {
            return $result + ['message' => 'Cant find user by id'];
        }
        foreach ($user->requests as $request) {
            $message .= 'Requests deleted' . $request->beforeDelete();
            $request->delete();
        }
        if (is_object($user->offer)) {
            $message .= 'Offer deleted' . $user->offer->beforeDelete();
            $user->offer->delete();
        }
        $user->cuser_status = 'idle';
        $user->save();
//        \Yii::error($message);
        return $result + ['message' => $message];
    }

    /**
     * Note for mike: this is called by app heartbeat. Basically it updates user's current lat and lng (table cuser)
     * When status changes to driver_onride, also log tripreceipt_point //todofuture this can be done inside v1/offerController
     **/
    public function actionUpdate($id)
    {
        /* @var $model Cuser */
        $model = Cuser::find()->where(['id' => $id])->one();
        if (!is_object($model)) {
            return false;
        }
        $old_model = clone $model;

        //updating

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update cuser.');
        } else {
            if ($old_model->cuser_status !== 'driver_onride' && $model->cuser_status == 'driver_onride') {//this is due to driver clicked on rider_pickedup
                $driver = $model;
                $rider = $driver->pull_rider();
                if (!$rider) {
                    return $model;
                }
                /** @var Cuser $rider */
                $request = $rider->pull_request();
                $request->pickup_actual_lat = $driver->lat;
                $request->pickup_actual_lng = $driver->lng;
                $request->pickup_actual_full_address = (!empty($driver->address_realtime) ? $driver->address_realtime : $request->pickup_full_address);
                $request->save();
                $trip_receipt_query = TblTripreceipt::query_not_completed();
                $trip_receipt_query->andWhere(['id_driver' => $driver->id]);
                $sql = $trip_receipt_query->createCommand()->getRawSql();
//                Yii::error("tbl trip receipt query not completed rider picked up: $sql");
                if ($trip_receipt_query->count() > 0) {
                    $trip_receipt = $trip_receipt_query->one();
                } else {
                    $trip_receipt = new TblTripreceipt();
                }
                /** @var $trip_receipt  TblTripreceipt */
                $trip_receipt->actual_start_lat = $request->pickup_actual_lat;
                $trip_receipt->actual_start_lng = $request->pickup_actual_lng;
                $trip_receipt->status = 'onride';
                $trip_receipt->save();
            }
            if ($old_model->cuser_status == 'driver_onride' && $model->cuser_status == 'driver_idle') {//dropping off
                $driver = $model;
                $rider = $driver->pull_rider();
                if (!$rider) {
                    return $model;
                }
                //archive request
                $request = $rider->pull_request();
                if (!is_object($request)) {
                    return $model;
                }
                $request->dropoff_actual_lat = $driver->lat;
                $request->dropoff_actual_lng = $driver->lng;
                $request->dropoff_actual_full_address = $driver->address_realtime;
                $request->save();

                $trip_receipt = TblTripreceipt::query_not_completed();
                $trip_receipt->andWhere(['id_driver' => $driver->id]);
//                Yii::error("tbl trip receipt query not completed dropped off: $sql");
                if ($trip_receipt->count() == 1) {
                    $trip_receipt = $trip_receipt->one();
                } else {
                    $trip_receipt = new TblTripreceipt();
                }
                $trip_receipt->id_driver = $driver->id;
                $trip_receipt->id_rider = $rider->id;
                $trip_receipt->requested_start_lat = $request->pickup_lat;
                $trip_receipt->requested_start_lng = $request->pickup_lng;
                $trip_receipt->requested_end_lat = $request->dropoff_lat;
                $trip_receipt->requested_end_lng = $request->dropoff_lng;
                $trip_receipt->actual_start_lat = $request->pickup_actual_lat;
                $trip_receipt->actual_start_lng = $request->pickup_actual_lng;
                $trip_receipt->actual_end_lat = $request->dropoff_actual_lat;
                $trip_receipt->actual_end_lng = $request->dropoff_actual_lng;
                $now = new \DateTime();
                $trip_receipt->end_datetime = $now->format('Y-m-d H:i:s');
                $trip_receipt->trip_length = Logistic::distance_latlng($trip_receipt->actual_start_lat, $trip_receipt->actual_start_lng,
                    $trip_receipt->actual_end_lat, $trip_receipt->actual_end_lng);
                $trip_receipt->status = 'completed';
                $trip_receipt->save();
            }

            //if driver says he's on ride, save tripreceipt point
            if ($model->cuser_status == 'driver_onride') {
                if (($model->lat != 0) && ($model->lng != 0)) {
//                    $tripreceipt_point = TripreceiptPoint::find()
//                        ->where(['cuser_id' => $model->id, 'id_trip' => null, 'lat' => $model->lat, 'lng' => $model->lng]);
//                    if (!$tripreceipt_point instanceof TripreceiptPoint) {
                    $tripreceipt_point = new TripreceiptPoint();
                    $tripreceipt_point->cuser_id = $model->id;
                    $tripreceipt_point->lat = $model->lat;
                    $tripreceipt_point->lng = $model->lng;
                    try {
                        $tripreceipt_point->save();
                    } catch (\yii\db\Exception $exception) {
                        Yii::error($exception);//ignore, probably just a duplicate
                        //todob enable debugging
                        Yii::error("triprecipt point vlidation");
                        Yii::error($tripreceipt_point->errors);
                    }
//                    }
                }
            }
        }

        // START - GIS incentive region function check
        $now = new \DateTime();

        // sample calls >>
        // select CHECK_INCENTIVEREGION(39.2081402,-76.8819393,123456,30000,'01-OCT-17 07.24.56.922000000 PM') from dual;
        // execute APP_HEARTBEAT(39.2081402,-76.8819393,'123456','59d025eabc31559d025eabc31a','01-OCT-17 07.24.56.922000000 PM');

        // TODO: pass real data into this oracle procedure call
        $driver = $model;
        $rider = $driver->pull_rider();
        if (!$rider) {
            return $model;
        }
        /** @var Cuser $rider */
        $request = $rider->pull_request();
        if (!is_object($request)) {
            return $model;
        }
        $trip_receipt = TblTripreceipt::get_trip_receipt_from_cuser_last_60min($driver->id);
        $is_mysql = isset(Yii::$app->params['IS_MYSQL']) && Yii::$app->params['IS_MYSQL'] == true;
        $is_oracle = isset(Yii::$app->params['IS_ORACLE']) && Yii::$app->params['IS_ORACLE'] == true;
        if (!$is_mysql && $is_oracle && is_object($trip_receipt)) {//only does this in Oracle DB
            $result = \Yii::$app->db->createCommand("call APP_HEARTBEAT(:lat, :lng, :driver_id, :trip_id)")
                ->bindValue(':lat', $driver->lat)
                ->bindValue(':lng', $driver->lng)
                ->bindValue(':driver_id', $driver->id)
                ->bindValue(':trip_id', $trip_receipt->id_trip)
                ->execute();
            Yii::error(json_encode($result));
        }
        // END - GIS incentive region function check

        return $model;
    }

    /**
     * View a cuser (single get)
     * 12/03 quickfix: make has_agreement 0 / 1 instead of true/false
     */
    public function actionView($id)
    {
        $model = Cuser::findOne($id);

        $model->has_agreement = $model->has_agreement ? 1 : 0;
        return $model;

    }
}



