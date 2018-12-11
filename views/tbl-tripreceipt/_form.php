<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblTripreceipt */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tbl-tripreceipt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_driver')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Cuser::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose Cuser'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_rider')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Cuser::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose Cuser'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'onride' => 'Onride', 'completed' => 'Completed', 'rider_cancelled' => 'Rider cancelled', 'driver_cancelled' => 'Driver cancelled', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'requested_start_lat')->textInput(['placeholder' => 'Requested Start Lat']) ?>

    <?= $form->field($model, 'requested_start_lng')->textInput(['placeholder' => 'Requested Start Lng']) ?>

    <?= $form->field($model, 'requested_end_lat')->textInput(['placeholder' => 'Requested End Lat']) ?>

    <?= $form->field($model, 'requested_end_lng')->textInput(['placeholder' => 'Requested End Lng']) ?>

    <?= $form->field($model, 'actual_start_lat')->textInput(['placeholder' => 'Actual Start Lat']) ?>

    <?= $form->field($model, 'actual_start_lng')->textInput(['placeholder' => 'Actual Start Lng']) ?>

    <?= $form->field($model, 'actual_end_lat')->textInput(['placeholder' => 'Actual End Lat']) ?>

    <?= $form->field($model, 'actual_end_lng')->textInput(['placeholder' => 'Actual End Lng']) ?>

    <?= $form->field($model, 'start_datetime')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Start Datetime',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'end_datetime')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose End Datetime',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'trip_length')->textInput(['placeholder' => 'Trip Length']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
