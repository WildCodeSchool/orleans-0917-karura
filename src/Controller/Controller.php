<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 11/10/17
 * Time: 13:48
 */

namespace Karura\Controller;

/**
 * Class Controller
 * @package Karura\Controller
 */
class Controller
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Controller constructor.
     */
    public function __construct ()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false,
        ));
        // make $_SESSION accessible in all twig views
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->twig->addGlobal('session', $_SESSION);
    }
}