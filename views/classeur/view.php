<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Classeur */

$this->title = $model->NOM_CLASSEUR.' '.$model->DATE_CLASSEUR;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classeurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classeur-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_CLASSEUR], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_CLASSEUR], [
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
            'ID_CLASSEUR',
            'NOM_CLASSEUR',
            'DATE_CLASSEUR:date',
        ],
    ]) ?>

</div>
