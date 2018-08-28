<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fichier */

$this->title = $model->NOM_FICHIER;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fichiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_FICHIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_FICHIER], [
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
            //'ID_FICHIER',
            'REFERENCE',
            'NOM_FICHIER',
            'DATE_EFFECTIVE',
            'CREATEUR',
            'FORMAT_FICHIER',
        ],
    ]) ?>

</div>
