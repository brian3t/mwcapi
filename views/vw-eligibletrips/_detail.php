<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VwEligibletrips */

?>
<div class="vw-eligibletrips-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id_trip) ?></h2>
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
</div>