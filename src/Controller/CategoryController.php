<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:39
 */

namespace Karura\Controller;

use Karura\Model\CategoryManager;

class CategoryController extends Controller
{
    public function showAllAction()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        return $this->twig.render('Category/showAll.html.twig', [
                'categories' => $categories,
            ]);
    }

    public function showOneAction($id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->find($id);

        return $this->twig.render('Category/showOne.html.twig', [
                'category' => $category,
            ]);
    }
}
