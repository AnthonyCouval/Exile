<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 01:09
 */
namespace Core;

use PDO;

class Db extends Config
{

    private   $_serveur;
    private   $_user;
    private   $_pass;
    private   $_bdd;
    private   $_port;
    protected $_cnx;

    /**
     * @return mixed
     */
    public function getCnx()
    {
        return $this->_cnx;
    }

    /**
     * Constructeur
     */
    public function __construct()
    {
//        $configLoaded  = $this->getConfig();
//        $this->_serveur = $configLoaded->serveur;
//        $this->_user    = $configLoaded->user;
//        $this->_pass    = $configLoaded->pass;
//        $this->_bdd     = $configLoaded->bdd;
//        $this->_port    = $configLoaded->port;
//        $this->connectToDB();
    }

    /**
     * Méthode qui permet de se loguer à la bdd
     */
    public function connectToDB()
    {
        try {
            $cnx = new PDO('mysql:host=' . $this->_serveur . ';port=' . $this->_port . ';dbname=' . $this->_bdd, $this->_user, $this->_pass);
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cnx->exec('SET NAMES utf8');
            $this->_cnx = $cnx;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}