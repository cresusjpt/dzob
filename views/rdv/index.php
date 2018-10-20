<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii2fullcalendar\yii2fullcalendar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RdvSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rdvs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rdv-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Ajouter un rendez-vous'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    Modal::begin([
        'header' => '<h4>Rendez-vous</h4>',
        'id' => 'rdvmodal',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>

    <?= yii2fullcalendar::widget([
        'events' => $events,
        'options' => [
            'lang' => 'fr',
            'locale' => 'fr',
        ],
        'clientOptions' => [
            'locale' => 'fr',
            'editable' => true,
        ]
    ]); ?>
</div>
<?php
$script = <<< JS
$(document).on('click','.fc-day',function() {
    var date = $(this).attr('data-date');
    /*$('#rdvmodal').modal('show')
    .find('#modalContent')
    .html('fdjfdjfsdfsjfhsfsjk');*/
});
JS;
$this->registerJs($script);
?>
