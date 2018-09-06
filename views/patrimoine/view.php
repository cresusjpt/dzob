<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Patrimoine */

$this->title = $model->ID_PATRIMOINE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patrimoines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patrimoine-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_PATRIMOINE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_PATRIMOINE], [
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
            //'ID_PATRIMOINE',
            'REFERENCE_PATRIMOINE',
            'NOM_PATRIMOINE',
        ],
    ]) ?>

</div>
