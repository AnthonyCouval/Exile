<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 02/02/2015
 * Time: 21:34
 */
class Loader extends \Core\Exile
{

    /**
     * Méthode qui load le javascript
     *
     * @param bool $script
     * @param bool $admin
     */
    public static function loadJS($script = false, $admin = false)
    {
        $path = '/lib/';
        if ($admin == true) $path = '/admin/lib/';
        if ($script == false) {
            foreach (glob(self::$ROOTDIR . 'www/js' . $path . 'externals/*.js') as $jsfiles) {
                echo '<script type="text/javascript" src="' . self::$ROOTDIR . '/www/js' . $path . 'externals/' . basename($jsfiles) . '"></script>' . "\n";
            }
            foreach (glob(self::$ROOTDIR . 'www/js' . $path . 'internals/*.js') as $jsfiles) {
                echo '<script type="text/javascript" src="' . self::$ROOTDIR . '/www/js' . $path . 'internals/' . basename($jsfiles) . '"></script>' . "\n";
            }
        } else {
            echo '<script type="text/javascript" src="' . self::$ROOTDIR . '/www/js/' . $script . '.js"></script>' . "\n";
        }
    }

} 