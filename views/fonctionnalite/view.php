<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fonctionnalite */

$this->title = $model->ID_FONCT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fonctionnalites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fonctionnalite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID_FONCT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID_FONCT], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_FONCT',
            'ID_MENU',
            'NAME_FONCT',
            'LIBEL_FONCT',
            'FONCT_URL:url',
            'CONTROLE_FONCT',
            'NUM_ORDREFONCT',
            'DESCRIPTION_FONCT',
        ],
    ]) ?>

</div>
