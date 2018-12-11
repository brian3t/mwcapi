<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuserIncentive */

$this->title = 'Update Cuser Incentive: ' . ' ' . $model->cuser_id;
$this->params['breadcrumbs'][] = ['label' => 'Cuser Incentive', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cuser_id, 'url' => ['view', ]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuser-incentive-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
