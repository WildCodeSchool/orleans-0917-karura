<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 11/10/17
 * Time: 13:48
 */

namespace Karura\Controller;


class Controller
{
    protected $twig;

    public function __construct ()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false,
        ));
    }
}