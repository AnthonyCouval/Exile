<?php

return [
    'ROOTPATH' => realpath(dirname(__FILE__) . '/../'),
    'ROOTDIR' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
];