<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Geolocation */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="geolocation-form">

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

    <?= $form->field($model, 'latitude')->textInput(['placeholder' => 'Latitude']) ?>

    <?= $form->field($model, 'longitude')->textInput(['placeholder' => 'Longitude']) ?>

    <?= $form->field($model, 'accuracy')->textInput(['placeholder' => 'Accuracy']) ?>

    <?= $form->field($model, 'provider')->textInput(['maxlength' => true, 'placeholder' => 'Provider']) ?>

    <?= $form->field($model, 'altitude')->textInput(['placeholder' => 'Altitude']) ?>

    <?= $form->field($model, 'time')->textInput(['placeholder' => 'Time']) ?>

    <?= $form->field($model, 'commuter_id')->textInput(['placeholder' => 'Commuter']) ?>

    <?= $form->field($model, 'trip_id')->textInput(['maxlength' => true, 'placeholder' => 'Trip']) ?>

    <?= $form->field($model, 'start_lat')->textInput(['placeholder' => 'Start Lat']) ?>

    <?= $form->field($model, 'start_lng')->textInput(['placeholder' => 'Start Lng']) ?>

    <?= $form->field($model, 'end_lat')->textInput(['placeholder' => 'End Lat']) ?>

    <?= $form->field($model, 'end_lng')->textInput(['placeholder' => 'End Lng']) ?>

    <?= $form->field($model, 'is_end_of_trip')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
