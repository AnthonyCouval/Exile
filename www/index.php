<?php
require __DIR__ . '/../core/app.php';
use Core\Exile as Exile;

$exile = new Exile();
$controller = $exile->loadController();
//$db = $exile->loadDB();
//$cnx = $db->getCnx();
$view = $controller->getView();
$action = $controller->getAction();
$pages = $controller->getPages();
$admin = $controller->isAdmin();
//$isLog = $exile->loadAuth($cnx)->isLog();
$msg = $exile->loadMessage();

if ($pages) {
    foreach ($pages as $page) {
        include Exile::$rootapp . $page;
    }
}