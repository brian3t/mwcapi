<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RiderHistory */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="rider-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'cuser_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Cuser::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose Cuser'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'cancelled' => 'Cancelled', 'fulfilled' => 'Fulfilled', 'timeout' => 'Timeout', 'accepted' => 'Accepted', 'onride' => 'Onride', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'dropoff_full_address')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Full Address']) ?>

    <?= $form->field($model, 'dropoff_lat')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Lat']) ?>

    <?= $form->field($model, 'dropoff_lng')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Lng']) ?>

    <?= $form->field($model, 'pickup_full_address')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Full Address']) ?>

    <?= $form->field($model, 'pickup_lat')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Lat']) ?>

    <?= $form->field($model, 'pickup_lng')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Lng']) ?>

    <?= $form->field($model, 'trigger_col')->textInput(['placeholder' => 'Trigger Col']) ?>

    <?= $form->field($model, 'pickup_actual_lat')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Actual Lat']) ?>

    <?= $form->field($model, 'pickup_actual_lng')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Actual Lng']) ?>

    <?= $form->field($model, 'pickup_actual_full_address')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Actual Full Address']) ?>

    <?= $form->field($model, 'dropoff_actual_lat')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Actual Lat']) ?>

    <?= $form->field($model, 'dropoff_actual_lng')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Actual Lng']) ?>

    <?= $form->field($model, 'dropoff_actual_full_address')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Actual Full Address']) ?>

    <?= $form->field($model, 'request_id')->textInput(['maxlength' => true, 'placeholder' => 'Request']) ?>

    <?= $form->field($model, 'rider_id')->textInput(['maxlength' => true, 'placeholder' => 'Rider']) ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => true, 'placeholder' => 'Origin']) ?>

    <?= $form->field($model, 'destination')->textInput(['maxlength' => true, 'placeholder' => 'Destination']) ?>

    <?= $form->field($model, 'time_of_request')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Of Request',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
