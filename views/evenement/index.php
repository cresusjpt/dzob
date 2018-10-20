<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii2fullcalendar\yii2fullcalendar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EvenementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $events app\models\Evenement */

$this->title = Yii::t('app', 'Evenements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evenement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Ajouter Evenement'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Calendrier'), ['#'], ['class' => 'btn cal-display']) ?>
        <?= Html::a(Yii::t('app', 'Grille'), ['#'], ['class' => 'btn grille-display', 'style' => 'display: none']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_EVENEMENT',
            'REFERENCE_PATRIMOINE',
            'LIBELLE_EVENEMENT',
            'DATE_EVENEMENT:date',
            //'ETAT_EVENEMENT',
            'DATE_REALISATION:date',
            'COMMENTAIRE_EVENEMENT:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php Pjax::end(); ?>
</div>
<?php
$script = <<< JS
$('.cal-display').click(function (e) {
    e.preventDefault();
    $('.event-calendar').show();
    $('.cal-grid').hide();
    $('.grille-display').show();
    $(this).hide();
});
$('.grille-display').click(function (e) {
    e.preventDefault();
    $('.event-calendar').hide();
    $('.cal-grid').show();
    $('.cal-display').show();
    $(this).hide();
});
JS;
$this->registerJs($script);
?>
