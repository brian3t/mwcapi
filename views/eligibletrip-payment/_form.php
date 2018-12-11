<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EligibletripPayment */
/* @var $form yii\widgets\ActiveForm */
/* @var $default_incen_id int */

?>

<div class="eligibletrip-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_trip')->label('Eligible Trip')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\VwEligibletrips::find()->orderBy('id_trip')->all(), 'id_trip', 'trip_detail'),
        'options' => ['placeholder' => 'Choose Eligibletrip'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_incentive')->label('Incentive')
        ->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\TblIncentive::find()->asArray()->select('id_incentive, name')->all(), 'id_incentive', 'name'), ['readonly' => true, 'value' => $default_incen_id]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'placeholder' => 'Amount']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
