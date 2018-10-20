<?php

use app\assets\ExportAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\SysParam;

/* @var $this yii\web\View */
/* @var $model app\models\Frais */

$this->title = $model->MONTANT . DIRECTORY_SEPARATOR . $model->DATE_REGLE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$nature = 'SORTIE';
?>
<div class="frais-view">

    <h1 class="hidden-print"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_FRAIS], ['class' => 'btn btn-primary hidden-print']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_FRAIS], [
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
            <img height="100%" width="100%"
                 src="<?= Url::base() . DIRECTORY_SEPARATOR . Url::to('uploads/ressource/' . $entete->PARAM_VALUE); ?>"
                 alt="entete"/>
            <h2 style="text-align: center">PROVISION SUR FRAIS DE DOSSIER</h2>
        </div>
        <?php
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ID_FRAIS',
            'dOSSIER.LIBELLE_DOSSIER',
            'MONTANT:integer',
            'montantEnLettre',
            'client',
            'REMETTANT',
            'DATE_REGLE:date',
            'difference:integer'
        ],
    ]) ?>

    <div class="btn-group pull-right entete" style="display: none">
        <h4>Fait le : <?= date('d/m/Y à H:i:s') ?></h4>
        <div>
            <h4>Signature</h4>
        </div>
    </div>

</div>
<?php
/*$script = <<< JS
jQuery(document).ready(function() {
    TableExport.init();
});
JS;
$this->registerJs($script);*/
?>
