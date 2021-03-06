<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 16/10/17
 * Time: 13:52
 */

namespace Karura\Controller;


use Karura\Model\Color;
use Karura\Model\ColorManager;
use Karura\Model\DeclinationManager;

/**
 * Class ColorController
 * @package Karura\Controller
 */
class ColorController extends Controller
{
    /**
     * @return string
     */
    public function showAll()
    {
        $colorManager = new ColorManager();
        $colors = $colorManager->findAll();

        $declinationManager = new DeclinationManager();
        $declinationsNumber = [];
        foreach ($colors as $color) {
            $declinationsNumber[$color->getId()] = count($declinationManager->findByColor($color));
        }

        return self::render('Admin/adminColor.html.twig', [
            'colors' => $colors,
            'declinationsNumber' => $declinationsNumber,
        ]);
    }

    /**
     * @return string
     */
    public function addColor()
    {
        $errors = [];
        if (!empty($_POST)) {
            $colorManager = new ColorManager();

            // check errors
            if (empty($_POST['name'])) {
                $errors['name'] = 'Le nom de la couleur ne doit pas être vide';
            } else {
                if ($colorManager->findByName($_POST['name'])) {
                    $errors['name'] = 'Une couleur existe déjà sous ce nom, veuillez en spécifier un autre';
                }
            }


            if (empty($errors)) {
                $color = new Color();
                $color->setName($_POST['name']);
                $color->setHexa($_POST['hexa']);

                $colorManager->insert($color);

                self::setMessage('La couleur ' . $color->getName() . ' a été ajoutée à la base de données', 'success');

                header('Location: admin.php?route=admincolor');
                exit;
            }

        }

        if (!empty($errors)) {
            self::setMessage('Votre formulaire comporte des erreurs', 'danger', 'Erreur !');
        }

        return self::render('Admin/addColor.html.twig', [
            'errors' => $errors,
            'post' => $_POST,
        ]);
    }

    /**
     * @return string
     */
    public function updateColor()
    {
        $colorManager = new ColorManager();
        $errors = [];

        $color = $colorManager->find($_POST['color_id']);

        if (!empty($_POST['updating'])) {
            // check errors
            if (empty($_POST['name'])) {
                $errors['name'] = 'Le nom de la couleur ne doit pas être vide';
            } else {
                if ($colorManager->findByName($_POST['name']) and $_POST['name'] != $color->getName()) {
                    $errors['name'] = 'Une couleur existe déjà sous ce nom, veuillez en spécifier un autre';
                }
            }

            $color->setId($_POST['color_id']);
            $color->setName($_POST['name']);
            $color->setHexa($_POST['hexa']);

            if (empty($errors)) {
                $colorManager->update($color);

                self::setMessage('La couleur <strong>' . $color->getName() . '</strong> a bien été modifiée dans la base de données',
                    'success', 'Modification réussie !');

                header('Location: admin.php?route=admincolor');
                exit;
            } else {
                self::setMessage('Votre formulaire comporte des erreurs', 'danger', 'Erreur !');
            }

        }

        return self::render('Admin/updateColor.html.twig', [
            'color' => $color,
            'errors' => $errors,]);
    }

    /**
     * @return string
     */
    public function deleteColor()
    {
        if (!empty($_POST['color_id'])) {
            $colorManager = new ColorManager();
            $color = $colorManager->find($_POST['color_id']);
            $colorManager->delete($color);

            self::setMessage('La couleur ' . $color->getName() . ' a bien été supprimée de la base de données', 'success');

            header('Location: admin.php?route=admincolor');
            exit;
        }

    }
}