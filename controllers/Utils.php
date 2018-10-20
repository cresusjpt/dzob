<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 21/09/2018
 * Time: 01:12
 */

namespace app\controllers;

use app\models\AyantDroit;
use app\models\Patrimoine;
use yii\helpers\Url;

class Utils
{
    public static function extraire($texte, $max)
    {
        if ($taille = strlen($texte) > $max) {
            $espace = strpos($texte, ' ', $max);
            $morceau = substr($texte, 0, $espace) . '...';
        } else {
            $morceau = $texte;
        }


        return $morceau;
    }

    public static function readableMonth($month)
    {
        $readable = ["", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        if (is_int($month)) {
            return $readable[$month];
        } else {
            return "";
        }
    }

    public static function markerPopUp($modelImmo)
    {
        $patrimoine = Patrimoine::findOne(['REFERENCE_PATRIMOINE' => $modelImmo->REFERENCE_PATRIMOINE]);
        $responsable = AyantDroit::findOne(['ID_PERSONNE' => $modelImmo->ID_PERSONNE, 'ID_AYANTDROIT' => $modelImmo->ID_AYANTDROIT]);
        $civilite = $responsable->getCivilite();
        $ref = $modelImmo->REFERENCE_PATRIMOINE;
        $nom_patri = $patrimoine->NOM_PATRIMOINE;
        $image = Url::base() . DIRECTORY_SEPARATOR . Url::to($modelImmo->RESSOURCE);
        return "<div class=\"col-lg-4 col-md-5\">
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
        </div>";
    }

    public static function numberConverter($number)
    {
        $formatter = \NumberFormatter::create('fr_fr', \NumberFormatter::SPELLOUT);
        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
        $formatter->setAttribute(\NumberFormatter::ROUNDING_MODE, \NumberFormatter::ROUND_HALFUP);

        return $formatter->format($number);
    }
}
