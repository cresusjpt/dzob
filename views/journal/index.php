<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SysLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sys Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sys Log'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID_LOG',
            'CODE_ACTION',
            'ID_PERSONNE',
            'IDENTIFIANT',
            'DATE_LOG',
            //'TABLE_LOG',
            //'LIB_LOG',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
