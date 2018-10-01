<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 21/09/2018
 * Time: 01:12
 */

namespace app\controllers;

class Utils
{
    public static function extraire($texte, $max)
    {
        if ($taille = strlen($texte) > $max) {
            $espace = strpos($texte, ' ', $max);
            $morceau = substr($texte, 0, $espace);
        } else {
            $morceau = $texte;
        }


        return $morceau;
    }
}
