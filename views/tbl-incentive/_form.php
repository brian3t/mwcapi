<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblIncentive */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'VwEligibletrips', 
        'relID' => 'vw-eligibletrips', 
        'value' => \yii\helpers\Json::encode($model->vwEligibletrips),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="tbl-incentive-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true, 'placeholder' => 'Region']) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'incentive_cap')->textInput(['maxlength' => true, 'placeholder' => 'Incentive Cap']) ?>

    <?= $form->field($model, 'incentive_amount')->textInput(['maxlength' => true, 'placeholder' => 'Incentive Amount']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('VwEligibletrips'),
            'content' => $this->render('_formVwEligibletrips', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->vwEligibletrips),
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
    </div>

    <?php ActiveForm::end(); ?>

</div>
