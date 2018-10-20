<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossou
 * Date: 16/09/2018
 * Time: 13:11
 */

use yii\helpers\Html;
use yii2assets\pdfjs\PdfJs;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $modelDocument app\models\Document */
/* @var $modelDroit app\models\Droits */

$this->title = $modelDocument->TITRE_DOC;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$modelDroit = \yii\helpers\Json::decode($modelDroit);
$content = file_get_contents($modelDocument->SOURCE);
$printable = false;
$but = [
    'sidebarToggle' => true,
    'viewFind' => true,
    'pageUp' => true,
    'pageDown' => true,
    'zoomIn' => true,
    'zoomOut' => true,
    'scaleSelect' => true,
    'presentationMode' => true,
    'print' => false,
    'openFile' => false,
    'download' => false,
    'viewBookmark' => false,
];
?>
<div class="modele-view">

    <h1 class="hidden-print">Document : <?= Html::encode($this->title) ?></h1>
    <p>
        <?php
        foreach ($modelDroit as $key => $oneDroit) {
            if ($oneDroit['LIBELLE_DROIT'] == 'PRINT') {
                $printable = true;
                $extension = pathinfo($modelDocument->SOURCE, PATHINFO_EXTENSION);
                if ($extension == 'pdf' || $extension == 'PDF') {
                    ?>
                    <?php
                } else {
                    ?>
                    <?= Html::a(Yii::t('app', 'Télecharger'), '@web/' . $modelDocument->SOURCE, ['class' => 'btn btn-primary hidden-print']) ?>
                    <?php
                }
            }
            if ($oneDroit['LIBELLE_DROIT'] == 'UPDATE') {
                ?>
                <?= Html::a(Yii::t('app', 'Modifier'), ['/document/update', 'id' => $modelDocument->ID_DOC], ['class' => 'btn btn-primary hidden-print']) ?>
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
                    <span class="hidden-print"><?= $modelDocument->TITRE_DOC; ?></span>
                    <div class="panel-tools hidden-print">
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
                    <?php
                    $extension = pathinfo($modelDocument->SOURCE, PATHINFO_EXTENSION);
                    if ($extension == 'pdf' || $extension == 'PDF') {
                        if ($printable) {
                            $but['print'] = true;
                            $but['download'] = true;
                        }
                        try {
                            echo PdfJs::widget([
                                'url' => Url::to('@web/' . $modelDocument->SOURCE),
                                'buttons' => $but,
                                'height' => '1024px',
                                'options' => [
                                    'language' => 'fr',
                                ]
                            ]);
                        } catch (Exception $e) {
                        }
                    } else {
                        try {
                            echo \lesha724\documentviewer\GoogleDocumentViewer::widget([
                                'url' => 'http://iaidiscuss.alwaysdata.net/author/STAGE.docx',//url на ваш документ
                                'width' => '100%',
                                'height' => '1024',
                                //https://geektimes.ru/post/111647/
                                'embedded' => true,
                                'a' => \lesha724\documentviewer\GoogleDocumentViewer::A_BI //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
                            ]);
                        } catch (Exception $e) {
                        }

                        /*echo \lesha724\documentviewer\MicrosoftDocumentViewer::widget([
                            'url' =>'http://iaidiscuss.alwaysdata.net/author/CV_3IAI.pdf',//url на ваш документ
                            'width' => '100%',
                            'height' => '100%'
                        ]);*/

                        /*echo \lesha724\documentviewer\ADocumentViewer::widget([
                            'url' => Url::to('@web/' . $modelDocument->SOURCE), //url на ваш документ или http://example.com/test.odt
                            'width' => '100%',
                            'height' => '100%',
                        ]);*/

                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
