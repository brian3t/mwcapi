<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-cuser-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

    <?= $form->field($model, 'cuser_status')->dropDownList([ 'offline' => 'Offline', 'idle' => 'Idle', 'rider_idle' => 'Rider idle', 'rider_requested' => 'Rider requested', 'rider_accepted' => 'Rider accepted', 'rider_pickedup' => 'Rider pickedup', 'driver_idle' => 'Driver idle', 'driver_offered' => 'Driver offered', 'driver_onride' => 'Driver onride', 'driver_enroute' => 'Driver enroute', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status_code')->textInput(['maxlength' => true, 'placeholder' => 'Status Code']) ?>

    <?= $form->field($model, 'status_description')->textInput(['maxlength' => true, 'placeholder' => 'Status Description']) ?>

    <?php /* echo $form->field($model, 'commuter')->textInput(['placeholder' => 'Commuter']) */ ?>

    <?php /* echo $form->field($model, 'hashed_password')->textInput(['maxlength' => true, 'placeholder' => 'Hashed Password']) */ ?>

    <?php /* echo $form->field($model, 'enrolled')->textInput(['placeholder' => 'Enrolled']) */ ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) */ ?>

    <?php echo $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>

    <?php /* echo $form->field($model, 'commuter_data')->textInput(['maxlength' => true, 'placeholder' => 'Commuter Data']) */ ?>

    <?php /* echo $form->field($model, 'lat')->textInput(['maxlength' => true, 'placeholder' => 'Lat']) */ ?>

    <?php /* echo $form->field($model, 'lng')->textInput(['maxlength' => true, 'placeholder' => 'Lng']) */ ?>

    <?php /* echo $form->field($model, 'address_realtime')->textInput(['maxlength' => true, 'placeholder' => 'Address Realtime']) */ ?>

    <?php /* echo $form->field($model, 'apns_device_reg_id')->textInput(['maxlength' => true, 'placeholder' => 'Apns Device Reg']) */ ?>

    <?php /* echo $form->field($model, 'has_agreement')->checkbox() */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
