<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EligibletripPayment */

$this->title = 'Create Eligibletrip Payment';
$this->params['breadcrumbs'][] = ['label' => 'Eligibletrip Payment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eligibletrip-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'default_incen_id' => $default_incen_id
    ]) ?>

</div>
