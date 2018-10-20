<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Courrier */

$this->title = $model->REFERENCE.'/'.$model->DATE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courrier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->REFERENCE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->REFERENCE], [
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
            'REFERENCE',
            //'ID_PERSONNE',
            'ACTEUR_COURRIER',
            'pRIORITE.NATURE_COURRIER',
            'tYPECOURRIER.NOM_TYPE',
            'DATE:date',
            'OBJET_COURRIER',
            'CONTENU_COURRIER:ntext',
        ],
    ]) ?>

</div>
