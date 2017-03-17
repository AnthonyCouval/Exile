<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 19/01/2015
 * Time: 21:47
 */
class Message
{
    /**
     * Initialisation et affichage de l'alerte
     * @param $message
     * @param string $type
     */
    public function setFlash($message, $type = 'error')
    {
        $_SESSION['flash'] = array(
            'message' => $message,
            'type'    => $type
        );
        $this->flash();
    }

    /**
     * Affichage de l'alerte
     */
    public function flash()
    {
        if (isset($_SESSION['flash'])) {
            ?>
            <div id="alert-fw" class="alert alert-fw alert-<?php echo $_SESSION['flash']['type']; ?>">
                <button type="button" class="close">&times;</button>
                <?php echo $_SESSION['flash']['message']; ?>
            </div>
            <?php
            unset($_SESSION['flash']);
        }
    }

}