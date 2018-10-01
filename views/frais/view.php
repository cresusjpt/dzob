<?php

use app\assets\ExportAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Frais */

$this->title = $model->MONTANT . DIRECTORY_SEPARATOR . $model->DATE_REGLE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
ExportAsset::register($this);
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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ID_FRAIS',
            'dOSSIER.LIBELLE_DOSSIER',
            'MONTANT',
            'DATE_REGLE',
            'difference'
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Détail <span class="text-bold">Frais</span> de Dossier</h4>
                    <div class="panel-tools">
                        <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                                <li>
                                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Réduire</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="panel-refresh" href="#">
                                        <i class="fa fa-refresh"></i> <span>Actualiser</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="panel-expand" href="#">
                                        <i class="fa fa-expand"></i> <span>Plein écran</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-xs btn-link panel-close" href="#">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="btn-group pull-right">
                                <button class="btn btn-light hidden-print" onclick="window.print();">
                                    Imprimer <i class="fa fa-print"></i>
                                </button>
                                <button data-toggle="dropdown" class="btn btn-green dropdown-toggle hidden-print">
                                    Exporter <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-light pull-right">
                                    <li>
                                        <a href="#" class="export-pdf" data-table="#sample-table-1">
                                            Enrégistrer en PDF
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-png" data-table="#sample-table-1">
                                            Enrégistrer en PNG
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-csv" data-table="#sample-table-1">
                                            Enrégistrer en CSV
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-txt" data-table="#sample-table-1">
                                            Enrégistrer en TXT
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-xml" data-table="#sample-table-1">
                                            Enrégistrer en XML
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-sql" data-table="#sample-table-1">
                                            Enrégistrer en SQL
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-json" data-table="#sample-table-1">
                                            Enrégistrer en JSON
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-excel" data-table="#sample-table-1">
                                            Enrégistrer en Excel
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-doc" data-table="#sample-table-1">
                                            Enrégistrer en Word
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="export-powerpoint" data-table="#sample-table-1">
                                            Enrégistrer en PowerPoint
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="sample-table-1">
                            <thead>
                            <tr>
                                <th>Country</th>
                                <th>Population</th>
                                <th>tring</th>
                                <th>TODO</th>
                                <th>Date</th>
                                <th>%ge</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Chinna</td>
                                <td>1,363,480,000</td>
                                <td>March 24, 2014</td>
                                <td>March 24, 2014</td>
                                <td>March 24, 2014</td>
                                <td>19.1</td>
                            </tr>
                            <tr>
                                <td>India</td>
                                <td>1,241,900,000</td>
                                <td>1,241,900,000</td>
                                <td>1,241,900,000</td>
                                <td>March 24, 2014</td>
                                <td>17.4</td>
                            </tr>
                            <tr>
                                <td>United States</td>
                                <td>317,746,000</td>
                                <td>317,746,000</td>
                                <td>317,746,000</td>
                                <td>March 24, 2014</td>
                                <td>4.44</td>
                            </tr>
                            <tr>
                                <td>Indonesia</td>
                                <td>249,866,000</td>
                                <td>July 1, 2013</td>
                                <td>July 1, 2013</td>
                                <td>July 1, 2013</td>
                                <td>3.49</td>
                            </tr>
                            <tr>
                                <td>Brazil</td>
                                <td>201,032,714</td>
                                <td>201,032,714</td>
                                <td>201,032,714</td>
                                <td>July 1, 2013</td>
                                <td>2.81</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end: EXPORT BASIC TABLE PANEL -->
        </div>
    </div>

</div>
<?php
$script = <<< JS
jQuery(document).ready(function() {
    TableExport.init();
});
JS;
$this->registerJs($script);
?>
