<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 27/09/2018
 * Time: 13:20
 */

namespace app\controllers;

class ImageUtils
{

    const TAILLE_SMALL = '30';
    const NAME_SMALL = '-small';
    const TAILLE_1 = '50';
    const NAME_1 = '-1';
    const TAILLE_BIG = '100';
    const NAME_BIG = '-big';
    const TAILLE_XL = '150';
    const NAME_XL = '-xl';

    public static function generateMiniature($image, $extension, $directory, $initialName)
    {
        self::generateSmallMiniature($image, $extension, $directory, $initialName);
        self::generate1Miniature($image, $extension, $directory, $initialName);
        self::generateBigMiniature($image, $extension, $directory, $initialName);
        self::generateXLMiniature($image, $extension, $directory, $initialName);
    }

    public static function generateSmallMiniature($image, $extension, $directory, $initialName)
    {

        if ($extension == 'jpg' || $extension == 'jpeg') {
            $source = imagecreatefromjpeg($image); // La photo est la source
        } else {
            $source = imagecreatefrompng($image); // La photo est la source
        }

        $destination = imagecreatetruecolor(self::TAILLE_SMALL, self::TAILLE_SMALL); // On crée la miniature vide


// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image

        $largeur_source = imagesx($source);

        $hauteur_source = imagesy($source);

        $largeur_destination = imagesx($destination);

        $hauteur_destination = imagesy($destination);


// On crée la miniature

        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);


// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

        if ($extension == 'jpg' || $extension == 'jpeg') {
            imagejpeg($destination, $directory . $initialName . self::NAME_SMALL . '.jpg');
        } else {
            imagepng($destination, $directory . $initialName . self::NAME_SMALL . '.png');
        }

    }

    public static function generate1Miniature($image, $extension, $directory, $initialName)
    {

        if ($extension == 'jpg' || $extension == 'jpeg') {
            $source = imagecreatefromjpeg($image); // La photo est la source
        } else {
            $source = imagecreatefrompng($image); // La photo est la source
        }

        $destination = imagecreatetruecolor(self::TAILLE_1, self::TAILLE_1); // On crée la miniature vide


// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image

        $largeur_source = imagesx($source);

        $hauteur_source = imagesy($source);

        $largeur_destination = imagesx($destination);

        $hauteur_destination = imagesy($destination);


// On crée la miniature

        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);


// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

        if ($extension == 'jpg' || $extension == 'jpeg') {
            imagejpeg($destination, $directory . $initialName . self::NAME_1 . '.jpg');
        } else {
            imagepng($destination, $directory . $initialName . self::NAME_1 . '.png');
        }

    }

    public static function generateBigMiniature($image, $extension, $directory, $initialName)
    {

        if ($extension == 'jpg' || $extension == 'jpeg') {
            $source = imagecreatefromjpeg($image); // La photo est la source
        } else {
            $source = imagecreatefrompng($image); // La photo est la source
        }

        $destination = imagecreatetruecolor(self::TAILLE_BIG, self::TAILLE_BIG); // On crée la miniature vide


// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image

        $largeur_source = imagesx($source);

        $hauteur_source = imagesy($source);

        $largeur_destination = imagesx($destination);

        $hauteur_destination = imagesy($destination);


// On crée la miniature

        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);


// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

        if ($extension == 'jpg' || $extension == 'jpeg') {
            imagejpeg($destination, $directory . $initialName . self::NAME_BIG . '.jpg');
        } else {
            imagepng($destination, $directory . $initialName . self::NAME_BIG . '.png');
        }

    }

    public static function generateXLMiniature($image, $extension, $directory, $initialName)
    {

        if ($extension == 'jpg' || $extension == 'jpeg') {
            $source = imagecreatefromjpeg($image); // La photo est la source
        } else {
            $source = imagecreatefrompng($image); // La photo est la source
        }

        $destination = imagecreatetruecolor(self::TAILLE_XL, self::TAILLE_XL); // On crée la miniature vide


// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image

        $largeur_source = imagesx($source);

        $hauteur_source = imagesy($source);

        $largeur_destination = imagesx($destination);

        $hauteur_destination = imagesy($destination);


// On crée la miniature

        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);


// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

        if ($extension == 'jpg' || $extension == 'jpeg') {
            imagejpeg($destination, $directory . $initialName . self::NAME_XL . '.jpg');
        } else {
            imagepng($destination, $directory . $initialName . self::NAME_XL . '.png');
        }

    }
}