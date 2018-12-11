<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TripreceiptPoint */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tripreceipt-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'cuser_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Request::find()->orderBy('cuser_id')->asArray()->all(), 'cuser_id', 'cuser_id'),
        'options' => ['placeholder' => 'Choose Request'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_trip')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\TblTripreceipt::find()->orderBy('id_trip')->asArray()->all(), 'id_trip', 'id_trip'),
        'options' => ['placeholder' => 'Choose Tbl tripreceipt'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'lat')->textInput(['maxlength' => true, 'placeholder' => 'Lat']) ?>

    <?= $form->field($model, 'lng')->textInput(['maxlength' => true, 'placeholder' => 'Lng']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
