<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CuserIncentive */

$this->title = 'Create Cuser Incentive';
$this->params['breadcrumbs'][] = ['label' => 'Cuser Incentive', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-incentive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
