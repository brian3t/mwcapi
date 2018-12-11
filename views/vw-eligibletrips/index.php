<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \app\models\VwEligibletrips */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Vw Eligibletrips';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="vw-eligibletrips-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <?/*= Html::a('Create Eligibletrips', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        [
            'attribute' => 'id_trip',
            'label' => 'Trip',
            'format' => 'html',
            'value' => function ($model) {
                /** @var \app\models\VwEligibletrips $model */
                $trip_id = $model->trip->id_trip;
                return "<a target='_blank' href='/tbl-tripreceipt/view?id=$trip_id'>" . $model->trip->print_detail() . "</a>";
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\TblTripreceipt::find()->asArray()->all(), 'id_trip', 'id_trip'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Tbl tripreceipt', 'id' => 'grid--id_trip']
        ],
        [
            'attribute' => 'id_incentive',
            'label' => 'Incentive / Amount($)',
            'value' => function ($model) {
                return implode(', ', [$model->incentive->name, $model->incentive->incentive_amount]);
            },
        ],
        [
            'label' => 'Paid($)',
            'value' => function ($model) {
                return $model->paid_amt();
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ];
    ?>
    <?php try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumn,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-vw-eligibletrips']],
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
        ]);
    } catch (Exception $e) {
        Yii::error("Exception " . json_encode($e));
    } ?>

</div>
