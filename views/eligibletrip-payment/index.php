<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider
 * @var $model \app\models\EligibletripPayment
 */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Eligibletrip Payment';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="eligibletrip-payment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Eligibletrip Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'id_trip',
            'format' => 'html',
            'label' => 'Trip',
            'value' => function ($model) {
                /** @var \app\models\EligibletripPayment $model */
                return "<a target='_blank' href='/tbl-tripreceipt/view?id=" . $model->trip->trip->id_trip . "' >" . $model->trip->trip->print_detail() . "</a>";
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\VwEligibletrips::find()->asArray()->all(), 'id_trip', 'id_trip'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Vw eligibletrips', 'id' => 'grid--id_trip']
        ],
        ['label' => 'Incentive / Amount($)',
            'attribute' => 'id_incentive',
            'value' => function ($model) {
                /* @var $model \app\models\EligibletripPayment */
                return $model->incentive->pull_detail();
            }],
        'amount',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}'
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-eligibletrip-payment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]),
        ],
    ]); ?>

</div>
