<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 18/01/2015
 * Time: 10:30
 */
class _Auth
{
    private $cnx;

    /**
     * Constructeur
     * @param $bdd
     */
    public function __construct($bdd)
    {
        $this->cnx = $bdd;
    }

    /**
     * Méthode qui définie si un utilisateur est connecté ou pas
     * @return bool
     */
    public function isLog()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['Auth']) && isset($_SESSION['Auth']['pseudo']) && isset($_SESSION['Auth']['password']))
        {
            $q   = array('pseudo' => $_SESSION['Auth']['pseudo'], 'password' => $_SESSION['Auth']['password']);
            $sql = 'SELECT pseudo, password FROM admins WHERE pseudo = :pseudo AND password = :password';
            $req = $this->cnx->prepare($sql);
            $req->execute($q);
            $count = $req->rowCount($sql);
            if ($count == 1)
            {
                return true;
            }
        }
        return false;
    }
}