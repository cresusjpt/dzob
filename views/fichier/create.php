<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Fichier */

$this->title = Yii::t('app', 'Enrégistrer Fichier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fichiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
