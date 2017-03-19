<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 01/01/2015
 * Time: 12:13
 */

namespace Lib;

class Helper
{

    /**
     * Méthode qui traite du texte
     *
     * @param $string
     *
     * @return mixed|string
     */
    public static function textTraitement($string)
    {
        $string = strtr($string,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $string = preg_replace('/([^.a-z0-9]+)/i', '-', $string);

        return $string;
    }

    /**
     * Pour garder les champs dans les formulaires
     *
     * @param $input
     *
     * @return string
     */
    public static function form($input)
    {
        return isset($_POST[$input]) ? $_POST[$input] : '';
    }

}