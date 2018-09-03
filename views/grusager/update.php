<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrUsager */

$this->title = Yii::t('app', 'Modifier : ' . $model->GR_LIBELLE, [
    'nameAttribute' => '' . $model->GR_LIBELLE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gr Usagers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_DROITS, 'url' => ['view', 'ID_DROITS' => $model->ID_DROITS, 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_DOSSIER' => $model->ID_DOSSIER]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="gr-usager-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
