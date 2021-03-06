<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Fonctionnalite */

$this->title = Yii::t('app', 'Créer Fonctionnalité');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fonctionnalités'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fonctionnalite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
