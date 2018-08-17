<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 13/08/2018
 * Time: 02:19
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\LoginAsset;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="no-js">
    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="Login page for Dzob project " name="description" />
        <meta content="Jeanpaul Tossou" name="author" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login">
    <?php $this->beginBody() ?>
    <main>
        <?= $content ?>
    </main>
    <?php $this->endBody() ?>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
        });
    </script>
    </body>
    </html>
<?php $this->endPage() ?>