<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Metadonnee */

$this->title = Yii::t('app', 'Modifier Metadonnee: {nameAttribute}', [
    'nameAttribute' => $model->META_LIBELLE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Metadonnees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_META, 'url' => ['view', 'id' => $model->ID_META]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifer');
?>
<div class="metadonnee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
