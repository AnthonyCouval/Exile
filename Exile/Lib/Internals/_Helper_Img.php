<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 12/01/2015
 * Time: 20:01
 */
class _Helper_Img
{

    static $DestinationDirectory = 'www/img/';
    static $ImgPresent;
    static $titreLogo;
    static $TempSrc;
    static $ImageType;
    static $ImageName;

    /**
     * Vérifie si l'image est présente et a bien été uploadée
     * @param $img
     * @return bool
     */
    static function isImgPresent($img)
    {
        if ( ! isset($img['imageFile']) || ! is_uploaded_file($img['imageFile']['tmp_name'])) {
            return false;
        }
        return true;
    }

    /**
     * génère un numéro aléatoire
     * @return int
     */
    static function randomNumber()
    {
        return rand(0, 9999999999);
    }

    /**
     * On set toutes les données de l'image
     * @param $img
     * @param $titre
     */
    static function getImgInfo($img, $titre)
    {
        self::$ImageName  = str_replace(' ', '-', strtolower($img['imageFile']['name'])); //on vire les espaces dans le nom de l'image
        self::$titreLogo = str_replace(' ', '-', strtolower($titre));
        self::$TempSrc    = $img['imageFile']['tmp_name']; // le nom temporaire
        self::$ImageType  = $img['imageFile']['type'];     // le type, retourne "image/png", image/jpeg, text/plain etc.
    }

    /**
     * teste si l'extension est ok
     * @param $img
     * @return bool
     */
    static function isExtensionOk($img)
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
     * @param $img
     * @return bool
     */
    static function isSizeOk($img)
    {
        //taille maximum (en octets)
        $taille_maxi = 10000000;
        //taille du fichier
        $taille = filesize($img['imageFile']['tmp_name']);
        if ($taille > $taille_maxi) {
            return false;
        }
        return true;
    }

}