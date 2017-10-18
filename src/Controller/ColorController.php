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

        // TODO add number of declinations per color ?

        return $this->twig->render('Admin/adminColor.html.twig', [
            'colors' => $colors,
        ]);
    }

    /**
     * @return string
     */
    public function addColor()
    {
        if (!empty($_POST)) {
            $color = new Color();
            foreach ($_POST as $key => $value) {
                $set = 'set' . ucfirst($key);
                $color->$set($value);
            }

            $colorManager = new ColorManager();
            $colorManager->insert($color);

            header('Location: index.php?route=admincolor');
        }

        return $this->twig->render('Admin/addColor.html.twig');
    }

    /**
     * @return string
     */
    public function updateColor()
    {
        $colorManager = new ColorManager();

        if (!empty($_POST['updating'])) {
            $color = new Color();
            $color->setId($_POST['id']);
            $color->setName($_POST['name']);
            $color->setHexa($_POST['hexa']);


            $colorManager->update($color);

            header('Location: index.php?route=admincolor');
        }

        $color = $colorManager->find($_POST['color_id']);
        return $this->twig->render('Admin/updateColor.html.twig', [
            'color' => $color,
        ]);

    }

    /**
     * @return string
     */
    public function deleteColor()
    {
        $colorManager = new ColorManager();
        $color = $colorManager->find($_POST['color_id']);
        $colorManager->delete($color);

        return $this->showAll();
    }
}