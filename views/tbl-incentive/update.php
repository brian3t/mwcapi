<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblIncentive */

$this->title = 'Update Tbl Incentive: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Incentive', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_incentive]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-incentive-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
