<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Geolocation */

$this->title = 'Update Geolocation: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Geolocation', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="geolocation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
