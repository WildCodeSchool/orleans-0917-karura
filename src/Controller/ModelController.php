<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:39
 */

namespace Karura\Controller;

use Karura\Model\ModelManager;

class ModelController extends Controller
{
    public function showAllAction()
    {
        $modelManager = new ModelManager();
        $models = $modelManager->findAll();

        return $this->twig->render('Model/showAll.html.twig', [
            'models' => $models,
        ]);
    }

    public function showOneAction($id)
    {
        $modelManager = new ModelManager();
        $model = $modelManager->find($id);
        require '../src/View/Model/showOne.php';
    }

    public function showSearchAction(string $searchInput)
    {
        $modelManager = new ModelManager();
        $models = $modelManager->findByName($searchInput);

        return $this->twig->render('Model/showSearch.html.twig', [
            'models' => $models,
        ]);
    }
}
