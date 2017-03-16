<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 00:49
 */
namespace Exile;

class Exile
{

    public static $version = '1.5.0';
    public static $name = 'Exile PHP Framework';

    /**
     * Constructeur
     */
    public function __construct()
    {
        spl_autoload_register(array($this, 'autoloader'));
    }

    /**
     * Autoloader de classes contenues dans chaque dossier de Exile/, récursif
     * @param $class
     */
    private function autoloader($class)
    {
        $dir_iterator = new \RecursiveDirectoryIterator(EXILE_ROOT_DIR . 'Exile/');
        $iterator     = new \RecursiveIteratorIterator($dir_iterator);
        $class        = str_replace('Exile\\', '', $class);
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