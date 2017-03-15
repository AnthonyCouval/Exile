<?php

define('DS', DIRECTORY_SEPARATOR);
define('EXILE_ROOT_DIR', realpath(dirname(__FILE__) . '/../') . '/');
define('ROOTPATH', 'http://' . $_SERVER['HTTP_HOST'], true);

require EXILE_ROOT_DIR . 'Exile/Exile.php';

use \Exile\Exile;

$exile = new Exile();
$controller = $exile->loadController();
$db = $exile->loadDB();
$cnx = $db->getCnx();
$view = $controller->getView();
$action = $controller->getAction();
$pages = $controller->getPages();
$admin = $controller->isAdmin();
$isLog = $exile->loadAuth($cnx)->isLog();
$msg = $exile->loadMessage();

if ($pages) {
    foreach ($pages as $page) {
        include EXILE_ROOT_DIR . $page;
    }
}