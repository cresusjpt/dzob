<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeMetadonnee */

$this->title = Yii::t('app', 'Ajouter Type Metadonnee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Metadonnees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-metadonnee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
