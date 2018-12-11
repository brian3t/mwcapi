<div class="form-group" id="add-vw-eligibletrips">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'VwEligibletrips',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'id_trip' => [
            'label' => 'Tbl tripreceipt',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\TblTripreceipt::find()->orderBy('id_trip')->asArray()->all(), 'id_trip', 'id_trip'),
                'options' => ['placeholder' => 'Choose Tbl tripreceipt'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowVwEligibletrips(' . $key . '); return false;', 'id' => 'vw-eligibletrips-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Vw Eligibletrips', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowVwEligibletrips()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

