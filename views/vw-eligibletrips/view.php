<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VwEligibletrips */

$this->title = $model->id_trip;
$this->params['breadcrumbs'][] = ['label' => 'Vw Eligibletrips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-eligibletrips-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Vw Eligibletrips'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', ], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', ], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        [
            'attribute' => 'trip.id_trip',
            'label' => 'Id Trip',
        ],
        [
            'attribute' => 'incentive.name',
            'label' => 'Id Incentive',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerEligibletripPayment->totalCount){
    $gridColumnEligibletripPayment = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'id_incentive',
            'amount',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEligibletripPayment,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-eligibletrip-payment']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Eligibletrip Payment'),
        ],
        'columns' => $gridColumnEligibletripPayment
    ]);
}
?>
    </div>
</div>