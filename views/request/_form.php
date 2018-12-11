<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */

//\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END,
//    'viewParams' => [
//        'class' => 'Offer',
//        'relID' => 'offer',
//        'value' => \yii\helpers\Json::encode($model->offers),
//        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
//    ]
//]);
//>
?>
<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'cuser_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Cuser::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose Cuser'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'cancelled' => 'Cancelled', 'fulfilled' => 'Fulfilled', 'timeout' => 'Timeout', 'accepted' => 'Accepted', 'onride' => 'Onride', ]) ?>

    <?= $form->field($model, 'dropoff_full_address')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Full Address']) ?>

    <?= $form->field($model, 'dropoff_lat')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Lat']) ?>

    <?= $form->field($model, 'dropoff_lng')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Lng']) ?>

    <?= $form->field($model, 'pickup_full_address')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Full Address']) ?>

    <?= $form->field($model, 'pickup_lat')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Lat']) ?>

    <?= $form->field($model, 'pickup_lng')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Lng']) ?>

    <?= $form->field($model, 'pickup_actual_lat')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Actual Lat']) ?>

    <?= $form->field($model, 'pickup_actual_lng')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Actual Lng']) ?>

    <?= $form->field($model, 'pickup_actual_full_address')->textInput(['maxlength' => true, 'placeholder' => 'Pickup Actual Full Address']) ?>

    <?= $form->field($model, 'dropoff_actual_lat')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Actual Lat']) ?>

    <?= $form->field($model, 'dropoff_actual_lng')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Actual Lng']) ?>

    <?= $form->field($model, 'dropoff_actual_full_address')->textInput(['maxlength' => true, 'placeholder' => 'Dropoff Actual Full Address']) ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => true, 'placeholder' => 'Origin']) ?>

    <?= $form->field($model, 'destination')->textInput(['maxlength' => true, 'placeholder' => 'Destination']) ?>
    <?php /*= $form->field($model, 'time_of_request')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Of Request',
                'autoclose' => true,
            ]
        ],
    ]); */?>

    <div class="form-group" id="add-offer"></div>
    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('Offer'),
            'content' => $this->render('_formOffer', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->offers),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('TripreceiptPoint'),
            'content' => $this->render('_formTripreceiptPoint', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->tripreceiptPoints),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'),['index'],['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
