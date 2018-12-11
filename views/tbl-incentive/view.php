<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TblIncentive */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Incentive', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-incentive-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Tbl Incentive'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id_incentive], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_incentive], [
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
        'id_incentive',
        'name',
        'region',
        'status',
        'incentive_cap',
        'incentive_amount',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerVwEligibletrips->totalCount){
    $gridColumnVwEligibletrips = [
        ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'trip.id_trip',
                'label' => 'Id Trip'
            ],
                ];
    echo Gridview::widget([
        'dataProvider' => $providerVwEligibletrips,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-vw-eligibletrips']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Vw Eligibletrips'),
        ],
        'columns' => $gridColumnVwEligibletrips
    ]);
}
?>
    </div>
</div>