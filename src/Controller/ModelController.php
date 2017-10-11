<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:39
 */

namespace Karura\Controller;



use Karura\Model\ModelManager;

class ModelController
{
    public function showAllAction()
    {
        $modelManager = new ModelManager();
        $models = $modelManager->findAll();
        require '../src/view/Model/showAll.php';
    }

    public function showOneAction($id)
    {
        $modelManager = new ModelManager();
        $model = $modelManager->find($id);
        require '../src/View/Model/showOne.php';
    }
}
