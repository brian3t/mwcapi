<?php

namespace app\controllers;

use Yii;
use app\models\TblTripreceipt;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TblTripreceiptController implements the CRUD actions for TblTripreceipt model.
 */
class TblTripreceiptController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TblTripreceipt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblTripreceipt::find()->orderBy(['start_datetime' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblTripreceipt model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblTripreceipt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblTripreceipt();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()){
            return $this->redirect(['view', 'id' => $model->id_trip]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblTripreceipt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!Yii::$app->params['IS_MYSQL']){
            $start = \DateTime::createFromFormat('d-M-y h.i.s.u A', strtolower($model->start_datetime));
            $model->start_datetime = $start->format('Y-m-d H:i:s');
            $end = \DateTime::createFromFormat('d-M-y h.i.s.u A', strtolower($model->end_datetime));
            $model->end_datetime = $end->format('Y-m-d H:i:s');
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()){
            return $this->redirect(['view', 'id' => $model->id_trip]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblTripreceipt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }


    /**
     * Finds the TblTripreceipt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblTripreceipt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblTripreceipt::findOne($id)) !== null){
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
