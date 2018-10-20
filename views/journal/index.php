<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SysLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Journal Système');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin()?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID_LOG',
            'CODE_ACTION',
            //'ID_PERSONNE',
            'pERSONNE.NOM',
            'pERSONNE.PRENOM',
            'DATE_LOG:date',
            'TABLE_LOG',
            'LIB_LOG:ntext',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end()?>
</div>
