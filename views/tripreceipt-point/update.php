<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TripreceiptPoint */

$this->title = 'Update Tripreceipt Point: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tripreceipt Point', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tripreceipt-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
