<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VwEligibletrips */

$this->title = 'Update Vw Eligibletrips: ' . ' ' . $model->id_trip;
$this->params['breadcrumbs'][] = ['label' => 'Vw Eligibletrips', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trip, 'url' => ['view', ]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vw-eligibletrips-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
