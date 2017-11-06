<?php

namespace Karura\Controller;

use Karura\Model\CategoryManager;
use Karura\Model\ColorManager;

class AdminController extends Controller
{
//TODO A faire :
//- administrer les modèles :: DONE
//- administrer les variantes par modèle :: Via la page des modèles
//- administrer les couleurs :: DONE
//- administrer les catégories ??
//- administrer le formulaire de contact (email de redirection des messages)
//- administrer les modèles mis en avant sur l'accueil ?

    /**
     * @return string
     */
    public function showMainPage()
    {
        return self::render('Admin/adminMainPage.html.twig', [
            'data_id' => 'data',
        ]);
    }

    /**
     * @return string
     */
    public function showAdminCategory()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        return self::render('Admin/adminCategory.html.twig', [
            'categories' => $categories,
        ]);
    }

}