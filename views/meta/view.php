<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Metadonnee */

$this->title = $model->META_LIBELLE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Metadonnees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metadonnee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_META], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_META], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Voulez vous vraiment supprimer l\'élément?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ID_META',
            'tYPEMETA.LIBELLE_TYPEMETA',
            'META_LIBELLE',
            'META_CONTENU',
        ],
    ]) ?>

</div>
