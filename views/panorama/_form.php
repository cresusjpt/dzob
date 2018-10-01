<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 06/09/2018
 * Time: 12:38
 */

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

$coord = new LatLng(['lat' => 6.135090, 'lng' => 1.255164]);
$map = new Map([
    'center' => $coord,
    'zoom' => 10,
]);

// lets use the directions renderer
$home = new LatLng(['lat' => 39.720991014764536, 'lng' => 2.911801719665541]);
$school = new LatLng(['lat' => 39.719456079114956, 'lng' => 2.8979293346405166]);
$santo_domingo = new LatLng(['lat' => 39.72118906848983, 'lng' => 2.907628202438368]);

// setup just one waypoint (Google allows a max of 8)
$waypoints = [
    new DirectionsWayPoint(['location' => $santo_domingo])
];

$directionsRequest = new DirectionsRequest([
    'origin' => $home,
    'destination' => $school,
    'waypoints' => $waypoints,
    'travelMode' => TravelMode::DRIVING
]);

// Lets configure the polyline that renders the direction
$polylineOptions = new PolylineOptions([
    'strokeColor' => '#FFAA00',
    'draggable' => true
]);

// Now the renderer
$directionsRenderer = new DirectionsRenderer([
    'map' => $map->getName(),
    'polylineOptions' => $polylineOptions
]);

// Finally the directions service
$directionsService = new DirectionsService([
    'directionsRenderer' => $directionsRenderer,
    'directionsRequest' => $directionsRequest
]);

// Thats it, append the resulting script to the map
$map->appendScript($directionsService->getJs());


/*var bounds = new GLatLngBounds();
for (... each point ...) {
    bounds.extend(latlng);
}
map.setZoom(map.getBoundsZoomLevel(bounds));
map.setCenter(bounds.getCenter());*/

foreach ($model as $oneModel) {
    $markCoord = new LatLng(['lat' => $oneModel->LATITUDE, 'lng' => $oneModel->LONGITUDE]);
    // Lets add a marker now
    $marker = new Marker([
        'position' => $markCoord,
        'title' => $oneModel->REFERENCE_PATRIMOINE,
    ]);

    // Provide a shared InfoWindow to the marker
    $marker->attachInfoWindow(
        new InfoWindow([
            'content' => '<p>' . $oneModel->DESCRIPTION_IMMO . '</p>'
        ])
    );

    // Add marker to the map
    $map->addOverlay($marker);
}

// Now lets write a polygon
$coords = [
    new LatLng(['lat' => 25.774252, 'lng' => -80.190262]),
    new LatLng(['lat' => 18.466465, 'lng' => -66.118292]),
    new LatLng(['lat' => 32.321384, 'lng' => -64.75737]),
    new LatLng(['lat' => 25.774252, 'lng' => -80.190262])
];

$polygon = new Polygon([
    'paths' => $coords
]);

// Add a shared info window
$polygon->attachInfoWindow(new InfoWindow([
    'content' => '<p>This is my super cool Polygon</p>'
]));

// Add it now to the map
$map->addOverlay($polygon);


// Lets show the BicyclingLayer :)
$bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

// Append its resulting script
$map->appendScript($bikeLayer->getJs());

// Display the map -finally :)

$map->width = 1000;
$map->height = 1024;
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
                                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Réduire</span> </a>
                            </li>
                            <li>
                                <a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Actualiser</span> </a>
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
                <?= $map->display();?>
            </div>
        </div>
        <!-- end: BASIC MAP PANEL -->
    </div>
</div>
