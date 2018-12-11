<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblTripreceipt */

$this->title = 'Create Tbl Tripreceipt';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Tripreceipt', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-tripreceipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
