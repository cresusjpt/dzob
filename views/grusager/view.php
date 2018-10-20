<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GrUsager */

//$this->title = $model->GR_LIBELLE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groupe d\'utilisateurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gr-usager-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach ($model as $oneModel) {
        ?>
        <p>
            <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'ID_DROITS' => $oneModel->ID_DROITS, 'ID_PERSONNE' => $oneModel->ID_PERSONNE, 'IDENTIFIANT' => $oneModel->IDENTIFIANT, 'ID_DOSSIER' => $oneModel->ID_DOSSIER], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'ID_DROITS' => $oneModel->ID_DROITS, 'ID_PERSONNE' => $oneModel->ID_PERSONNE, 'IDENTIFIANT' => $oneModel->IDENTIFIANT, 'ID_DOSSIER' => $oneModel->ID_DOSSIER], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Voulez vous vraiment supprimer l\'élément?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?php
        echo DetailView::widget([
            'model' => $oneModel,
            'attributes' => [
                'dROITS.LIBELLE_DROIT',
                'dOSSIER.LIBELLE_DOSSIER',
                'pERSONNE.civilite',
                'GR_LIBELLE',
                'GR_DESCRIPTION',
            ],
        ]);
        ?>
        <?php
    }
    ?>
</div>
