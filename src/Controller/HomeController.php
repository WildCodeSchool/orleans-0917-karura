<?php

namespace Karura\Controller;

use Karura\Model\CategoryManager;
use Karura\Model\DeclinationManager;
use Karura\Model\ModelManager;

class HomeController extends Controller
{
    /**
     * @return string
     */
    public function showHome()
    {
        // show some models in home -> using model manager
        //1* find all category
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();
        $modelManager = new ModelManager();
        $declinationsByCat = [];

        foreach ($categories as $category) {
            $modelsByCat[$category->getName()] = $modelManager->findHomeModelsByCat($category);
            $declinationsByCat[$category->getName()] = [];
            $declinationManager = new DeclinationManager();
            foreach ($modelsByCat[$category->getName()] as $model) {
                $decl = $declinationManager->findByModel($model)[0];
                $key = $model->getHomeModel();
                $declinationsByCat[$category->getName()][$key] = $decl;
            }
        }

        $modelNames = [];
        $models = $modelManager->findAll();
        foreach ($models as $model) {
            $modelNames[$model->getId()] = $model->getName();
        }
        // TODO pour le moment affichage des modeles avec TOUTES les couleurs dispos
        return self::render('home.html.twig', [
            'declinationsByCat' => $declinationsByCat,
            'models' => $modelNames,
        ]);
    }


    /**
     * @return string
     */
    public function showCatalog()
    {
        // show some models in home -> using model manager
        //1* find all category
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        //2* find all declinations for each category
        $declinationManager = new DeclinationManager();
        $declinationsByCat = [];
        foreach ($categories as $category) {
            $declinationsByCat[$category->getName()] = $declinationManager->findByCategory($category);
        }

        $modelManager = new ModelManager();
        $models = $modelManager->findAll();
        $modelNames = [];
        foreach ($models as $model) {
            $modelNames[$model->getId()] = $model->getName();
        }

        // TODO pour le moment affichage des modeles avec TOUTES les couleurs dispos
        // à terme on affichera uniquement une des couleur + modal
        return self::render('catalog.html.twig', [
            'declinationsByCat' => $declinationsByCat,
            'models' => $modelNames,
        ]);
    }

    /**
     * @return string
     */
    public function showContact()
    {
        // show contact page
        // make args to formate form when you came from model contact redirection
        // TODO

        $errors = [];

        if (!empty($_POST['submitForm'])) {

            if (empty($_POST['formLastName'])) {
                $errors['formLastName'] = "Merci de renseigner votre nom";
            }
            if (empty($_POST['formMail'])) {
                $errors['formMail'] = "Merci de renseigner votre email";
            }
            if (empty($_POST['formMessage'])) {
                $errors['formMessage'] = "Merci d'écrire un message";
            }

            if (empty($errors)) {

                $setFrom = $_POST['formMail'];
                $gender = $_POST['gender'];
                $firstName = $_POST['formFirstName'];
                $lastName = $_POST['formLastName'];
                $phoneForm = $_POST['formTel'];
                $formMessage = $_POST['formMessage'];
                $header = "Envoi de message sur Karura.com";

                if ($phoneForm) {
                    $phone = $phoneForm;
                } else {
                    $phone = "non renseigné";
                }

                $messageSent = $gender . ' ' . $firstName . ' ' . $lastName . ' vous a envoyé un message sur Karura.com :' . "\r\n\r\n" . $formMessage . "\r\n\r\n" .
                    'E-mail : ' . $setFrom . "\r\n" . 'Téléphone : ' . $phone;

                require '../mailConfig.php';

                if (empty($errors)) {

                    self::setMessage('Votre message a correctement été envoyé.', 'success', 'Merci !');

                    header('Location: index.php');
                    exit();

                }
            }
        }

        return self::render('contact.html.twig', [
            'errors' => $errors,
            'post' => $_POST,
        ]);
    }

    /**
     * @return string
     */
    public function showMentions()
    {
        // show mentions légales
        return self::render('mentions.html.twig');
    }

    public function showAdminHome()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        return self::render('Admin/adminHome.html.twig', [
            'categories' => $categories,
        ]);
    }

    public function showAdminUpdate()
    {
        // show some models in home -> using model manager
        //1* find all category
        $categoryManager = new CategoryManager();
        $category = $categoryManager->find($_GET['id']);
        $modelManager = new ModelManager();
        $declinationsByCat = [];

        $modelsByCat[$category->getName()] = $modelManager->findHomeModelsByCat($category);
        $declinationsByCat[$category->getName()] = [];
        $declinationManager = new DeclinationManager();

        foreach ($modelsByCat[$category->getName()] as $model) {
            $decl = $declinationManager->findByModel($model)[0];
            $key = $model->getHomeModel();
            $declinationsByCat[$key] = $decl;
        }

        $modelNames = [];
        $models = $modelManager->findByCategory($category);
        foreach ($models as $model) {
            $modelNames[$model->getId()] = $model->getName();
        }

        if (!empty($_POST)) {

            if (count(array_unique($_POST['models'])) < 5) {

                $this->setMessage('Erreur : les cinq modèles doivent être différents', 'danger');

            } else {

                foreach ($modelsByCat[$category->getName()] as $model) {
                    $model->setHomeModel(0);
                    $modelManager->update($model);
                }

                foreach ($_POST['models'] as $key => $modelId) {
                    $model = $modelManager->find($modelId);
                    $model->setHomeModel($key + 1);
                    $modelManager->update($model);
                }

                $this->setMessage('Vos changements ont bien été pris en compte', 'success');
                header('Location: admin.php?route=adminhomeupdate&id=' . $_GET['id']);
                exit();
            }
        }

        // TODO pour le moment affichage des modeles avec TOUTES les couleurs dispos
        return self::render('Admin/adminHomeUpdate.html.twig', [
            'declinations' => $declinationsByCat,
            'models' => $modelNames,
            'category' => $category,
            'modelsInCat' => $models,
        ]);
    }
}
