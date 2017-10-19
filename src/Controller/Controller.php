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
    static public $twig;

    /**
     * @return \Twig_Environment
     */
    static public function getTwig(): \Twig_Environment
    {
        if (self::$twig === Null) {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
            self::$twig = new \Twig_Environment($loader, array(
                'cache' => false,
            ));
        }

        return self::$twig;
    }

    public function __construct()
    {
        // define sessions vars
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['message'])) {
            $_SESSION['message'] = '';
        }
        if (empty($_SESSION['message_title'])) {
            $_SESSION['message_title'] = '';
        }
        if (empty($_SESSION['message_type'])) {
            $_SESSION['message_type'] = '';
        }


    }

    static public function setMessage($message, $type = 'info', $title = 'Message : ')
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['message'] = $message;
        $_SESSION['message_title'] = $title;
        $_SESSION['message_type'] = $type;
    }

    static public function render(string $view, array $args_tab = [])
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $args = [
            'message' => $_SESSION['message'],
            'message_title' => $_SESSION['message_title'],
            'message_type' => $_SESSION['message_type'],
        ];
        $args_tab = array_merge($args_tab, $args);

        $view = self::getTwig()->render($view, $args_tab);
        self::setMessage('');// burn after reading
        return $view;
    }

}