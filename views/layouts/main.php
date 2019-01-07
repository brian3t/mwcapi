<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'MWCOG API WebView',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Users', 'url' => ['/cuser']],
            ['label' => 'Geolocation', 'url' => ['/geolocation']],
            ['label' => 'Trips', 'items' => [
                ['label' => 'Trip Receipt', 'url' => ['/tbl-tripreceipt']],
                ['label' => 'Trip Receipt Point', 'url' => ['/tripreceipt-point']],
                ['label' => 'Rider History', 'url' => ['/rider-history']],
                ['label' => 'Eligible Trip', 'url' => ['/vw-eligibletrips']],
                ['label' => 'Eligible Trip Payment', 'url' => ['/eligibletrip-payment']],
            ]],
            ['label' => 'Reports', 'items' => [
                ['label' => 'Users agreed', 'url' => ['/report/users-agreed']],
                ['label' => 'Users logged in', 'url' => ['/report/users-logged-in']],
            ]],
            ['label' => 'Push', 'url' => ['/notification']],
            ['label' => 'Agreement', 'url' => ['/cuser-incentive']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . array_pop($message) . '</div>';
        } ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MWCOG API Webview <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
