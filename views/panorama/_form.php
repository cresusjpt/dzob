<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 06/09/2018
 * Time: 12:38
 */

use app\controllers\Utils;
use app\models\AyantDroit;
use app\models\Patrimoine;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$coord = new LatLng(['lat' => 6.135090, 'lng' => 1.255164]);
$map = new Map([
    'center' => $coord,
    'zoom' => 8,
]);
$map->width = '100%';
$map->height = 1024;

$i = 1;
foreach ($model as $oneModel) {
    $markCoord = new LatLng(['lat' => $oneModel->LATITUDE, 'lng' => $oneModel->LONGITUDE]);
    $pop = 'Utils::markerPopUp($oneModel)' . $i;
    /*$pop = '<div class="overlayer-wrapper">
                <div class="padding-20">
                    <h4 class="text-white no-margin">dsdsdsds</h4>
                    <h5 class=\"text-white\">dsdsdsdsd</h5>
                </div>
            </div>'.$i;*/
    // Lets add a marker now
    $marker = new Marker([
        'position' => $markCoord,
        'title' => $oneModel->REFERENCE_PATRIMOINE,
        'label' => $oneModel->REFERENCE_PATRIMOINE,
    ]);

    $map->appendScript('
        google.maps.event.addListener(' . $marker->getName() . ',\'click\',function(evt){
            $(\'#immomodal\').modal(\'show\')
            .find(\'#modalContent\')
            .html(\'' . $pop . '\')
        });
    ');

    $i++;
    // Add marker to the map
    $map->addOverlay($marker);
}
?>

<?php
$modelImmo = $model[1];
$patrimoine = Patrimoine::findOne(['REFERENCE_PATRIMOINE' => $modelImmo->REFERENCE_PATRIMOINE]);
$responsable = AyantDroit::findOne(['ID_PERSONNE' => $modelImmo->ID_PERSONNE, 'ID_AYANTDROIT' => $modelImmo->ID_AYANTDROIT]);
$civilite = $responsable->getCivilite();
$ref = $modelImmo->REFERENCE_PATRIMOINE;
$nom_patri = $patrimoine->NOM_PATRIMOINE;
$image = Url::to($modelImmo->RESSOURCE);
Modal::begin([
    'header' => 'Immobilier',
    'id' => 'immomodal',
    'size' => 'modal-small'
]);
/*echo "<div id='modalContent'></div>";*/
echo "<div id='modalContent'><div class=\"col-lg-4 col-md-5\">
            <div class=\"panel uploads\">
                <div class=\"panel-body panel-portfolio no-padding\">
                    <div class=\"portfolio-grid portfolio-hover\">
                        <div class=\"overlayer bottom-left fullwidth\">
                            <div class=\"overlayer-wrapper\">
                                <div class=\"padding-20\">
                                    <h4 class=\"text-white no-margin\">$ref</h4>
                                    <h5 class=\"text-white\">$nom_patri</h5>
                                </div>
                            </div>
                        </div>
                        <div class=\"e-slider owl-carousel owl-theme portfolio-grid portfolio-hover\" data-plugin-options=\'{\"pagination\": false, \"stopOnHover\": true}\'>
                            <div class=\"item\">
                                <img src=\"$image\" alt=\"\">
                            </div>
                        </div>
                    </div>
                    <div class=\"partition partition-white padding-15\">
                        <div class=\"clearfix space5\">
                            <div class=\"col-xs-12 text-center no-padding\">
                                $modelImmo->DESCRIPTION_IMMO
                            </div>
                        </div>
                        <div class=\"clearfix padding-5\">
                            <div class=\"col-xs-9 text-center no-padding\">
                                <a href=\"#\" class=\"text-dark\">
                                    Responsable : $civilite
                                </a>
                            </div>
                            <div class=\"col-xs-4 text-center no-padding\">
                                <div class=\"border-right border-dark\">
                                    <a href=\"#\" class=\"text-dark\">
                                        <i class=\"fa fa-heart-o text-red\"></i> 250
                                    </a>
                                </div>
                            </div>
                            <div class=\"col-xs-4 text-center no-padding\">
                                <div class=\"border-right border-dark\">
                                    <a href=\"#\" class=\"text-dark\">
                                        <i class=\"fa fa-bookmark-o text-green\"></i> 20
                                    </a>
                                </div>
                            </div>
                            <div class=\"col-xs-4 text-center no-padding\">
                                <a href=\"#\" class=\"text-dark\"><i class=\"fa fa-comment-o text-azure\"></i> 544</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div></div>";
Modal::end();
?>

<div class="row">
    <div class="col-md-12">
        <!-- start: BASIC MAP PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title"><span class="text-bold"></span></h4>
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
                                <a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Actualiser</span>
                                </a>
                            </li>
                            <li>
                                <a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Plein écran</span></a>
                            </li>
                        </ul>
                    </div>
                    <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
                </div>
            </div>
            <div class="panel-body">
                <?= $map->display(); ?>
            </div>
        </div>
        <!-- end: BASIC MAP PANEL -->
    </div>
</div>
