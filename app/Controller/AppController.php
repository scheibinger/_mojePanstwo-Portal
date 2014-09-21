<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('HttpSocket', 'Network/Http');
APP::import('Vendor', 'functions');
App::uses('I18n', 'I18n');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array(
        'mpapi',
        'DebugKit.Toolbar',
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'plugin' => 'paszport'
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email', 'password' => 'password'),
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'sha256'
                    ),
                    'userModel' => 'Paszport.User',
//                    'contain' => array('Language', 'Group', 'UserExpand'),
                )
            )
        ),
    );

    public $helpers = array(
        'Html',
        'Form',
        'Paginator',
        'Time',
        'Less.Less',
//        'Minify.Minify',
        'Application',
        'Combinator.Combinator',
    );

    public $statusbarCrumbs = array();
    public $statusbarMode = false;
    public $User = false;

    public $Applications = array(
		array(
			'id' => '16',
			'slug' => 'kto_tu_rzadzi',
			'name' => 'Kto tu rządzi?',
			'plugin' => 'KtoTuRzadzi',
			'type' => 'app',
			'home' => '1',
			'folder_id' => '13'
		),
		array(
			'id' => '12',
			'slug' => 'media',
			'name' => 'Media',
			'plugin' => 'media',
			'type' => 'app',
			'home' => '1',
			'folder_id' => '13'
		),
		array(
			'id' => '3',
			'slug' => 'sejmometr',
			'name' => 'Sejmometr',
			'plugin' => 'sejmometr',
			'type' => 'app',
			'home' => '1',
			'folder_id' => '13'
		),
		array(
			'id' => '9',
			'slug' => 'ustawy',
			'name' => 'Ustawy',
			'plugin' => 'ustawy',
			'type' => 'app',
			'home' => '1',
			'folder_id' => '13'
		),
		array(
			'id' => '6',
			'slug' => 'krs',
			'name' => 'Krajowy Rejestr Sądowy',
			'plugin' => 'krs',
			'type' => 'app',
			'home' => '1',
			'folder_id' => '13'
		),
		array(
			'id' => '5',
			'slug' => 'zamowienia_publiczne',
			'name' => 'Zamówienia publiczne',
			'plugin' => 'zamowienia_publiczne',
			'type' => 'app',
			'home' => '1',
			'folder_id' => '13'
		),
		array(
			'id' => '4',
			'slug' => 'moja_gmina',
			'name' => 'Moja Gmina',
			'plugin' => 'moja_gmina',
			'type' => 'app',
			'home' => '1',
			'folder_id' => '13'
		),
		array(
			'id' => '10',
			'slug' => 'kody_pocztowe',
			'name' => 'Kody Pocztowe',
			'plugin' => 'kody_pocztowe',
			'type' => 'app',
			'home' => '1',
			'folder_id' => '13'
		),
	);
    public $Streams = array(
        array(
            'id' => 1,
            'name' => '_mojePaństwo - główne wydanie',
            'selected' => true,
        ),
    );
    private $stream_id = 1;

    /**
     * Zwraca listę dostępnych aplikacji
     * @return array
     */
    public function getApplications()
    {
        return $this->Applications;
    }


    /**
     * Zwraca aktualną aplikację
     * lub false jeśli nie żadna nie jest aktywna w danej chwili
     * @return array|bool
     */
    public function getApplication()
    {
        if ($this->params->plugin) {
            foreach ($this->getApplications() as $app) {
                if ($app['slug'] == strtolower($this->params->plugin) || $app['slug'] == Inflector::underscore($this->params->plugin)) {
                    return $app;
                }
            }
        } else {
            return false;
        }
    }

    public function getStream()
    {
        if (empty($this->Streams))
            return false;

        for ($i = 0; $i < count($this->Streams); $i++)
            if ($this->Streams[$i]['id'] == $this->stream_id)
                return $this->Streams[$i];

        return $this->Streams[0];
    }

    public function getStreamId()
    {
        $stream = $this->getStream();
        if ($stream && isset($stream['id']))
            return $stream['id'];

        return false;
    }


    public function beforeFilter()
    {
						
        if (defined('PORTAL_DOMAIN')) {

            $pieces = parse_url(Router::url($this->here, true));

            if (defined('PK_DOMAIN') && ($pieces['host'] == PK_DOMAIN)) {

                // only certain actions are allowed in this domain
                // for other actions we are immediatly redirecting to PORTAL_DOMAIN

                if (stripos($_SERVER['REQUEST_URI'], '/dane/gminy/903') === 0) {

                    $this->redirect('http://' . PK_DOMAIN . substr($_SERVER['REQUEST_URI'], 15));
                    die();

                }

                if (
                    ($this->request->params['controller'] == 'gminy') &&
                    in_array($this->request->params['action'], array('view', 'okregi_wyborcze', 'interpelacje', 'posiedzenia', 'debaty', 'punkty', 'szukaj', 'rada_uchwaly', 'druki', 'radni_powiazania', 'radni', 'radni_dzielnic', 'darczyncy', 'wskazniki', 'zamowienia', 'organizacje', 'biznes', 'ngo', 'spzoz', 'dotacje_ue', 'rady_gmin_wystapienia', 'map', 'zamowienia_publiczne', 'prawo_lokalne', 'urzednicy', 'oswiadczenia', 'jednostki'))
                ) {
                	                	
                } elseif(
                	($this->request->params['controller'] == 'krs_podmioty') 
                ) {
                
                } else {

                    $this->redirect('http://' . PORTAL_DOMAIN . $_SERVER['REQUEST_URI']);
                    die();

                }


            } elseif ($pieces['host'] != PORTAL_DOMAIN) {

                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $this->redirect($protocol . PORTAL_DOMAIN . $this->here, 301);
                die();

            }

        }

        $this->response->header('Access-Control-Allow-Origin', $this->request->header('Origin'));
        $this->response->header('Access-Control-Allow-Credentials', true);

        # assigning translations for javascript use
        if ($this->params->plugin) {
            $path = ROOT . DS . APP_DIR . DS . 'Plugin' . DS . Inflector::camelize($this->params->plugin) . DS . 'Locale' . DS . Configure::read('Config.language') . DS . 'LC_MESSAGES' . DS . Inflector::underscore($this->params->plugin) . '.po';
        } else {
            $path = ROOT . DS . APP_DIR . DS . 'Locale' . DS . Configure::read('Config.language') . DS . 'LC_MESSAGES' . DS . 'default.po';
        }
        if (file_exists($path)) {
            $translations = I18n::loadPo($path);
            foreach ($translations as &$item) {
                $item = stripslashes($item);
                $item = preg_replace('/"/', '&quot;', $item);
            }
        } else {
            $translations = array();
        }
        $this->set('translation', $translations);

        parent::beforeFilter();
        $this->Auth->allow();

        $this->set('statusbarCrumbs', $this->statusbarCrumbs);
        $this->set('statusbarMode', $this->statusbarMode);
        $this->set('_APPLICATIONS', $this->getApplications());
        $this->set('_APPLICATION', $this->getApplication());

		
		
        // remember path for redirect if necessary
        if (Router::url(null) != '/null') { // hack for bug
            $this->Session->write('Auth.loginRedirect', Router::url(null, true));
        }
    }

    public function addStatusbarCrumb($item)
    {
        $this->statusbarCrumbs[] = $item;
        $this->set('statusbarCrumbs', $this->statusbarCrumbs);

    }
}