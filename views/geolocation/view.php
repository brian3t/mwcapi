<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Geolocation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Geolocation', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geolocation-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Geolocation'.' '. Html::encode($this->title) ?></h2>
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
        'latitude',
        'longitude',
        'accuracy',
        'provider',
        'altitude',
        'time',
        'commuter_id',
        'trip_id',
        'start_lat',
        'start_lng',
        'end_lat',
        'end_lng',
        'is_end_of_trip:boolean',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>