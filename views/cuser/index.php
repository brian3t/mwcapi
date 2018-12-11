<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
// /* @var $searchModel app\models\CuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuser';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="cuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cuser', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id',
            'label' => 'Id',
            'format' => 'html',
            'value' => function ($model) {
                $id = $model->id;
                return "<a href='/cuser/update?id=$id' target='_blank'>$id</a>";
            }
        ],
        'first_name',
        'updated_at',
        'cuser_status',
        'status_code',
//        'status_description',
        'commuter',
//        'hashed_password',
        'enrolled',
        'email',
        'username',
        'lat',
        'lng',
        'address_realtime',
        'apns_device_reg_id',
        // ['attribute'=>'commuter_data',
        //     'format'=>'html',
        //     'contentOptions'=>['class'=>'jsonview']],
        'has_agreement',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-cuser']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // set a label for default menu
        'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]),
        ],
    ]); ?>

</div>
