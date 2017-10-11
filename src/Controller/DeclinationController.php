<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:39
 */

namespace Karura\Controller;


use Karura\Model\DeclinationManager;

class DeclinationController extends Controller
{
    public function showAllAction()
    {
        $declinationManager = new DeclinationManager();
        $declinations = $declinationManager->findAll();

        return $this->twig->render('Declination/showAll.html.twig', [
                'declinations' => $declinations,
            ]);
    }

    public function showOneAction($id)
    {
        $declinationManager = new DeclinationManager();
        $declination = $declinationManager->find($id);

        return $this->twig->render('Declination/showOne.html.twig', [
                'declination' => $declination,
            ]);
    }
}
