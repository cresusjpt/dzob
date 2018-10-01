<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 20/08/2018
 * Time: 18:10
 */

use app\models\Profil;
use app\models\UserProfil;
use app\models\SysLog;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use dosamigos\datepicker\DatePicker;

$this->title = 'Dzob | Profile';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="tabbable">
            <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
                <li class="active">
                    <a data-toggle="tab" href="#panel_overview">
                        Général
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#panel_edit_account">
                        Modifier Compte
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#panel_projects">
                        Dossiers
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="panel_overview" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-sm-5 col-md-4">
                            <div class="user-left">
                                <div class="center">
                                    <h4><?= $user->PRENOM ?> <?= $user->NOM ?></h4>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="user-image">
                                            <div class="fileupload-new thumbnail"><img
                                                        src="<?= Url::base() . DIRECTORY_SEPARATOR . Url::to($user->PHOTO) ?>"
                                                        alt="">
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                            <div class="user-image-buttons">
                                                <a href="#" class="btn fileupload-exists btn-red btn-sm"
                                                   data-dismiss="fileupload">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="3">Informations de l'utilisateur</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>nom d'utilisateur</td>
                                        <td>
                                            <a href="#">
                                                <?= $user->USERNAME ?>
                                            </a></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>email:</td>
                                        <td>
                                            <a href="mailto:<?= $user->EMAIL ?>">
                                                <?= $user->EMAIL ?>
                                            </a></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>phone:</td>
                                        <td><?= $user->TELEPHONE ?></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>adresse</td>
                                        <td>
                                            <a href="">
                                                <?= $user->ADRESSE ?>
                                            </a></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="3">Autres informations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Date de naissance</td>
                                        <td><?= $user->DATE_NAISSANCE ?></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Connecté depuis</td>
                                        <td>56 min</td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Dernière modification</td>
                                        <td><?= $user->DM_MODIFICATION ?></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i
                                                        class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Profil</td>
                                        <td><span class="label label-sm label-info"><?= $profile_name->LIBELLE ?></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-7 col-md-8">
                            <p>

                            </p>
                            <?php
                            if (!empty($log)) {
                                ?>
                                <div class="panel panel-white space20">
                                    <div class="panel-heading">
                                        <i class="clip-menu"></i>
                                        Récentes activités
                                        <div class="panel-tools">
                                            <a class="btn btn-xs btn-link panel-close" href="#">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-body panel-scroll height-300">
                                        <ul class="activities">
                                            <?php
                                            foreach ($log as $oneLog) {
                                                ?>
                                                <li>
                                                    <a class="activity" href="javascript:void(0)">
                                                    <span class="fa-stack fa-2x"> <i
                                                                class="fa fa-square fa-stack-2x text-blue"></i> <i
                                                                class="fa fa-database fa-stack-1x fa-inverse"></i> </span>
                                                        <span class="desc"><?= \app\models\Action::findOne($oneLog->CODE_ACTION)->LIB_ACTION ?></span>
                                                        <div class="time">
                                                            <i class="fa fa-clock-o"></i>
                                                            <?= $oneLog->DATE_LOG ?>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="panel_edit_account" class="tab-pane fade">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                    <!--<form action="#" role="form" id="form">-->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Informations du compte</h3>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $form->field($user, 'NOM')->textInput(['maxlength' => true, 'placeholder' => $user->NOM]) ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($user, 'PRENOM')->textInput(['maxlength' => true, 'placeholder' => $user->PRENOM]) ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($user, 'EMAIL')->input('email', ['maxlength' => true, 'placeholder' => $user->EMAIL]) ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($user, 'TELEPHONE')->textInput(['maxlength' => true, 'placeholder' => $user->TELEPHONE]) ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($user, 'oldpassword')->passwordInput(['maxlength' => true]) ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($user, 'newpassword')->passwordInput(['maxlength' => true]) ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($user, 'repeatpassword')->passwordInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group connected-group">
                                    <div class="row">
                                        <?= $form->field($user, 'DATE_NAISSANCE')->widget(
                                            DatePicker::class, [
                                            // inline too, not bad
                                            'inline' => false,
                                            'language' => 'fr',
                                            //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'endDate' => date('Y-m-d'),
                                                'todayHighlight' => true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($user, 'SEXE')->radioList(['M' => 'Masculin', 'F' => 'Féminin']) ?>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Photo de profil
                                    </label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail"><img
                                                    src="<?= Url::base() . DIRECTORY_SEPARATOR . Url::to($user->PHOTO) ?>"
                                                    alt="">
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                        <div class="user-edit-image-buttons">
                                            <span class="btn btn-azure btn-file">
                                                <?= $form->field($user, 'file', ['options' => ['tag' => 'span', 'class' => 'fileinput-button'], 'template' => '<i class="fa fa-picture"></i><span>Choisir une image</span>{hint}{input}'])->fileInput() ?>
                                            </span>
                                            <a href="#" class="btn fileupload-exists btn-red" data-dismiss="fileupload">
                                                <i class="fa fa-times"></i> Supprimer
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <?= Html::submitButton(Yii::t('app', 'Modifier'), ['class' => 'btn btn-green btn-block', 'template' => '{input}<i class="fa fa-arrow-circle-right"></i>']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <!--</form>-->
                </div>
                <div id="panel_projects" class="tab-pane fade">
                    <table class="table table-striped table-bordered table-hover" id="projects">
                        <thead>
                        <tr>
                            <th class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey selectall">
                                    </label>
                                </div>
                            </th>
                            <th>Nom du dossier</th>
                            <th class="hidden-xs">Client</th>
                            <th>Date prévue de fin</th>
                            <th class="hidden-xs">%Pourcentage</th>
                            <th class="hidden-xs center">Etat</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div>
                            </td>
                            <td>IT Help Desk</td>
                            <td class="hidden-xs">Master Company</td>
                            <td>11 november 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70"
                                         role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 70% Complete (danger)</span>
                                    </div>
                                </div>
                            </td>
                            <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top"
                                       data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top"
                                       data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top"
                                       data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group">
                                        <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-share"></i> Share
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-times"></i> Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div>
                            </td>
                            <td>PM New Product Dev</td>
                            <td class="hidden-xs">Brand Company</td>
                            <td>12 june 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                         role="progressbar" class="progress-bar progress-bar-info">
                                        <span class="sr-only"> 40% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top"
                                       data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top"
                                       data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top"
                                       data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group">
                                        <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-share"></i> Share
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-times"></i> Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div>
                            </td>
                            <td>ClipTheme Web Site</td>
                            <td class="hidden-xs">Internal</td>
                            <td>11 november 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90"
                                         role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only"> 90% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top"
                                       data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top"
                                       data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top"
                                       data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group">
                                        <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-share"></i> Share
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-times"></i> Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div>
                            </td>
                            <td>Local Ad</td>
                            <td class="hidden-xs">UI Fab</td>
                            <td>15 april 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50"
                                         role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 50% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top"
                                       data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top"
                                       data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top"
                                       data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group">
                                        <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-share"></i> Share
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-times"></i> Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div>
                            </td>
                            <td>Design new theme</td>
                            <td class="hidden-xs">Internal</td>
                            <td>2 october 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20"
                                         role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only"> 20% Complete (warning)</span>
                                    </div>
                                </div>
                            </td>
                            <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top"
                                       data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top"
                                       data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top"
                                       data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group">
                                        <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-share"></i> Share
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-times"></i> Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div>
                            </td>
                            <td>IT Help Desk</td>
                            <td class="hidden-xs">Designer TM</td>
                            <td>6 december 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                         role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 40% Complete (warning)</span>
                                    </div>
                                </div>
                            </td>
                            <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top"
                                       data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top"
                                       data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top"
                                       data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group">
                                        <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-share"></i> Share
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">
                                                    <i class="fa fa-times"></i> Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$script = <<< JS
jQuery(document).ready(function() {
    $('input').iCheck({
    checkboxClass: 'icheckbox_minimal',
    radioClass: 'iradio_square-grey',
  });
});
JS;
$this->registerJs($script);
?>