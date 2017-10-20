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