<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 01/01/2015
 * Time: 12:13
 */
class Helper
{

    /**
     * Méthode qui traite du texte
     *
     * @param $string
     *
     * @return mixed|string
     */
    static function textTraitement($string)
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
    static function form($input)
    {
        return isset($_POST[$input]) ? $_POST[$input] : '';
    }

}