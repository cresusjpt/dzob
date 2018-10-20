<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rdv */

$this->title = $model->ID_RDV;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rdvs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rdv-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_RDV], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_RDV], [
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
            'NOM',
            'TEL',
            'OBJET:ntext',
            'NOTAIRE',
            'DATE_PRISE:date',
            'DATE_RDV:date',
        ],
    ]) ?>

</div>
