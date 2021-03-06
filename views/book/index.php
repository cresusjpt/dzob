<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LivreTraitementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Livre Traitements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="livre-traitement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Ajouter au Livre Traitement'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID_LT',
            'NOM_TRAITEMENT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
