<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 21/08/2018
 * Time: 18:01
 */

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Profil;
use app\models\Menu;

$this->title = 'Dzob | Profile';
$id = Yii::$app->user->id;
if (!is_null($id)) {
    $user = Yii::$app->user->identity;
} else {
    return Yii::$app->getResponse()->redirect('site/login');
}
?>
<div class="row">
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
                    <?= $form->field($modelsProfil, 'CODE_PROFIL')->dropDownList(
                        ArrayHelper::map(Profil::find()->all(),'CODE_PROFIL','LIBELLE'),
                        ['prompt'=>'Libelle du profil','maxlength'=>true]
                    ) ?>

                    <?= $form->field($modelsMenu, 'ID_MENU')->dropDownList(
                        ArrayHelper::map(Menu::find()->all(),'ID_MENU','LIBEL_MENU'),
                        ['prompt'=>'Libellé du menu','maxlength'=>true]
                    ) ?>
                    <table class="table table-striped table-bordered table-hover" id="projects">
                        <thead>
                        <tr>
                            <th class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey selectall">
                                    </label>
                                </div></th>
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
                                </div></td>
                            <td>IT Help Desk</td>
                            <td class="hidden-xs">Master Company</td>
                            <td>11 november 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 70% Complete (danger)</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>PM New Product Dev</td>
                            <td class="hidden-xs">Brand Company</td>
                            <td>12 june 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
                                        <span class="sr-only"> 40% Complete</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>ClipTheme Web Site</td>
                            <td class="hidden-xs">Internal</td>
                            <td>11 november 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only"> 90% Complete</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>Local Ad</td>
                            <td class="hidden-xs">UI Fab</td>
                            <td>15 april 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 50% Complete</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>Design new theme</td>
                            <td class="hidden-xs">Internal</td>
                            <td>2 october 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only"> 20% Complete (warning)</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>IT Help Desk</td>
                            <td class="hidden-xs">Designer TM</td>
                            <td>6 december 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 40% Complete (warning)</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        </tbody>
                    </table>
                    <?php $form = ActiveForm::end(); ?>
                </div>
                <div id="panel_user" class="tab-pane fade">
                    <table class="table table-striped table-bordered table-hover" id="projects">
                        <thead>
                        <tr>
                            <th class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey selectall">
                                    </label>
                                </div></th>
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
                                </div></td>
                            <td>IT Help Desk</td>
                            <td class="hidden-xs">Master Company</td>
                            <td>11 november 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 70% Complete (danger)</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>PM New Product Dev</td>
                            <td class="hidden-xs">Brand Company</td>
                            <td>12 june 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
                                        <span class="sr-only"> 40% Complete</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>ClipTheme Web Site</td>
                            <td class="hidden-xs">Internal</td>
                            <td>11 november 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only"> 90% Complete</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>Local Ad</td>
                            <td class="hidden-xs">UI Fab</td>
                            <td>15 april 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 50% Complete</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>Design new theme</td>
                            <td class="hidden-xs">Internal</td>
                            <td>2 october 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only"> 20% Complete (warning)</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        <input type="checkbox" class="flat-grey foocheck">
                                    </label>
                                </div></td>
                            <td>IT Help Desk</td>
                            <td class="hidden-xs">Designer TM</td>
                            <td>6 december 2014</td>
                            <td class="hidden-xs">
                                <div class="progress active progress-xs">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                        <span class="sr-only"> 40% Complete (warning)</span>
                                    </div>
                                </div></td>
                            <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="#" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                    <a href="#" class="btn btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                </div></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>