<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblIncentive */

$this->title = 'Create Tbl Incentive';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Incentive', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-incentive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
