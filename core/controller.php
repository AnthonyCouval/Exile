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

namespace Core;

class Controller extends Exile
{
    private $noAction   = false;
    private $noView     = false;
    private $action;
    private $view;
    private $request;
    private $tooManyRequest;
    private $pages;
    private $admin      = false;
    private $params;
    private $webService = false;

    /**
     * Constructeur
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->initRequest();
        $this->buildPage();
        if ( ! $this->isAjax()) {
            $this->pagesToInclude();
        }
    }

    /**
     * Methode qui découpe la request
     */
    public function initRequest()
    {
        $arrayOfRequests = explode('/', $this->request);
        if(self::$ROOTPATH !== null) {
            unset($arrayOfRequests[0]);
        }
        $arrayOfRequests = array_values($arrayOfRequests);
        $this->verifRequest($arrayOfRequests);
        $this->buildView($arrayOfRequests);
        $this->buildAction($arrayOfRequests);
    }

    /**
     * Si le web service est requêté
     *
     * @param $arrayOfRequests
     *
     */
    private function isWebService($arrayOfRequests)
    {
        if ($arrayOfRequests[1] == 'web' && $arrayOfRequests[2] == 'service') {
            $this->params = $this->extractParams($arrayOfRequests[3]);
            $this->webService = true;
        }
    }

    private function extractParams($params)
    {
        parse_str($params, $tabParams);

        return $tabParams;
    }

    /**
     * verifie si la requête est valide
     *
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
     *
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
     *
     * @param $arrayOfRequests
     */
    private function buildAction($arrayOfRequests)
    {
        if (isset($arrayOfRequests[2]) && ! empty($arrayOfRequests[2])) {
            $action = $arrayOfRequests[2];
        } else {
            $action = $this->view;
        }
        $this->setAction($action);
    }

    /**
     * Méthode qui détecte les requêtes Ajax
     *
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
        if ($this->view == 'home') $this->action = 'home';
        if ($this->view == 'admin') {
            $this->admin = true;
            if (isset($this->action) && ! empty($this->action)) {
                $this->view = $this->action;
                if ( ! (file_exists('../webapp/actions/admin/' . $this->action . '.php'))) $this->noAction = true;
                if ( ! (file_exists('../webapp/views/admin/' . $this->view . '.php'))) $this->noView = true;
            }
        } else {
            if (isset($this->action) && ! empty($this->action)) {
                if ( ! (file_exists('../webapp/actions/' . $this->action . '.php'))) $this->noAction = true;
            }
            if (isset($this->view) && $this->view != '/') {
                if ( ! (file_exists('../webapp/views/' . $this->view . '.php'))) $this->noView = true;
            }
        }
    }

    /**
     * Methode qui retourne les pages à inclure
     */
    public function pagesToInclude()
    {
        if ($this->webService) {
            $pages = array(
                '/webapp/actions/' . $this->action . '.php',
                '/webapp/views/' . $this->view . '.php'
            );
        } else {
            if (($this->noView == true || $this->noAction == true || $this->getTooManyRequest())) :
                $pages = array(
                    '/webapp/globals/head.php',
                    '/webapp/globals/header404.php',
                    '/webapp/views/404.php',
                    '/webapp/globals/footer.php'
                );
            else:
                if ($this->admin) {
                    $pages = array(
                        '/webapp/actions/admin/' . $this->action . '.php',
                        '/webapp/globals/head.php',
                        '/webapp/globals/admin/header.php',
                        '/webapp/views/admin/' . $this->view . '.php',
                        '/webapp/globals/admin/footer.php'
                    );
                } else {
                    $pages = array(
                        '/webapp/actions/' . $this->action . '.php',
                        '/webapp/globals/head.php',
                        '/webapp/globals/header.php',
                        '/webapp/views/' . $this->view . '.php',
                        '/webapp/globals/footer.php'
                    );
                }
            endif;
        }
        $this->pages = $pages;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return mixed
     */
    private function getTooManyRequest()
    {
        return $this->tooManyRequest;
    }

    /**
     * @param mixed $tooManyRequest
     */
    private function setTooManyRequest($tooManyRequest)
    {
        $this->tooManyRequest = $tooManyRequest;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    private function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $view
     */
    private function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }
}