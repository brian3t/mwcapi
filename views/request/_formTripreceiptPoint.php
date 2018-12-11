<div class="form-group" id="add-tripreceipt-point">
<?php

use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'TripreceiptPoint',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
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
        'lat' => ['type' => TabularForm::INPUT_TEXT],
        'lng' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowTripreceiptPoint(' . $key . '); return false;', 'id' => 'tripreceipt-point-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Tripreceipt Point', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTripreceiptPoint()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

