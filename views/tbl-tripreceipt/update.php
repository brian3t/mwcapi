<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTripreceipt */

$this->title = 'Update Tbl Tripreceipt: ' . ' ' . $model->id_trip;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Tripreceipt', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trip, 'url' => ['view', 'id' => $model->id_trip]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-tripreceipt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
