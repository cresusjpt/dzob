<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Valeur */

$this->title = $model->REFERENCE_PATRIMOINE . DIRECTORY_SEPARATOR . $model->MONTANT . DIRECTORY_SEPARATOR . $model->DATE_DEBUT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Valeurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valeur-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_VALEUR], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_VALEUR], [
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
            'MONTANT:integer',
            'DATE_DEBUT:date',
            'DATE_FIN:date',
            'REFERENCE_PATRIMOINE',
            'TYPE_PATRIMOINE',
        ],
    ]) ?>

</div>
