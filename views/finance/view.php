<?php

use app\assets\ExportAsset;
use app\models\SysParam;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Finance */
/* @var $nature app\models\Finance */

$this->title = $model->REFERENCE_PATRIMOINE . ' ' . $model->DATE_FINANCE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Finances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$nature = $model->NATURE_FINANCE;
?>
<div class="finance-view">

    <h1 class="hidden-print"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_FINANCE], ['class' => 'btn btn-primary hidden-print']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_FINANCE], [
            'class' => 'btn btn-danger hidden-print',
            'data' => [
                'confirm' => Yii::t('app', 'Voulez vous vraiment supprimer l\'élément?'),
                'method' => 'post',
            ],
        ]) ?>
        <button class="btn btn-light hidden-print" onclick="$('.entete').show();window.print();$('.entete').hide();">
            Imprimer <i class="fa fa-print"></i>
        </button>
    </p>

    <?php
    $entete = SysParam::findOne('ENTETE_ETAT');
    if (!empty($entete)) {
        ?>
        <div class="entete" style="display: none">
            <img height="100%" width="100%" src="<?= Url::to('@web/uploads/ressource/' . $entete->PARAM_VALUE); ?>"
                 alt="entete"/>
            <?php
            if ($nature == 'SORTIE') {
                ?>
                <h2 style="text-align: center">Fiche de paiement</h2>
                <?php
            } elseif ($nature == 'ENTREE') {
                ?>
                <h2 style="text-align: center">Reçu de versement</h2>
                <h4 style="text-align: center">Nom du remettant : Fatao Gérard</h4>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nOMPatrimoine',
            'responsable',
            'MONTANT:integer',
            'montantEnLettre',
            'DATE_FINANCE:date',
            'NATURE_FINANCE',
        ],
    ]) ?>

    <div class="btn-group pull-right entete" style="display: none">
        <h4>Fait le : <?= date('d/m/Y à H:i:s') ?></h4>
        <div>
            <h4>Signature</h4>
        </div>
    </div>
</div>
