<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 12/01/2015
 * Time: 20:01
 */
namespace Lib;

class HelperImg
{

    public static $destinationDirectory = 'www/img/';
    public static $imgPresent;
    public static $titreLogo;
    public static $srcTemp;
    public static $imageType;
    public static $imageName;

    /**
     * Vérifie si l'image est présente et a bien été uploadée
     *
     * @param $img
     *
     * @return bool
     */
    public static function isImgPresent($img)
    {
        if ( ! isset($img['imageFile']) || ! is_uploaded_file($img['imageFile']['tmp_name'])) {
            return false;
        }

        return true;
    }

    /**
     * génère un numéro aléatoire
     *
     * @return int
     */
    public static function randomNumber()
    {
        return rand(0, 9999999999);
    }

    /**
     * On set toutes les données de l'image
     *
     * @param $img
     * @param $titre
     */
    public static function getImgInfo($img, $titre)
    {
        self::$imageName = str_replace(' ', '-', strtolower($img['imageFile']['name']));
        self::$titreLogo = str_replace(' ', '-', strtolower($titre));
        self::$srcTemp = $img['imageFile']['tmp_name'];
        self::$imageType = $img['imageFile']['type'];
    }

    /**
     * teste si l'extension est ok
     *
     * @param $img
     *
     * @return bool
     */
    public static function isExtensionOk($img)
    {
        //On fait un tableau contenant les extensions autorisées.
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
        $extension = strrchr($img['imageFile']['name'], '.');
        //Ensuite on teste
        if ( ! in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            return false;
        }

        return true;
    }

    /**
     * Vérifie la taille de l'image
     *
     * @param $img
     *
     * @return bool
     */
    public static function isSizeOk($img, $size = 10000000)
    {
        //taille du fichier
        $taille = filesize($img['imageFile']['tmp_name']);
        if ($taille > $size) {
            return false;
        }

        return true;
    }

}