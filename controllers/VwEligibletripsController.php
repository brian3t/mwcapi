<?php

namespace app\controllers;

use app\models\VwEligibletrips;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * VwEligibletripsController implements the CRUD actions for VwEligibletrips model.
 */
class VwEligibletripsController extends Controller
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
     * Lists all VwEligibletrips models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => VwEligibletrips::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VwEligibletrips model.
     * 
     * @return mixed
     */
    public function actionView($id_trip)
    {
        $model = $this->findModel(['id_trip'=>$id_trip]);
        return $this->render('view', [
            'model' => $this->findModel($id_trip),
        ]);
    }

    /**
     * Creates a new VwEligibletrips model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VwEligibletrips();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VwEligibletrips model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionUpdate($id_trip)
    {
        $model = $this->findModel(['id_trip'=>$id_trip]);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing VwEligibletrips model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @return mixed
     */
    public function actionDelete($id_trip)
    {
        $this->findModel(['id_trip'=>$id_trip])->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the VwEligibletrips model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @return VwEligibletrips the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_trip)
    {
        if (($model = VwEligibletrips::findOne(['id_trip'=>$id_trip])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for EligibletripPayment
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionAddEligibletripPayment()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('EligibletripPayment');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formEligibletripPayment', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
