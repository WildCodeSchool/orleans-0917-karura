<?php

namespace Karura\Controller;

use Karura\Model\CategoryManager;
use Karura\Model\DeclinationManager;

class HomeController extends Controller
{
    /**
     * @return string
     */
    public function showHome()
    {
        // show some models in home -> using model manager
        //1* find all category
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        //2* find all declinations for each category
        $declinationManager = new DeclinationManager();
        $declinationsByCat = [];
        foreach ($categories as $category) {
            $declinationsByCat[$category->getName()] = $declinationManager->findByCategory($category);
        }
        // pour le moment affichage des modeles avec TOUTES les couleurs dispos
        // à terme on affichera uniquement une des couleur + modal
        return $this->twig->render('home.html.twig', [
            'declinationsByCat' => $declinationsByCat,
        ]);
    }

    /**
     * @return string
     */
    public function showContact()
    {
        // show contact page
        // make args to formate form when you came from model contact redirection
        // TODO
        //
        return $this->twig->render('contact.html.twig', [
            'data_id' => 'data',
        ]);
    }

    /**
     * @return string
     */
    public function showMentions()
    {
        // show mentions légales
        return $this->twig->render('mentions.html.twig', [
            'data_id' => 'data',
        ]);
    }
}