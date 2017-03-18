<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 01:25
 */
namespace Core;

class Config extends Exile
{

    private static $dev = true;
    private static $config;

    /**
     * Charge la config
     *
     */
    public static function setConfig()
    {
        self::setConfigFromJson();
        if(empty(self::$config->env->path) === false) {
            self::$rootpath = self::$config->env->path;
        }
        self::setEnvironment();
    }


    /**
     * Set l'environnement à l'objet
     * et active le reporting d'erreur en fonction
     */
    private static function setEnvironment()
    {
        if (self::$config->env->dev === true) {
            self::$dev = true;
        }
        self::setReporting();
    }

    /**
     * Va chercher la Config depuis le json
     */
    private static function setConfigFromJson()
    {
        $jsonConfig = file_get_contents(self::$rootapp . '/config/config.json');
        self::$config = json_decode($jsonConfig);
    }

    /**
     * Set le reporting d'erreur en fonction de l'environnement
     */
    private static function setReporting()
    {
        if (self::$dev) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', self::$rootapp . self::$DS . 'tmp' . self::$DS . 'logs' . self::$DS . 'errors.log');
        }
    }
}