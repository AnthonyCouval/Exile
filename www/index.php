<?php
require __DIR__ . '/../core/app.php';
use Core\Exile as Exile;

$exile = new Exile();
$exile->bootstrap();
$pages = Exile::$ENVAR['pages'];

if ($pages) {
    foreach ($pages as $page) {
        include Exile::$ROOTAPP . $page;
    }
}