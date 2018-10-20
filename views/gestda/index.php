<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 21/08/2018
 * Time: 18:01
 */

use app\assets\CustomAlertAsset;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Profil;
use app\models\Utilisateur;
use app\models\Menu;
use yii\helpers\Html;
use kartik\select2\Select2;

//use kartik\form\ActiveForm;
//use kartik\builder\TabularForm;

$this->title = 'Dzob | Gestion des droits d\'accès';
$id = Yii::$app->user->id;
if (!is_null($id)) {
    $user = Yii::$app->user->identity;
} else {
    return Yii::$app->getResponse()->redirect('site/login');
}
CustomAlertAsset::register($this);
?>
    <div class="row">

        <!--Tabular form widgets example-->
        <?php
        /*    $query = \app\models\Fonctionnalite::find()->where(['ID_MENU'=>3])->indexBy('ID_FONCT');

            $dataProvider = new \yii\data\ActiveDataProvider([
                  'query' => $query,
            ]);
            $form = ActiveForm::begin();
            echo TabularForm::widget([
            'dataProvider'=>$dataProvider,
            'form'=>$form,
            'attributes'=>$model
            ]);
            // Add other fields if needed or render your submit button
            echo '<div class="text-right">' .
            Html::submitButton('Submit', ['class'=>'btn btn-primary']) .
            '<div>';
                ActiveForm::end();

            */ ?>

        <div class="col-sm-12">
            <div class="tabbable">
                <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
                    <li class="active">
                        <a data-toggle="tab" href="#panel_profil">
                            Fonctionnalités des Profils
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#panel_user">
                            Fonctionnalités des Utilisateurs
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="panel_profil" class="tab-pane fade in active">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($modelsProfil, 'CODE_PROFIL')->widget(Select2::class, [
                            'data' => ArrayHelper::map(Profil::find()->all(), 'CODE_PROFIL', 'LIBELLE'),
                            'options' => ['placeholder' => 'Libelle du profil ...', 'id' => 'profil'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>

                        <?= $form->field($modelsMenu, 'ID_MENU')->widget(Select2::class, [
                            'data' => ArrayHelper::map(Menu::find()->all(), 'ID_MENU', 'LIBEL_MENU'),
                            'options' => ['placeholder' => 'Nom du menu ...', 'id' => 'menu'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                        <table class="table table-striped table-bordered table-hover" id="fonction-profil">
                            <thead>
                            <tr>
                                <th class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey selectall">
                                        </label>
                                    </div>
                                </th>
                                <th>Libellé de la fonctionnalité</th>
                                <th class="hidden-xs">Description</th>
                                <th>Nom de la fonctionnalité</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="dossier-table">
                            </tbody>
                        </table>
                        <div class="form-group">
                            <?= Html::button(Yii::t('app', 'Attribuer'), ['class' => 'btn btn-success', 'id' => 'submitProfil']) ?>
                        </div>
                        <!--<div class="form-group">
                            <? /*= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) */ ?>
                        </div>-->
                        <?php $form = ActiveForm::end(); ?>
                    </div>

                    <div id="panel_user" class="tab-pane fade">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'post',
                            'options' => [
                                'data-pjax' => 1
                            ],
                        ]); ?>
                        <?= $form->field($modelUser, 'IDENTIFIANT')->widget(Select2::class, [
                            'data' => ArrayHelper::map(Utilisateur::find()->all(), 'IDENTIFIANT', 'NOM'),
                            'options' => ['placeholder' => 'Nom de l\'utilisateur ...', 'id' => 'user'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>

                        <?= $form->field($modelsMenu, 'ID_MENU')->widget(Select2::class, [
                            'data' => ArrayHelper::map(Menu::find()->all(), 'ID_MENU', 'LIBEL_MENU'),
                            'options' => ['placeholder' => 'Nom du menu ...', 'id' => 'menuUser'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                        <table class="table table-striped table-bordered table-hover" id="fonction-user">
                            <thead>
                            <tr>
                                <th class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey selectall">
                                        </label>
                                    </div>
                                </th>
                                <th>Libellé de la fonctionnalité</th>
                                <th class="hidden-xs">Description</th>
                                <th>Nom de la fonctionnalité</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="dossier-tableUser">
                            </tbody>
                        </table>

                        <div class="form-group">
                            <?= Html::button(Yii::t('app', 'Attribuer'), ['class' => 'btn btn-success', 'onclick' => 'alert();']) ?>
                        </div>
                        <!--<div class="form-group">
                            <? /*= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) */ ?>
                        </div>-->
                        <?php $form = ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$script = <<< JS
$('#submitProfil').click(function (e) {
    var profil_code = $('#profil').val();
    var post = false;
    if (profil_code !==''){
           var dossierTable = document.getElementById("dossier-table").rows;
           var longueur = dossierTable.length;
           var i = 0;
           var baseurl;
           if (typeof location.origin === 'undefined'){
              location.origin = location.protocol + '//' + location.host + ':' +location.port;
           }
          baseurl = location.origin;
           var object = {};
           for(i; i <longueur ; i++) {
             var lineCellule = dossierTable[i].cells;
             for(var k = 0; k < lineCellule.length; k++) {
                 if (k===0){
                    if ($('#flatProfil'+i).is(':checked')){
                        post = true;
                        object[lineCellule[1].innerHTML] = lineCellule[2].innerHTML;
                    }
                 }
             }
           }
           if (post){
                $.blockUI({
                        message : '<i class="fa fa-spinner fa-spin"></i> Veuillez patientez quelques secondes...'
                });
               $.post('/gestda/fonction-profil',{FONCT:JSON.stringify(object),PROFIL:profil_code},function(data) {
                   $('#dossier-table').html('');
                   $.unblockUI();
                   swal(data);
                   document.location.href = location.href;
               });
           }else{
               swal("Aucune fonctionnalité n'est selectionné!");
           }
           
    }else{
        swal("Code Profil ne peut être vide!");
    }
   //e.preventDefault();
});
$('#menu').change(function() {
    $.blockUI({
        message : '<i class="fa fa-spinner fa-spin"></i> Veuillez patientez quelques secondes...'
    });
    var id_menu = $(this).val();
    var baseurl;
   if (typeof location.origin === 'undefined'){
      location.origin = location.protocol + '//' + location.host + ':' +location.port;
   }
  baseurl = location.origin;
  $.get('/fonctionnalite/get-fonctionnalite',{ id_menu : id_menu}, function(data) {
      var dataParsed = JSON.parse(data);
      $('#dossier-table').html('');
        $.each(dataParsed, function(index, d){
        $('#dossier-table').append(
            '<tr>'+
                '<td class="center"><div class="checkbox-table"><label><input type="checkbox" class="flat-grey foocheck" id="flatProfil'+index+'"></label></div></td>'+
                '<td style="display:none">'+d.ID_FONCT+'</td>'+
                '<td style="display:none">'+d.ID_MENU+'</td>'+
                '<td>'+d.LIBEL_FONCT+'</td>'+
                '<td class="hidden-xs">'+d.DESCRIPTION_FONCT+'</td>'+
                '<td>'+d.NAME_FONCT+'</td>'+
            '</tr>'
        );
    });
    $.unblockUI();
/*    $('input').iCheck({
    checkboxClass: 'icheckbox_minimal flat-grey selectall',
    radioClass: 'iradio_square-grey',
  });*/
  });
});

$('#menuUser ').change(function() {
    $.blockUI({
        message : '<i class="fa fa-spinner fa-spin"></i> Veuillez patientez quelques secondes...'
    });
    var id_menu = $(this).val();
    var baseurl;
   if (typeof location.origin === 'undefined'){
      location.origin = location.protocol + '//' + location.host + ':' +location.port;
    }
  baseurl = location.origin;
  $.get('/fonctionnalite/get-fonctionnalite',{ id_menu : id_menu}, function(data) {
      var dataParsed = JSON.parse(data);
      $('#dossier-tableUser').html('');
        $.each(dataParsed, function(index, d){
        $('#dossier-tableUser').append(
            '<tr>'+
                '<td class="center"><div class="checkbox-table"><label><input type="checkbox" class="flat-grey foocheck" id="flatUser'+index+'"></label></div></td>'+
                '<td style="display:none">'+d.ID_FONCT+'</td>'+
                '<td style="display:none">'+d.ID_MENU+'</td>'+
                '<td>'+d.LIBEL_FONCT+'</td>'+
                '<td class="hidden-xs">'+d.DESCRIPTION_FONCT+'</td>'+
                '<td>'+d.NAME_FONCT+'</td>'+
            '</tr>'
        );
    });
    $.unblockUI();
    /*$('input').iCheck({
    checkboxClass: 'icheckbox_minimal',
    radioClass: 'iradio_square-grey',
  });*/
  });
});
JS;
$this->registerJs($script);
?>