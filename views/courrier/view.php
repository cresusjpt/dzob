<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Courrier */

$this->title = $model->REFERNCE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courrier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->REFERNCE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->REFERNCE], [
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
            'REFERNCE',
            'ID_PERSONNE',
            'ID_PRIORITE',
            'ID_TYPECOURRIER',
            'DATE',
            'OBJET_COURRIER',
        ],
    ]) ?>

</div>
