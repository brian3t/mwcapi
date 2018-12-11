<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\RiderHistory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rider History', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rider-history-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Rider History'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'cuser.username',
            'label' => 'Cuser',
        ],
        'status',
        'dropoff_full_address',
        'dropoff_lat',
        'dropoff_lng',
        'pickup_full_address',
        'pickup_lat',
        'pickup_lng',
        'trigger_col',
        'pickup_actual_lat',
        'pickup_actual_lng',
        'pickup_actual_full_address',
        'dropoff_actual_lat',
        'dropoff_actual_lng',
        'dropoff_actual_full_address',
        'request_id',
        'rider_id',
        'origin',
        'destination',
        'time_of_request',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>