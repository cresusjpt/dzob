<?php

use yii\helpers\Html;
use app\models\UtilisateurSearch;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GrUsagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Groupe d\'utilisateurs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gr-usager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Ajouter un groupe d\'utilisateurs'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        //'export' => true,
        'export' => [
            'fontAwesome' => true,
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModele = new UtilisateurSearch();
                    //$searchModel->IDENTIFIANT = $model->IDENTIFIANT;

                    $dataProvider = $searchModele->searchBYGR($model->GR_LIBELLE, Yii::$app->request->queryParams);
                    return Yii::$app->controller->renderPartial('_utilisateurs', [
                        'searchModel' => $searchModele,
                        'dataProvider' => $dataProvider,
                    ]);
                }
            ],

            'dROITS.LIBELLE_DROIT',
            'dOSSIER.LIBELLE_DOSSIER',
            'GR_LIBELLE',
            'GR_DESCRIPTION',
            //'pERSONNE.NOM',
            //'pERSONNE.PRENOM',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
