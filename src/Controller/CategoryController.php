<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:39
 */

namespace Karura\Controller;


use Karura\Model\CategoryManager;

class CategoryController
{
    public function showAllAction()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();
        require '../src/view/Category/showAll.php';
    }

    public function showOneAction($id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->find($id);
        require '../src/View/Category/showOne.php';
    }
}
