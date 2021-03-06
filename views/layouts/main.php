<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\controllers\ImageUtils;
use app\models\Fonctionnalite;
use app\models\FonctionUser;
use app\models\Menu;
use app\models\SysParam;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

$modelMenu = Menu::find()
    ->orderBy('NUM_ORDREMENU')
    ->all();
$modelFonctionUser = null;
$actuControllerInformation = null;
if (!Yii::$app->user->isGuest) {
    /**
     * Connected user identity
     * Access control with user identity
     * Get all user information like menu and functionnality
     */
    $user = Yii::$app->user->identity;
    $actuControllerInformation = Fonctionnalite::find()->andFilterWhere(['like', 'FONCT_URL', Yii::$app->controller->id])->all();
    if (!empty($actuControllerInformation)) {
        $page_rigth = FonctionUser::find()
            ->where(['IDENTIFIANT' => $user->IDENTIFIANT, 'ID_FONCT' => $actuControllerInformation[0]->ID_FONCT])
            ->all();
        if ($page_rigth == null) {
            throw new NotFoundHttpException('Vous n\'avez pas le droit de consulter cette page');
        }
    }
    $modelFonctionUser = FonctionUser::find()
        ->where(['IDENTIFIANT' => $user->IDENTIFIANT])
        ->orderBy('IDENTIFIANT')
        ->all();

    //user profile operations
    $directory = SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('PP_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
    $extension = pathinfo($user->PHOTO, PATHINFO_EXTENSION);
    if ($extension == 'jpg' || $extension == 'jpeg') {
        $extension = 'jpg';
    } else {
        $extension = 'png';
    }
    $initialName = 'pp_' . str_replace(' ', '_', $user->NOM . $user->PRENOM) . ImageUtils::NAME_SMALL . '.' . $extension;
    $photopath = $directory . $initialName;

} else {
    return Yii::$app->getResponse()->redirect(['site/login'])->send();
}
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--[if IE 8]>
    <html class="ie8" lang="fr"><![endif]-->
    <!--[if IE 9]>
    <html class="ie9" lang="fr"><![endif]-->
    <!--[if !IE]><!-->
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <!--[if IE]>
        <meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1"/>
        <![endif]-->
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="plateforme web d'une étude notariale et gestion electronique documentaire" name="description"/>
        <meta content="Institut Olfa Plexus Technologies (Jeanpaul Tossou)" name="author"/>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <!-- end: META -->
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <!-- start: SLIDING BAR (SB) -->
    <div id="slidingbar-area">
        <div id="slidingbar">
            <div class="row">
                <!-- start: SLIDING BAR FIRST COLUMN -->
                <div class="col-md-4 col-sm-4">
                    <h2>Options</h2>
                    <div class="row">
                        <div class="col-xs-6 col-lg-3">
                            <button class="btn btn-icon btn-block space10">
                                <i class="fa fa-folder-open-o"></i>
                                Dossier <span class="badge badge-info partition-red"> Voir </span>
                            </button>
                        </div>
                        <div class="col-xs-6 col-lg-3">
                            <button class="btn btn-icon btn-block space10">
                                <i class="fa fa-calendar-o"></i>
                                Calendrier <span class="badge badge-info partition-blue"> Voir </span>
                            </button>
                        </div>
                        <div class="col-xs-6 col-lg-3">
                            <button class="btn btn-icon btn-block space10">
                                <i class="fa fa-bell-o"></i>
                                Notifications <span class="badge badge-info partition-red"> Voir </span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end: SLIDING BAR FIRST COLUMN -->
                <!-- start: SLIDING BAR SECOND COLUMN -->
                <div class="col-md-4 col-sm-4">

                </div>
                <!-- end: SLIDING BAR SECOND COLUMN -->
                <!-- start: SLIDING BAR THIRD COLUMN -->
                <div class="col-md-4 col-sm-4">
                    <h2>Mes Informations</h2>
                    <address class="margin-bottom-40">
                        <?= $user->NOM ?> <?= $user->PRENOM ?>
                        <br>
                        <?= $user->ADRESSE ?>
                        <br>
                        Tel : <?= $user->TELEPHONE ?>
                        <br>
                        Email:
                        <a href="#">
                            <?= $user->EMAIL ?>
                        </a>
                    </address>
                    <a class="btn btn-transparent-white" href="<?= Url::to(['site/profile']) ?>">
                        <i class="fa fa-pencil"></i> Modifier
                    </a>
                </div>
                <!-- end: SLIDING BAR THIRD COLUMN -->
            </div>
            <div class="row">
                <!-- start: SLIDING BAR TOGGLE BUTTON -->
                <div class="col-md-12 text-center">
                    <a href="#" class="sb_toggle"><i class="fa fa-chevron-up"></i></a>
                </div>
                <!-- end: SLIDING BAR TOGGLE BUTTON -->
            </div>
        </div>
    </div>
    <!-- end: SLIDING BAR -->
    <div class="main-wrapper">
        <!-- start: TOPBAR -->
        <header class="topbar navbar navbar-inverse navbar-fixed-top inner">
            <!-- start: TOPBAR CONTAINER -->
            <div class="container">
                <div class="navbar-header">
                    <a class="sb-toggle-left hidden-md hidden-lg" href="#main-navbar">
                        <i class="fa fa-bars"></i>
                    </a>
                    <!-- start: LOGO -->
                    <a class="navbar-brand" href="<?= Url::toRoute('site/index') ?>">
                        <img src="<?= Url::to('@web/T_assets/images/logo.png'); ?>" alt="Dzob"/>
                    </a>
                    <!-- end: LOGO -->
                </div>
                <div class="topbar-tools">
                    <!-- start: TOP NAVIGATION MENU -->
                    <ul class="nav navbar-right">
                        <!-- start: USER DROPDOWN -->
                        <li class="dropdown current-user">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle"
                               data-close-others="true"
                               href="#">
                                <img src="<?= Url::base() . DIRECTORY_SEPARATOR . Url::to($photopath); ?>"
                                     class="img-circle"
                                     alt="">
                                <span class="username hidden-xs"><?= $user->PRENOM ?> <?= $user->NOM ?></span>
                                <i class="fa fa-caret-down "></i>
                            </a>
                            <ul class="dropdown-menu dropdown-dark">
                                <li>
                                    <a href="<?= Url::to(['site/profile']) ?>">
                                        Mon Profil
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Calendrier
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('site/lock') ?>">
                                        Verrouiller Ecran
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['site/logout']) ?>" data-method="post">
                                        Deconnexion
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: USER DROPDOWN -->
                        <li class="right-menu-toggle">
                            <a href="#" class="sb-toggle-right">
                                <i class="fa fa-globe toggle-icon"></i> <i class="fa fa-caret-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- end: TOPBAR CONTAINER -->
        </header>
        <!-- end: TOPBAR -->
        <!-- start: PAGESLIDE LEFT -->
        <a class="closedbar inner hidden-sm hidden-xs" href="#">
        </a>
        <nav id="pageslide-left" class="pageslide inner">
            <div class="navbar-content">
                <!-- start: SIDEBAR -->
                <div class="main-navigation left-wrapper transition-left">
                    <div class="navigation-toggler hidden-sm hidden-xs">
                        <a href="#main-navbar" class="sb-toggle-left">
                        </a>
                    </div>
                    <div class="user-profile border-top padding-horizontal-10 block">
                        <div class="inline-block">
                            <img src="<?= Url::base() . DIRECTORY_SEPARATOR . Url::to($photopath); ?>" alt="">
                        </div>
                        <div class="inline-block">
                            <h5 class="no-margin"> Bienvenue </h5>
                            <h4 class="no-margin"> <?= $user->PRENOM ?> <?= $user->NOM ?> </h4>
                            <a class="btn user-options sb_toggle">
                                <i class="fa fa-cog fa-spin"></i>
                            </a>
                        </div>
                    </div>
                    <!-- start: MAIN NAVIGATION MENU -->
                    <ul class="main-navigation-menu">
                        <li>
                            <a href="<?= Url::to(['site/index']) ?>"><i class="fa fa-home"></i>
                                <span class="title"> Tableau de bord
                                </span>
                                <span class="label label-default pull-right ">
                                    Voir
                                </span>
                            </a>
                        </li>
                        <?php
                        foreach ($modelMenu as $menu) {
                            ?>
                            <li>
                                <a href="javascript:void(0)"><i class="fa <?= $menu->ICONE_NAME_MENU ?>"></i> <span
                                            class="title"> <?= $menu->LIBEL_MENU ?> </span><i class="icon-arrow"></i>
                                </a>
                                <ul class="sub-menu">
                                    <?php
                                    if (!is_null($modelFonctionUser)) {
                                        foreach ($modelFonctionUser as $fonctionUser) {
                                            $fonctionnalite = Fonctionnalite::find()
                                                ->where([
                                                    'ID_FONCT' => $fonctionUser->ID_FONCT
                                                ])
                                                ->orderBy('NUM_ORDREFONCT')
                                                ->all();
                                            if ($fonctionnalite[0]->ID_MENU == $menu->ID_MENU) {
                                                ?>
                                                <li>
                                                    <a href="<?= Url::toRoute($fonctionnalite[0]->FONCT_URL, true); ?>">
                                                        <span class="title"> <?= $fonctionnalite[0]->LIBEL_FONCT ?> </span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <!-- end: MAIN NAVIGATION MENU -->
                </div>
                <!-- end: SIDEBAR -->
            </div>
            <div class="slide-tools">
                <div class="col-xs-6 text-left no-padding">
                    <a class="btn btn-sm statu" href="<?= Url::toRoute('site/lock') ?>">
                        En ligne <i class="fa fa-dot-circle-o text-green"></i> <span>Bloquer</span>
                    </a>
                </div>
                <div class="col-xs-6 text-right no-padding">
                    <a class="btn btn-sm log-out text-right" href="<?= Url::toRoute('site/logout') ?>"
                       data-method="post">
                        <i class="fa fa-power-off"></i> Deconnexion
                    </a>
                </div>
            </div>
        </nav>
        <!-- end: PAGESLIDE LEFT -->
        <!-- start: PAGESLIDE RIGHT -->
        <div id="pageslide-right" class="pageslide slide-fixed inner">
            <div class="right-wrapper">
                <ul class="nav nav-tabs nav-justified" id="sidebar-tab">
                    <li>
                        <a href="#settings" role="tab" data-toggle="tab"><i class="fa fa-gear fa-spin"></i></a>
                    </li>
                </ul>
                <div class="hidden-xs" id="style_selector">
                    <div id="style_selector_container">
                        <div class="pageslide-title">
                            Selection de style
                        </div>
                        <div class="box-title">
                            Selectionner le style du layout
                        </div>
                        <div class="input-box">
                            <div class="input">
                                <select name="layout" class="form-control">
                                    <option value="default">Wide</option>
                                    <option value="boxed">Boxed</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-title">
                            Choisir le style de l'en-tête
                        </div>
                        <div class="input-box">
                            <div class="input">
                                <select name="header" class="form-control">
                                    <option value="fixed">Fixed</option>
                                    <option value="default">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-title">
                            Choose Your Sidebar Style
                        </div>
                        <div class="input-box">
                            <div class="input">
                                <select name="sidebar" class="form-control">
                                    <option value="fixed">Fixed</option>
                                    <option value="default">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-title">
                            Choisir le style de pied de page
                        </div>
                        <div class="input-box">
                            <div class="input">
                                <select name="footer" class="form-control">
                                    <option value="default">Default</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-title">
                            <?= Yii::t('app', '10 Schémas de couleurs prédéfinis') ?>
                        </div>
                        <div class="images icons-color">
                            <a href="#" id="default"><img src="<?= Url::to('@web/T_assets/images/color-1.png'); ?>"
                                                          alt="" class="active"></a>
                            <a href="#" id="style2"><img src="<?= Url::to('@web/T_assets/images/color-2.png'); ?>"
                                                         alt=""></a>
                            <a href="#" id="style3"><img src="<?= Url::to('@web/T_assets/images/color-3.png'); ?>"
                                                         alt=""></a>
                            <a href="#" id="style4"><img src="<?= Url::to('@web/T_assets/images/color-4.png'); ?>"
                                                         alt=""></a>
                            <a href="#" id="style5"><img src="<?= Url::to('@web/T_assets/images/color-5.png'); ?>"
                                                         alt=""></a>
                            <a href="#" id="style6"><img src="<?= Url::to('@web/T_assets/images/color-6.png'); ?>"
                                                         alt=""></a>
                            <a href="#" id="style7"><img src="<?= Url::to('@web/T_assets/images/color-7.png'); ?>"
                                                         alt=""></a>
                            <a href="#" id="style8"><img src="<?= Url::to('@web/T_assets/images/color-8.png'); ?>"
                                                         alt=""></a>
                            <a href="#" id="style9"><img src="<?= Url::to('@web/T_assets/images/color-9.png'); ?>"
                                                         alt=""></a>
                            <a href="#" id="style10"><img src="<?= Url::to('@web/T_assets/images/color-10.png'); ?>"
                                                          alt=""></a>
                        </div>
                        <div class="box-title">
                            Backgrounds for Boxed Version
                        </div>
                        <div class="images boxed-patterns">
                            <a href="#" id="bg_style_1"><img src="<?= Url::to('@web/T_assets/images/bg.png'); ?>"
                                                             alt=""></a>
                            <a href="#" id="bg_style_2"><img src="<?= Url::to('@web/T_assets/images/bg_2.png'); ?>"
                                                             alt=""></a>
                            <a href="#" id="bg_style_3"><img src="<?= Url::to('@web/T_assets/images/bg_3.png'); ?>"
                                                             alt=""></a>
                            <a href="#" id="bg_style_4"><img src="<?= Url::to('@web/T_assets/images/bg_4.png'); ?>"
                                                             alt=""></a>
                            <a href="#" id="bg_style_5"><img src="<?= Url::to('@web/T_assets/images/bg_5.png'); ?>"
                                                             alt=""></a>
                        </div>
                        <div class="style-options">
                            <a href="#" class="clear_style">
                                Réinitialiser
                            </a>
                            <a href="#" class="save_style">
                                Enregistrer
                            </a>
                        </div>
                    </div>
                    <div class="style-toggle open"></div>
                </div>
            </div>
        </div>
        <!-- end: PAGESLIDE RIGHT -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container inner">
            <!-- start: PAGE -->
            <div class="main-content">
                <!-- end: SPANEL CONFIGURATION MODAL FORM -->
                <div class="container">
                    <!-- start: PAGE HEADER -->
                    <!-- start: TOOLBAR -->
                    <div class="toolbar row">
                        <div class="col-sm-6 hidden-xs">
                            <div class="page-header">
                                <h1><?php if (empty($actuControllerInformation)) {
                                        echo ' ';
                                    } else echo $actuControllerInformation[0]->LIBEL_FONCT ?>
                                    <small><?php if (empty($actuControllerInformation)) {
                                            echo ' ';
                                        } else echo $actuControllerInformation[0]->DESCRIPTION_FONCT ?></small>
                                </h1>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <a href="#" class="back-subviews">
                                <i class="fa fa-chevron-left"></i> BACK
                            </a>
                            <a href="#" class="close-subviews">
                                <i class="fa fa-times"></i> CLOSE
                            </a>
                            <div class="toolbar-tools pull-right">
                                <!-- start: TOP NAVIGATION MENU -->
                                <ul class="nav navbar-right">
                                    <!-- start: TO-DO DROPDOWN -->

                                    <li class="menu-search">
                                        <a href="#">
                                            <i class="fa fa-search"></i> Rechercher
                                        </a>
                                        <!-- start: SEARCH POPOVER -->
                                        <div class="popover bottom search-box transition-all">
                                            <div class="arrow"></div>
                                            <div class="popover-content">
                                                <!-- start: SEARCH FORM -->
                                                <form class="" id="searchform" method="get"
                                                      action="<?= Url::toRoute(['site/rechercher']) ?>">
                                                    <div class="input-group">
                                                        <input required type="text" name="toolbarSearch"
                                                               id="toolbarSearch"
                                                               class="form-control" placeholder="Rechercher">
                                                        <span class="input-group-btn">
																<button class="btn btn-main-color btn-squared"
                                                                        type="button">
																	<i class="fa fa-search"></i>
																</button> </span>
                                                    </div>
                                                </form>
                                                <!-- end: SEARCH FORM -->
                                            </div>
                                        </div>
                                        <!-- end: SEARCH POPOVER -->
                                    </li>
                                </ul>
                                <!-- end: TOP NAVIGATION MENU -->
                            </div>
                        </div>
                    </div>
                    <!-- end: TOOLBAR -->
                    <!-- end: PAGE HEADER -->
                    <!-- start: BREADCRUMB -->
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="<?php if (empty($actuControllerInformation)) {
                                        echo ' ';
                                    } else echo Url::to([$actuControllerInformation[0]->FONCT_URL]) ?>">
                                        Acceuil
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php if (empty($_SERVER['HTTP_REFERER'])) {
                                        echo ' ';
                                    } else echo $_SERVER['HTTP_REFERER'] ?>">
                                        Précedent
                                    </a>
                                </li>
                                <li class="active">
                                    <?php if (empty($actuControllerInformation)) {
                                        echo ' ';
                                    } else echo $actuControllerInformation[0]->LIBEL_FONCT ?>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- end: BREADCRUMB -->
                    <!-- start: PAGE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <?= $content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: PAGE CONTENT-->
                </div>

                <div class="subviews">
                    <div class="subviews-container"></div>
                </div>
            </div>
            <!-- end: PAGE -->
        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <footer class="inner hidden-print">
            <div class="footer-inner">
                <div class="pull-left">
                    <?php echo date('Y') ?> &copy; Dzob.
                </div>
                <div class="pull-right">
                    <span class="go-top"><i class="fa fa-chevron-up"></i></span>
                </div>
            </div>
        </footer>
        <!-- end: FOOTER -->
    </div>

    <?php $this->endBody() ?>
    <script id="template-upload" type="text/x-tmpl">
			{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-upload fade">
			<td>
			<span class="preview"></span>
			</td>
			<td>
			<p class="name">{%=file.name%}</p>
			{% if (file.error) { %}
			<div><span class="label label-danger">Error</span> {%=file.error%}</div>
			{% } %}
			</td>
			<td>
			<p class="size">{%=o.formatFileSize(file.size)%}</p>
			{% if (!o.files.error) { %}
			<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
			{% } %}
			</td>
			<td>
			{% if (!o.files.error && !i && !o.options.autoUpload) { %}
			<button class="btn btn-primary start">
			<i class="glyphicon glyphicon-upload"></i>
			<span>Start</span>
			</button>
			{% } %}
			{% if (!i) { %}
			<button class="btn btn-warning cancel">
			<i class="glyphicon glyphicon-ban-circle"></i>
			<span>Cancel</span>
			</button>
			{% } %}
			</td>
			</tr>
			{% } %}



    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
			{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-download fade">
			<td>
			<span class="preview">
			{% if (file.thumbnailUrl) { %}
			<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
			{% } %}
			</span>
			</td>
			<td>
			<p class="name">
			{% if (file.url) { %}
			<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
			{% } else { %}
			<span>{%=file.name%}</span>
			{% } %}
			</p>
			{% if (file.error) { %}
			<div><span class="label label-danger">Error</span> {%=file.error%}</div>
			{% } %}
			</td>
			<td>
			<span class="size">{%=o.formatFileSize(file.size)%}</span>
			</td>
			<td>
			{% if (file.deleteUrl) { %}
			<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
			<i class="glyphicon glyphicon-trash"></i>
			<span>Delete</span>
			</button>
			<input type="checkbox" name="delete" value="1" class="toggle">
			{% } else { %}
			<button class="btn btn-warning cancel">
			<i class="glyphicon glyphicon-ban-circle"></i>
			<span>Cancel</span>
			</button>
			{% } %}
			</td>
			</tr>
			{% } %}


    </script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            Index.init();
            PagesUserProfile.init();
            /*SVExamples.init();*/
        });
    </script>
    </body>
    </html>
<?php $this->endPage() ?>