<?php

namespace Karura\Controller;

use Karura\Model\CategoryManager;
use Karura\Model\DeclinationManager;

class HomeController extends Controller
{
    public function showHome()
    {
        // show some models in home -> using model manager
        //1* find all category
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        //2* find all declinations
        $declinationManager = new DeclinationManager();
        foreach ($categories as $category) {
            $declinationsByCat[] = $declinationManager->findByCategory($category);
        }
        //var_dump($declinationsByCat);

        // pour le moment affichage des modeles avec TOUTES les couleurs dispos
        // à terme on affichera uniquement une des couleur + modal
        return $this->twig->render('home.html.twig', [
            'declinationsByCat' => $declinationsByCat,
        ]);
    }
}