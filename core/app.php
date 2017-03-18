<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 00:49
 */
namespace Core;

class Exile
{

    public static $version  = '2.0.0';
    public static $name     = 'Exile PHP Framework';
    public static $rootpath = null;
    public static $rootapp;
    public static $rootdir;
    public static $DS;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $env = require __DIR__ . '/env.php';
        self::$rootapp = $env['ROOTPATH'];
        self::$rootdir = $env['ROOTDIR'];
        self::$DS = DIRECTORY_SEPARATOR;

        spl_autoload_register(array($this, 'autoloader'));

        Config::setConfig();
    }

    /**
     * Autoloader de classes contenues dans chaque dossier de Exile/, récursif
     *
     * @param $class
     */
    private function autoloader($class)
    {
        $dir_iterator = new \RecursiveDirectoryIterator(self::$rootapp . '/core');
        $iterator = new \RecursiveIteratorIterator($dir_iterator);
        $class = strtolower(str_replace('Core\\', '', $class));
        foreach ($iterator as $file) {
            if ( ! ($iterator->isDot()) && ! file_exists($class . '.php') && $class . '.php' == basename($file)) {
                require_once $file;
            }
        }

    }

    /**
     * Charge la Config
     */
    public function loadDB()
    {
        return new Db();
    }

    /**
     * Charge le controller
     */
    public function loadController()
    {
        return new Controller($_SERVER['REQUEST_URI']);
    }

    /**
     * Charge la classe d'authentification
     *
     * @param $cnx
     *
     * @return \Auth
     */
    public function loadAuth($cnx)
    {
        return new \Auth($cnx);
    }

    /**
     * Charge la classe de gestion des messages d'alerte
     */
    public function loadMessage()
    {
        return new \Message();
    }

}