<?php

namespace Karura\Controller;

use Karura\Model\CategoryManager;
use Karura\Model\ColorManager;

class AdminController extends Controller
{
    /**
     * @return string
     */
    public function showAdminMainPage()
    {
        return $this->twig->render('Admin/adminCategory.html.twig', [
            'data_id' => 'data',
        ]);
    }

    /**
     * @return string
     */
    public function showAdminColor()
    {
        $colorManager = new ColorManager();
        $colors = $colorManager->findAll();

        // TODO add number of declinations per color ?

        return $this->twig->render('Admin/adminColor.html.twig', [
            'colors' => $colors,
        ]);
    }

    /**
     * @return string
     */
    public function showAdminCategory()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        return $this->twig->render('Admin/adminCategory.html.twig', [
            'categories' => $categories,
        ]);
    }
}