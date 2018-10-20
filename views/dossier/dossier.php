<?php

use kartik\tree\TreeView;
use yii\helpers\ArrayHelper;
use app\assets\DossierAsset;
use app\models\Tree;
use app\assets\TreeViewAsset;
use app\assets\CustomAlertAsset;

/**
 *
 * @var $this yii\web\View
 */
/* @var $modelClasseur
 * @var $modelDossier
 * @var $modelDocument
 * @var $modelDroit
 * @var $modelGrUsager
 *
 * //tcPdf
 */
DossierAsset::register($this);
TreeViewAsset::register($this);
CustomAlertAsset::register($this);

$this->title = 'Explorateur de dossiers'
?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Explorateurs de <span class="text-bold">Dossiers</span></h4>
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
                    <div id="tree" class="tree-demo">
                        <ul>
                            <?php
                            foreach ($modelClasseur as $classeur) {
                                ?>
                                <li>
                                    <?= $classeur->NOM_CLASSEUR ?>
                                    <ul>
                                        <?php
                                        $droit = ArrayHelper::map($modelGrUsager, "ID_DOSSIER", "GR_LIBELLE");
                                        foreach ($modelDossier as $dossier) {
                                            if ($classeur->ID_CLASSEUR == $dossier->ID_CLASSEUR && ArrayHelper::keyExists($dossier->ID_DOSSIER, $droit, false)) {
                                                ?>
                                                <li data-jstree='{ "opened" : false }'>
                                                    <span class="dossier"><?= $dossier->LIBELLE_DOSSIER ?></span>
                                                    <ul>
                                                        <?php
                                                        foreach ($modelDocument as $document) {
                                                            if ($dossier->ID_DOSSIER == $document->ID_DOSSIER) {
                                                                ?>
                                                                <li data-jstree='{ "type" : "file" }'>
                                                                    <a href="http://localhost:8090/Dzob/web/dossier/create"
                                                                       data-action="http://localhost:8090/Dzob/web/dossier/dossier">
                                                                        <span class="document"><?= $document->TITRE_DOC ?></span>
                                                                    </a>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                    /*echo TreeView::widget([
                        'query' => Tree::find()->addOrderBy('root,lft'),
                        'headingOptions' => ['label' => 'Explorateur de dossiers'],
                        'isAdmin' => true,
                        'fontAwesome' => true,
                        'displayValue' => 1,
                        'softDelete' => false,
                        'cacheSettings' => [
                            'enableCache' => false,
                        ],
                    ])*/
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: none" id="traitement">
        <div class="col-sm-12">
            <!-- start: FORM WIZARD PANEL -->
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Les <span class="text-bold">Traitements</span></h4>
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
                    </div>
                </div>
                <div class="panel-body">
                    <form action="#" role="form" class="smart-wizard form-horizontal" id="form">
                        <div id="wizard" class="swMain">
                            <ul id="steps">
                            </ul>
                            <div class="progress progress-xs transparent-black no-radius active">
                                <div aria-valuemax="100" aria-valuemin="0" role="progressbar"
                                     class="progress-bar partition-green step-bar">
                                    <span class="sr-only"> 0% Complete (success)</span>
                                </div>
                            </div>
                            <div class="allSteps">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end: FORM WIZARD PANEL -->
        </div>
    </div>
<?php
$script = <<< JS
jQuery(document).ready(function() {
    UITreeview.init();
    FormWizard.init();
    $('input').iCheck({
    checkboxClass: 'icheckbox_minimal',
    radioClass: 'iradio_square-red',
  });
});
$('#tree').delegate(".dossier","click",function(event) {
  event.preventDefault();
  //var currentLocation = document.location.href;
  //currentLocation = currentLocation.substring(0,currentLocation.lastIndexOf("/"));
  //currentLocation+='/edit?2';
  //location.href = currentLocation;
  $('#traitement').hide();
  var libelle_dossier = $(this).text();
  var baseurl;
  if (typeof location.origin === 'undefined'){
      location.origin = location.protocol + '//' + location.host + ':' +location.port;
  }
  baseurl = location.origin;
  $.get('/dossier/get-traitement',{libelle_dossier : libelle_dossier},function(data) {
    var dataParsed = JSON.parse(data);
    if (dataParsed == '') {
        swal("Aucun traitement!");
        /*swal({
          title: "Are you sure?",
          text: "You will not be able to recover this imaginary file!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function() {
          swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });*/
        e.preventDefault();
    }else{
            $('#steps').html('');
    $('.allSteps').html('');
    $.each(dataParsed,function(index,d) {
        var realIndex = index+1;
      $('#steps').append(
          '<li>'+
            '<a href="#step-'+realIndex+'">'+
                '<div class="stepNumber">'+realIndex+'</div>'+
                '<span class="stepDesc"> Traitement '+realIndex+'<br/>'+
                '<small>'+d.NOM_TRAITEMENT+'</small>'+
            '</span>'+
            '</a>'+
          '</li>'
      );
      $('.allSteps').append(
        '<div id="step-'+realIndex+'">'+
            '<h2 class="StepTitle">Description du traitement '+realIndex+'</h2>'+
            '<div class="form-group">'+
                '<label class="col-sm-3 control-label">Nom du traitement</label>'+
                '<div class="col-sm-7">'+
                    '<span class="form-control" id="nom_traitement-'+realIndex+'">'+d.NOM_TRAITEMENT+'</span>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-sm-3 control-label">Date de début</label>'+
                '<div class="col-sm-7">'+
                    '<span class="form-control" id="date_debut-'+realIndex+'">'+d.DATE_DEBUT+'</span>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-sm-3 control-label">Date prévue de fin</label>'+
                '<div class="col-sm-7">'+
                    '<span class="form-control" id="date_prevue-'+realIndex+'">'+d.DATE_PREVUE+'</span>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-sm-3 control-label">Date de fin</label>'+
                '<div class="col-sm-7">'+
                    '<span class="form-control" id="date_fin-'+realIndex+'">'+d.DATE_FIN+'</span>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-sm-3 control-label">Etat Traitement</label>'+
                '<div class="col-sm-7">'+
                    '<label for="iCheck-1-'+realIndex+'" class="radio-inline"><input class="iradio" id="iCheck-1-'+realIndex+'" type="radio" name="iCheck'+realIndex+'">En cours</label>'+
                    '<label class="radio-inline" for="iCheck-2-'+realIndex+'"><input type="radio" id="iCheck-2-'+realIndex+'" name="iCheck'+realIndex+'">Terminé</label>'+
                '</div>'+
            '</div>'+
            '</div>'+
        '</div>'   
      );
      $('input').iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_square-blue',
      });
      $('input').on('ifChecked', function(event){
          var idTask = $(this).attr('id');
          var lib = libelle_dossier;
          $.post('/dossier/update-traitement',{check:idTask,libelle_document:lib},function(data) {
              var valueNow = Math.floor(data * 100);
              $('.step-bar').css('width', valueNow + '%');
          });
      });
      var id2 = '#iCheck-2-'+realIndex;
      var id1 = '#iCheck-1-'+realIndex;
      if (d.ETAT_TRAITEMENT == 1){
          $(id2).iCheck('check');
      }else if (d.ETAT_TRAITEMENT == 0)  {
          $(id1).iCheck('check');
      }
      $('#traitement').show();
    });
    }
  });
});

$('#tree').delegate(".document","click",function(event,data) {
  event.preventDefault();
  var libelle_document = $(this).text();
  //GetDossierClick
  var baseurl;
   if (typeof location.origin === 'undefined'){
      location.origin = location.protocol + '//' + location.host + ':' +location.port;
  }
  baseurl = location.origin;
  $.get('/dossier/get-dossier-click',{libelle_document : libelle_document},function(data) {
      var noonData = JSON.parse(data);
  });
});
JS;
$this->registerJs($script);
?>