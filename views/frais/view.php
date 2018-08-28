<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Frais */

$this->title = $model->MONTANT.DIRECTORY_SEPARATOR.$model->DATE_REGLE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frais-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_FRAIS], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_FRAIS], [
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
            //'ID_FRAIS',
            'dOSSIER.LIBELLE_DOSSIER',
            'MONTANT',
            'DATE_REGLE',
        ],
    ]) ?>

</div>
