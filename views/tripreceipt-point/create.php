<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TripreceiptPoint */

$this->title = 'Create Tripreceipt Point';
$this->params['breadcrumbs'][] = ['label' => 'Tripreceipt Point', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tripreceipt-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
