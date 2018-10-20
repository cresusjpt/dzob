<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 19/09/2018
 * Time: 00:27
 */

use app\controllers\Utils;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-body">
                <!-- start: SEARCH RESULT -->
                <div class="search-classic">
                    <form action="#" class="form-inline">
                        <div class="input-group well">
                            <input type="text" class="form-control" placeholder="Rechercher...">
                            <span class="input-group-btn">
                                <button class="btn btn-green" type="button">
                                    <i class="fa fa-search"></i> Rechercher
                                </button>
                            </span>
                        </div>
                    </form>
                    <?php
                    if (empty($result)) {
                        ?>
                        <h3>Aucun résultat pour la recherche de '<?= $initialsearch ?>'</h3>
                        <hr>
                        <?php
                    } else {
                        ?>
                        <h3>Resultat de la recherche de '<?= $initialsearch ?>'</h3>
                        <hr>
                        <?php
                        foreach ($result as $oneResult) {
                            ?>
                            <div class="search-result">
                                <h4><?= $oneResult['nom_modele'] ?></h4>
                                <?= Html::a(Yii::t('app', 'Plus de détails'), ['modele/view', 'id' => $oneResult['id']]) ?>
                                <p><?= Utils::extraire($oneResult['contenu_modele'], 50) ?></p>
                            </div>
                            <hr>
                            <?php
                        }
                        ?>
                        <!--<ol class="pagination pagination-blue text-center pull-right">
                            <li class="prev disabled">
                                <a href="#">
                                    Prev
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">
                                    1
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    2
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    3
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    4
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    5
                                </a>
                            </li>
                            <li class="next">
                                <a href="#">
                                    Next
                                </a>
                            </li>
                        </ol>-->
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
