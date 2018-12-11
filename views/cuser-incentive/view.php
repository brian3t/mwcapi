<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\CuserIncentive */

$this->title = $model->cuser_id;
$this->params['breadcrumbs'][] = ['label' => 'Cuser Incentive', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-incentive-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Cuser Incentive'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', ], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', ], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        [
            'attribute' => 'cuser.username',
            'label' => 'Cuser',
        ],
        [
            'attribute' => 'incentive.name',
            'label' => 'Id Incentive',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>