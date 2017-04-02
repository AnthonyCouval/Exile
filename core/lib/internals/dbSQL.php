<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 01:09
 */
namespace Lib;

use PDO;
use \Core\Config as Config;

class DbSQL
{

    private   $serveur;
    private   $user;
    private   $pass;
    private   $db;
    private   $port;
    protected $cnx;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $configLoaded = Config::$config;
        $env = 'dev';
        if ($configLoaded->env->dev !== true) {
            $env = 'prod';
        }
        $this->serveur = $configLoaded->db->$env->serveur;
        $this->user = $configLoaded->db->$env->user;
        $this->pass = $configLoaded->db->$env->pass;
        $this->db = $configLoaded->db->$env->bdd;
        $this->port = $configLoaded->db->$env->port;
        $this->connectToDB();
    }

    /**
     * Méthode qui permet de se loguer à la bdd
     */
    public function connectToDB()
    {
        try {
            $cnx = new PDO('mysql:host=' . $this->serveur . ';port=' . $this->port . ';dbname=' . $this->db, $this->user, $this->pass);
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->cnx = $cnx;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getCnx()
    {
        return $this->cnx;
    }

}