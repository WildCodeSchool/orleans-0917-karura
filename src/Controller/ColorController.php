<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 16/10/17
 * Time: 13:52
 */

namespace Karura\Controller;


use Karura\Model\ColorManager;

/**
 * Class ColorController
 * @package Karura\Controller
 */
class ColorController extends Controller
{
    /**
     * @return string
     */
    public function showAll()
    {
        $colorManager = new ColorManager();
        $colors = $colorManager->findAll();

        // TODO add number of declinations per color ?

        return $this->twig->render('Admin/adminColor.html.twig', [
            'colors' => $colors,
        ]);
    }
}