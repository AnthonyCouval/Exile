<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 01:09
 */
namespace Exile;
use PDO;

class Db extends Config
{

    private $_serveur;
    private $_user;
    private $_pass;
    private $_bdd;
    private $_port;
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
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * récupére tous les événements depuis la base de données
     * @return mixed
     */
    public function getAllEventsFromDB()
    {
        $sql_r = 'SELECT * FROM events WHERE corbeille = 0';
        $req_r = $this->_cnx->prepare($sql_r);
        $req_r->execute();
        $events = $req_r->fetchAll(PDO::FETCH_OBJ);
        $req_r->closeCursor();
        return $events;
    }
}