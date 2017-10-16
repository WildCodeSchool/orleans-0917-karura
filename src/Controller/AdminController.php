<?php

namespace Karura\Controller;

use Karura\Model\CategoryManager;
use Karura\Model\ColorManager;

class AdminController extends Controller
{
    /**
     * @return string
     */
    public function showMainPage()
    {
        return $this->twig->render('Admin/adminMainPage.html.twig', [
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

        return $this->twig->render('Admin/adminCategory.html.twig', [
            'categories' => $categories,
        ]);
    }
}