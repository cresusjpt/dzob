<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Modele */

$this->title = $model->NOM_MODELE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modeles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modele-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_MODELE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_MODELE], [
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
            //'ID_MODELE',
            'NOM_MODELE',
            //'SOURCE_MODELE',
            //'CONTENU_MODELE',
            'NB_PARAMETRE',
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <i class="fa fa-reorder"></i>
                    <?= $model->NOM_MODELE?>
                    <div class="panel-tools">
                        <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                                <li>
                                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span><?= Yii::t('app','Réduire')?></span> </a>
                                </li>
                                <li>
                                    <a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span><?= Yii::t('app','Actualiser')?></span> </a>
                                </li>
                                <li>
                                    <a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span><?= Yii::t('app','Plein écran')?></span></a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
                    </div>
                </div>
                <div class="panel-body">
                    <?= $model->CONTENU_MODELE?>
                </div>
            </div>
        </div>
    </div>

</div>
