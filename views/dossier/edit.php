<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossou
 * Date: 16/09/2018
 * Time: 13:11
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modele */
/* @var $modelDocument app\models\Document */
/* @var $modelDroit app\models\Droits */
$model = \app\models\Modele::findOne(1);
$this->title = $modelDocument->TITRE_DOC;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$modelDroit = \yii\helpers\Json::decode($modelDroit);
$content = file_get_contents($modelDocument->SOURCE);
?>
<div class="modele-view">

    <h1 class="hidden-print">Document : <?= Html::encode($this->title) ?></h1>
    <p>
        <?php
        foreach ($modelDroit as $key => $oneDroit) {
            if ($oneDroit['LIBELLE_DROIT'] == 'PRINT') {
                ?>
                <?= Html::a(Yii::t('app', 'Imprimer'), '#', ['class' => 'btn btn-primary hidden-print', 'onClick' => 'window.print()']) ?>
                <?php
            }
            if ($oneDroit['LIBELLE_DROIT'] == 'UPDATE') {
                ?>

                <?= Html::a(Yii::t('app', 'Modifier'), ['/document/update', 'id' => $modelDocument->ID_DOC], ['class' => 'btn btn-primary hidden-print']) ?>
                <?= Html::a(Yii::t('app', 'Télecharger'), '#', ['class' => 'btn btn-primary hidden-print', 'onClick' => 'window.print()']) ?>
                <?= Html::a(Yii::t('app', 'Supprimer'), ['/document/delete', 'id' => $modelDocument->ID_DOC], [
                    'class' => 'btn btn-danger hidden-print',
                    'data' => [
                        'confirm' => Yii::t('app', 'Voulez vous vraiment supprimer l\'élément?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <?php
            }
        }
        ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <i class="fa fa-reorder hidden-print"></i>
                    <span class="hidden-print"><?= $model->NOM_MODELE ?></span>
                    <div class="panel-tools">
                        <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                                <li>
                                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i>
                                        <span><?= Yii::t('app', 'Réduire') ?></span> </a>
                                </li>
                                <li>
                                    <a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
                                        <span><?= Yii::t('app', 'Actualiser') ?></span> </a>
                                </li>
                                <li>
                                    <a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
                                        <span><?= Yii::t('app', 'Plein écran') ?></span></a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
                    </div>
                </div>
                <div class="panel-body">
                    <?= $model->CONTENU_MODELE ?>
                </div>
            </div>
        </div>
    </div>

</div>
