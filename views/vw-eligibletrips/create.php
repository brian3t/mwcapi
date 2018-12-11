<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VwEligibletrips */

$this->title = 'Create Vw Eligibletrips';
$this->params['breadcrumbs'][] = ['label' => 'Vw Eligibletrips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-eligibletrips-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
