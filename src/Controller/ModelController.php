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
use Karura\Model\Model;
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

        return self::render('Model/showAll.html.twig', [
            'models' => $models,
        ]);
    }

    /**
     * @return string
     */
    public function showAllAdminAction()
    {
        // search models all model and sort by category
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        $modelManager = new ModelManager();
        $modelsByCat = [];
        foreach ($categories as $category) {
            $modelsByCat[$category->getName()] = $modelManager->findByCategory($category);
        }

        // search number of declination by models
        $models = $modelManager->findAll();

        $declinationManager = new DeclinationManager();
        $declinationsNumber = [];
        foreach ($models as $model) {
            $declinationsNumber[$model->getId()] = count($declinationManager->findByModel($model));
        }

        $active_category = !empty($_GET['active_category']) ? $_GET['active_category'] : $categories[0]->getName() ;

        return self::render('Admin/adminModels.html.twig', [
            'modelsByCat' => $modelsByCat,
            'declinationsNumber' => $declinationsNumber,
            'active_category' => $active_category
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
            $declinationsByModel = array_merge($declinationsByModel, $declinationManager->findByModel($model, true));
        }

        $modelManager = new ModelManager();
        $models = $modelManager->findAll();
        $modelNames = [];
        foreach ($models as $model) {
            $modelNames[$model->getId()] = $model->getName();
        }

        if ($searchInput) {
            return self::render('Model/showSearch.html.twig', [
                'declinations' => $declinationsByModel,
                'searchInput' => $searchInput,
                'models' => $modelNames,
            ]);
        } else {
            header('Location: index.php?route=catalog');
            exit();

        }
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
        $declinationsByCategory = $declinationManager->findByCategory($category, true);

        $modelManager = new ModelManager();
        $models = $modelManager->findAll();
        $modelNames = [];
        foreach ($models as $model) {
            $modelNames[$model->getId()] = $model->getName();
        }

        return self::render('Model/showSearch.html.twig', [
            'declinations' => $declinationsByCategory,
            'models' => $modelNames,
            'category' => $category,
        ]);
    }

    public function showProduct()
    {
        $modelManager = new ModelManager();
        $model = $modelManager->find((int)$_GET["modelId"]);

        $declinationManager = new DeclinationManager();
        $declinationsByModel = $declinationManager->findByModel($model);
        foreach ($declinationsByModel as $declination) {
            if ($declination->getColorId() == ($_GET["colorId"])) {
                $declinationByColor = $declination;
            }
        }
        return self::render('Model/product.html.twig', [
            'declinations' => $declinationsByModel,
            'model' => $model,
            'declinationByColor' => $declinationByColor,
        ]);
    }

    // CRUD of models //

    /**
     * @return string
     */
    public function addModel()
    {
        $errors = [];
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        if (!empty($_POST)) {
            $modelManager = new ModelManager();

            // check errors
            if (empty($_POST['name'])) {
                $errors['name'] = 'Le nom du modèle ne doit pas être vide';
            } else {
                if ($modelManager->findByName($_POST['name'])) {
                    $errors['name'] = 'Un modèle existe déjà sous ce nom, veuillez en spécifier un autre';
                }
            }


            if (empty($errors)) {
                $model = new Model();
                $model->setName($_POST['name']);
                $model->setDescription($_POST['description']);
                $model->setCategoryId($_POST['category']);
                $model->setHomeModel(0);

                $modelManager->insert($model);

                $category = $categoryManager->find($model->getCategoryId());

                self::setMessage('Le modèle <strong>' . $model->getName() . '</strong> a été ajouté à la base de données', 'success');

                header('Location: admin.php?route=adminmodel&active_category=' . $category->getName());
                exit;
            }

        }

        if (!empty($errors)) {
            self::setMessage('Votre formulaire comporte des erreurs', 'danger', 'Erreur !');
        }

        return self::render('Admin/addModel.html.twig', [
            'errors' => $errors,
            'post' => $_POST,
            'categories' => $categories,
        ]);
    }

    /**
     * @return string
     */
    public function updateModel()
    {
        $errors = [];
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        $modelManager = new ModelManager();

        $model = $modelManager->find($_POST['model_id']);

        if (!empty($_POST['updating'])) {
            // check errors
            if (empty($_POST['name'])) {
                $errors['name'] = 'Le nom du modèle ne doit pas être vide';
            } else {
                if ($modelManager->findByName($_POST['name'], true) and $_POST['name'] != $model->getName()) {
                    $errors['name'] = 'Un modèle existe déjà sous ce nom, veuillez en spécifier un autre';
                }
            }

            $model->setId($_POST['model_id']);
            $model->setName($_POST['name']);
            $model->setDescription($_POST['description']);
            $model->setCategoryId($_POST['category']);

            if (empty($errors)) {
                $modelManager->update($model);

                $category = $categoryManager->find($model->getCategoryId());

                self::setMessage('Le modèle <strong>' . $model->getName() . '</strong> a bien été modifié dans la base de données',
                    'success', 'Modification réussie !');

                header('Location: admin.php?route=adminmodel&active_category=' . $category->getName());
                exit;

            } else {
                self::setMessage('Votre formulaire comporte des erreurs', 'danger', 'Erreur !');

            }
        }

        return self::render('Admin/updateModel.html.twig', [
            'model' => $model,
            'categories' => $categories,
            'errors' => $errors,
        ]);

    }

    /**
     * @return string
     */
    public
    function deleteModel()
    {
        if (!empty($_POST['model_id'])) {
            $modelmanager = new ModelManager();
            $model = $modelmanager->find($_POST['model_id']);
            $modelmanager->delete($model);

            $categoryManager = new CategoryManager();
            $category = $categoryManager->find($model->getCategoryId());

            self::setMessage('Le modèle <strong>' . $model->getName() . '</strong> a bien été supprimé de la base de données', 'success');

            header('Location: admin.php?route=adminmodel&active_category=' . $category->getName());
            exit;
        }

    }

}
