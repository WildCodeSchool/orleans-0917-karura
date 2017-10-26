<?php
// loading autoload and connect to db
require "../vendor/autoload.php";
require '../connect.php';

// session starting for dynamic everywhere you want message
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// routeur
if (!empty($_GET['route'])) {
    $route = $_GET['route'];
} else {
    $route = 'admin'; // go to home by default
}

if (substr($route, 0, 5) == 'admin') {
    // admin pages
    if (substr($route, 0, 10) == 'admincolor') {
        $colorController = new \Karura\Controller\ColorController();
        if ($route == 'admincoloradd') {
            echo $colorController->addColor();
        } elseif ($route == 'admincolordelete') {
            echo $colorController->deleteColor();
        } elseif ($route == 'admincolorupdate') {
            echo $colorController->updateColor();

        } else {
            echo $colorController->showAll();
        }

    } elseif ($route == 'admincategory') {
        $adminController = new \Karura\Controller\AdminController();
        echo $adminController->showAdminCategory();

    } else {
        $adminController = new \Karura\Controller\AdminController();
        echo $adminController->showMainPage();
    }
} elseif (substr($route, 0, 9) == 'adminform') {
    $formController = new \Karura\Controller\FormController();
    if ($route == 'admin-form-reception-address-update') {
        echo $formController->updateReceptionAddress();
    } else {
        echo $formController->showAll();
    }
}

?>