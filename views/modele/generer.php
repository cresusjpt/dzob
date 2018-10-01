<?php

/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossou
 * Date: 18/09/2018
 * Time: 23:47
 */

use yii\widgets\Pjax;
use yii\helpers\Html;
use app\controllers\Utils;

/* @var $this \yii\web\View */
/* @var $model app\models\Modele */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modeles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modele-generer">

    <?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <div class="search-classic">
                    <h3>Choisissez un modele qui servira à la génération</h3>
                    <hr>
                    <?php
                    foreach ($model as $oneModele) {
                        ?>
                        <div class="search-result">
                            <h4>
                                <?= Html::a(Yii::t('app', $oneModele->NOM_MODELE), ['generer', 'modele' => $oneModele->ID_MODELE], ['class' => 'hidden-print']) ?>
                            </h4>
                        </div>
                        <hr>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Ajouter Modele'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::end(); ?>
</div>


