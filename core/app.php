<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 00:49
 */
namespace Core;
use Lib;

class Exile
{

    public static $version = '2.0.0';
    public static $name    = 'Exile PHP Framework';
    public static $ROOTPATH;
    public static $ROOTAPP;
    public static $ROOTDIR;
    public static $DS;
    public static $ENVAR;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $env = require __DIR__ . '/env.php';
        self::$ROOTAPP = $env['ROOTPATH'];
        self::$ROOTDIR = $env['ROOTDIR'];
        self::$DS = DIRECTORY_SEPARATOR;

        spl_autoload_register(array($this, 'autoloader'));

        Config::setConfig();
    }

    /**
     * Autoloader de classes contenues dans chaque dossier de core/, récursif
     *
     * @param $class
     */
    private function autoloader($class)
    {

        $dir_iterator = new \RecursiveDirectoryIterator(self::$ROOTAPP . '/core');
        $iterator = new \RecursiveIteratorIterator($dir_iterator, \RecursiveIteratorIterator::SELF_FIRST);
        $class = strtolower(str_replace('Core\\', '', $class));
        foreach ($iterator as $file) {
            if ( ! $iterator->isDot() && $iterator->isFile() === true && ! file_exists($class . '.php')) {
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
     * @return \Lib\Auth
     */
    public function loadAuth($cnx)
    {
        return new \Lib\Auth($cnx);
    }

    /**
     * Charge la classe de gestion des messages d'alerte
     */
    public function loadMessage()
    {
        return new \Lib\Message();
    }

    public function bootstrap()
    {
        //$db = $exile->loadDB();
        //$cnx = $db->getCnx();
        $controller = $this->loadController();
        self::$ENVAR = [
            'controller' => $controller,
            'view' => $controller->getView(),
            'action' => $controller->getAction(),
            'pages' => $controller->getPages(),
            'admin' => $controller->isAdmin(),
            //$isLog = $exile->loadAuth($cnx)->isLog();
            'msg' => $this->loadMessage()
        ];
    }
}