<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 14/01/2015
 * Time: 22:01
 */
/*
 * classe Controller
 * qui construit la page en fonction de l'URL demandée
 */

namespace Exile;

class Exile_Controller
{
    private $no_action = false;
    private $no_view = false;
    private $_action;
    private $_view;
    private $_request;
    private $_tooManyRequest;
    private $_pages;
    private $_admin = false;
    private $_params;
    private $_webService = false;

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->_admin;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->_pages;
    }

    /**
     * Constructeur
     * @param $request
     */
    public function __construct($request)
    {
        $this->_request = $request;
        $this->initRequest();
        $this->buildPage();
        if ( ! $this->isAjax()) {
            $this->pagesToInclude();
        }
    }

    /**
     * @return mixed
     */
    private function getTooManyRequest()
    {
        return $this->_tooManyRequest;
    }

    /**
     * @param mixed $tooManyRequest
     */
    private function setTooManyRequest($tooManyRequest)
    {
        $this->_tooManyRequest = $tooManyRequest;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * @param mixed $action
     */
    private function setAction($action)
    {
        $this->_action = $action;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->_view;
    }

    /**
     * @param mixed $view
     */
    private function setView($view)
    {
        $this->_view = $view;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Methode qui découpe la request
     */
    public function initRequest()
    {
        $arrayOfRequests = explode('/', $this->_request);
        $this->verifRequest($arrayOfRequests);
        $this->buildView($arrayOfRequests);
        $this->buildAction($arrayOfRequests);
    }

    /**
     * Si le web service est requêté
     * @param $arrayOfRequests
     * @return bool
     */
    private function isWebService($arrayOfRequests)
    {
        if ($arrayOfRequests[1] == 'web' && $arrayOfRequests[2] == 'service') {
            $this->_params     = $this->extractParams($arrayOfRequests[3]);
            $this->_webService = true;
        }
    }

    private function extractParams($params)
    {
        parse_str($params, $tabParams);
        return $tabParams;
    }

    /**
     * verifie si la requête est valide
     * @param $arrayOfRequests
     */
    private function verifRequest($arrayOfRequests)
    {
        if (($arrayOfRequests[1] == 'home' && count($arrayOfRequests) != 2)
            || (count($arrayOfRequests) > 3 && $this->isWebService($arrayOfRequests) == false)
        ) {
            $this->setTooManyRequest(true);
        }
    }

    /**
     * Methode de construction de la vue
     * @param $arrayOfRequests
     */
    private function buildView($arrayOfRequests)
    {
        $view = $arrayOfRequests[1];
        if (($view == '/' || empty($view) || ! isset($view)) && (empty($action) || ! isset($action))) {
            $view = 'home';
        }
        $this->setView($view);
    }

    /**
     * Methode de construction de l'action
     * @param $arrayOfRequests
     */
    private function buildAction($arrayOfRequests)
    {
        if (isset($arrayOfRequests[2]) && ! empty($arrayOfRequests[2])) {
            $action = $arrayOfRequests[2];
        } else {
            $action = $this->_view;
        }
        $this->setAction($action);
    }

    /**
     * Méthode qui détecte les requêtes Ajax
     * @return bool
     */
    private function isAjax()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }

    /**
     * Methode de construction de la page
     */
    public function buildPage()
    {
        if ($this->_view == 'home') $this->_action = 'home';
        if ($this->_view == 'admin') {
            $this->_admin = true;
            if (isset($this->_action) && ! empty($this->_action)) {
                $this->_view = $this->_action;
                if ( ! (file_exists('../WebApp/actions/admin/' . $this->_action . '.php'))) $this->no_action = true;
                if ( ! (file_exists('../WebApp/views/admin/' . $this->_view . '.php'))) $this->no_view = true;
            }
        } else {
            if (isset($this->_action) && ! empty($this->_action)) {
                if ( ! (file_exists('../WebApp/actions/' . $this->_action . '.php'))) $this->no_action = true;
            }
            if (isset($this->_view) && $this->_view != '/') {
                if ( ! (file_exists('../WebApp/views/' . $this->_view . '.php'))) $this->no_view = true;
            }
        }
    }

    /**
     * Methode qui retourne les pages à inclure
     */
    public function pagesToInclude()
    {
        if ($this->_webService) {
            $pages = array(
                'WebApp/actions/' . $this->_action . '.php',
                'WebApp/views/' . $this->_view . '.php'
            );
        } else {
            if (($this->no_view == true || $this->no_action == true || $this->getTooManyRequest())) :
                $pages = array(
                    'WebApp/globals/head.php',
                    'WebApp/globals/header404.php',
                    'WebApp/views/404.php',
                    'WebApp/globals/footer.php'
                );
            else:
                if ($this->_admin) {
                    $pages = array(
                        'WebApp/actions/admin/' . $this->_action . '.php',
                        'WebApp/globals/head.php',
                        'WebApp/globals/admin/header.php',
                        'WebApp/views/admin/' . $this->_view . '.php',
                        'WebApp/globals/admin/footer.php'
                    );
                } else {
                    $pages = array(
                        'WebApp/actions/' . $this->_action . '.php',
                        'WebApp/globals/head.php',
                        'WebApp/globals/header.php',
                        'WebApp/views/' . $this->_view . '.php',
                        'WebApp/globals/footer.php'
                    );
                }
            endif;
        }
        $this->_pages = $pages;
    }
}