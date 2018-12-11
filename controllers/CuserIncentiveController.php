<?php

namespace app\controllers;

use Yii;
use app\models\CuserIncentive;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuserIncentiveController implements the CRUD actions for CuserIncentive model.
 */
class CuserIncentiveController extends Controller
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
     * Lists all CuserIncentive models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CuserIncentive::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuserIncentive model.
     * 
     * @return mixed
     */
    public function actionView($cuser_id, $id_incentive)
    {
        try {
            $model = $this->findModel($cuser_id, $id_incentive);
            return $this->render('view', [
                'model' => $this->findModel($cuser_id, $id_incentive),
            ]);
        } catch (\Exception $e){
            return $this->redirect(['index']);
        }
    }

    /**
     * Creates a new CuserIncentive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new CuserIncentive();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CuserIncentive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionUpdate($cuser_id, $id_incentive)
    {
        $model = $this->findModel($cuser_id, $id_incentive);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CuserIncentive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @return mixed
     */
    public function actionDelete($cuser_id, $id_incentive)
    {
        $this->findModel($cuser_id, $id_incentive)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the CuserIncentive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @return CuserIncentive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cuser_id, $id_incentive)
    {
        if (($model = CuserIncentive::findOne([])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
