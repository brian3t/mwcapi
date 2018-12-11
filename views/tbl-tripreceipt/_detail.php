<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TblTripreceipt */

?>
<div class="tbl-tripreceipt-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id_trip) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id_trip',
        [
            'attribute' => 'driver.username',
            'label' => 'Id Driver',
        ],
        [
            'attribute' => 'rider.username',
            'label' => 'Id Rider',
        ],
        'status',
        'requested_start_lat',
        'requested_start_lng',
        'requested_end_lat',
        'requested_end_lng',
        'actual_start_lat',
        'actual_start_lng',
        'actual_end_lat',
        'actual_end_lng',
        'start_datetime',
        'end_datetime',
        'trip_length',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>