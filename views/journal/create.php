<?php

use yii\helpers\Html;
use yii\web\NotFoundHttpException;


/* @var $this yii\web\View */
/* @var $model app\models\SysLog */

$this->title = Yii::t('app', 'Créer Journal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Journal Système'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
throw new NotFoundHttpException('Vous n\'avez pas le droit de consulter cette page');
?>
<div class="sys-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
