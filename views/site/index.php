<?php

/* @var $this yii\web\View */

use app\models\Immobilier;
use yii\helpers\Url;
use app\controllers\Utils;

/* @var $rdv app\models\Rdv */

$this->title = 'Dzob';
$pat = Immobilier::find()->all();
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>NotaDzob</h1>

        <p class="lead">Nous parlons d'automatisation et de facilitation des tâches répétitives du métier du
            notaire.</p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to('site/index') ?>">Lire la documentation</a>
        </p>
    </div>

    <div class="body-content">
        <div class="col-lg-4 col-md-5">
            <div class="panel panel-red panel-calendar">
                <div class="panel-heading border-light">
                    <h4 class="panel-title">Rendez-vous</h4>
                    <div class="panel-tools">
                        <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
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
                    <div class="height-300">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="actual-date">
                                    <span class="actual-day"></span>
                                    <span class="actual-month-fr"><?= Utils::readableMonth(intval(date('m'))) ?></span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="clock-wrapper">
                                            <div class="clock">
                                                <div class="circle">
                                                    <div class="face">
                                                        <div id="hour"></div>
                                                        <div id="minute"></div>
                                                        <div id="second"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="appointments border-top border-bottom border-light space15">
                                        <div class="owl-carousel owl-theme">
                                            <?php
                                            if (!empty($rdv)) {
                                                foreach ($rdv as $oneRdv) {
                                                    ?>
                                                    <div class="item">
                                                        <div class="inline-block padding-10 border-right border-light">
                                                            <span class="bold-text text-small"><i
                                                                        class="fa fa-clock-o"></i><?= substr($oneRdv->DATE_RDV, 11) ?></span>
                                                            <span class="text-light text-extra-small"><?= $oneRdv->TEL ?></span>
                                                        </div>
                                                        <div class="inline-block padding-10">
                                                            <span class="bold-text text-small"><?= Utils::extraire($oneRdv->NOM, 15) ?></span>
                                                            <span class="text-light text-small"><?= Utils::extraire($oneRdv->OBJET, 25) ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="item">
                                                    <div class="inline-block padding-10 border-right border-light">
                                                        <span class="bold-text text-small"><i class="fa fa-clock-o"></i> --- </span>
                                                        <span class="text-light text-extra-small"> </span>
                                                    </div>
                                                    <div class="inline-block padding-10">
                                                        <span class="bold-text text-small">Aucun rendez-vous</span>
                                                        <span class="text-light text-small"></span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pull-right">
                                    <a href="<?= Url::toRoute('/rdv/create') ?>"
                                       class="btn btn-sm btn-transparent-white new-event"><i class="fa fa-plus"></i>
                                        Ajouter Rendez-vous</a>
                                    <a href="<?= Url::toRoute('/rdv/index') ?>"
                                       class="btn btn-sm btn-transparent-white show-calendar"><i
                                                class="fa fa-calendar-o"></i> Calendrier </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        foreach ($pat as $onepat) {
            ?>
            <?= \app\controllers\Utils::markerPopUp($onepat) ?>
            <?php
        }
        ?>
        <!--<div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>-->
    </div>
</div>
