<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:39
 */

namespace Karura\Controller;

use Karura\Model\CategoryManager;
use Karura\Model\DeclinationManager;
use Karura\Model\ModelManager;

/**
 * Class ModelController
 * @package Karura\Controller
 */
class ModelController extends Controller
{
    /**
     * @return string
     */
    public function showAllAction()
    {
        $modelManager = new ModelManager();
        $models = $modelManager->findAll();

        return $this->twig->render('Model/showAll.html.twig', [
            'models' => $models,
        ]);
    }

    /**
     * @param $id
     */
    public function showOneAction($id)
    {
        $modelManager = new ModelManager();
        $model = $modelManager->find($id);
        // TODO
    }

    /**
     * @param string $searchInput
     * @return string
     */
    public function showSearchAction(string $searchInput)
    {
        $modelManager = new ModelManager();
        $models = $modelManager->findByName($searchInput);

        $declinationManager = new DeclinationManager();
        $declinationsByModel = [];
        foreach ($models as $model) {
            $declinationsByModel = array_merge($declinationsByModel, $declinationManager->findByModel($model));
        }

        return $this->twig->render('Model/showSearch.html.twig', [
            'declinations' => $declinationsByModel,
            'searchInput' => $searchInput,
        ]);
    }

    /**
     * @param $category
     * @return string
     */
    public function showByCategoryAction($category)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findByName($category);

        $declinationManager = new DeclinationManager();
        $declinationsByCategory = $declinationManager->findByCategory($category);

        return $this->twig->render('Model/showSearch.html.twig', [
            'declinations' => $declinationsByCategory,
        ]);
    }

    public function showProduct()
    {
        $modelManager = new ModelManager();
        $model = $modelManager->find((int)$_GET["modelId"]);

        $declinationManager = new DeclinationManager();
        $declinationsByModel = $declinationManager->findByModel($model);
        foreach($declinationsByModel as $declination){
            if ($declination->getColorId()==((int)$_GET["colorId"])){
                $declinationByColor = $declination;
            }
        }
        return $this->twig->render('Model/product.html.twig', [
            'declinations' => $declinationsByModel,
            'model' => $model,
            'declinationByColor' => $declinationByColor,
        ]);

    }

}
