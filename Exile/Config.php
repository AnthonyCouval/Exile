<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 01:25
 */
namespace Exile;

class Config
{

    private $_dev = false;
    private $_config;

    /**
     * Charge la config
     * @return mixed
     */
    public function getConfig()
    {
        $this->setEnvironment();
        $this->getConfigFromJson();
        return $this->_config;
    }

    /**
     * Va chercher l'url du site
     * @return array
     */
    private function getEnvironment()
    {
        return explode('.', $_SERVER['SERVER_NAME']);
    }

    /**
     * Extrait l'environnement de l'url
     * @return mixed
     */
    private function extractEnvironment()
    {
        $env = $this->getEnvironment();
        return $env[0];
    }

    /**
     * Set l'environnement à l'objet
     * et active le reporting d'erreur en fonction
     */
    private function setEnvironment()
    {
        if ($this->extractEnvironment() == 'dev') {
            $this->_dev = true;
        }
        $this->setReporting();
    }

    /**
     * Va chercher la Config depuis le json
     */
    private function getConfigFromJson()
    {
        $jsonConfig   = file_get_contents(EXILE_ROOT_DIR . '/Config/config.json');
        $objConfig    = json_decode($jsonConfig);
        $this->_config = $objConfig->bdd->prod;
        if ($this->_dev) {
            $this->_config = $objConfig->bdd->dev;
        }
    }

    /**
     * Set le reporting d'erreur en fonction de l'environnement
     */
    private function setReporting()
    {
        if($this->_dev){
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        }else{
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', EXILE_ROOT_DIR.DS.'tmp'.DS.'logs'.DS.'errors.log');
        }
    }
}