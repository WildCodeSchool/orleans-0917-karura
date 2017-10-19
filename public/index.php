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
    $route = 'home'; // go to home by default
}


if ($route == 'home') {
    $homeController = new \Karura\Controller\HomeController();
    echo $homeController->showHome();

} elseif (substr($route, 0, 5) == 'admin') {
    // admin pages
    switch ($route) {
        case ('admincolor');
            $colorController = new \Karura\Controller\ColorController();
            if (!empty($_GET['action'])) {
                if ($_GET['action'] == 'add') {
                    echo $colorController->addColor();
                } elseif ($_GET['action'] == 'delete') {
                    echo $colorController->deleteColor();
                } elseif ($_GET['action'] == 'update') {
                    echo $colorController->updateColor();
                }
            } else {
                echo $colorController->showAll();
            }

            break;

        case ('admincategory');
            $adminController = new \Karura\Controller\AdminController();
            echo $adminController->showAdminCategory();
            break;

        default;
            $adminController = new \Karura\Controller\AdminController();
            echo $adminController->showMainPage();
    }

} elseif ($route == 'search') {
    // simple search in name of models
    $modelController = new \Karura\Controller\ModelController();
    echo $modelController->showSearchAction($_GET['search']);

} elseif ($route == 'category') {

    // models of one category
    $modelController = new \Karura\Controller\ModelController();
    echo $modelController->showByCategoryAction($_GET['category']);

} elseif
($route == 'contact') {

    // go to contact page
    $homeController = new \Karura\Controller\HomeController();
    echo $homeController->showContact();

} elseif
($route == 'mentions') {
    // go to mentions page
    $homeController = new \Karura\Controller\HomeController();
    echo $homeController->showMentions();

} else {
    // go to homepage by default
    $homeController = new \Karura\Controller\HomeController();
    echo $homeController->showHome();
}

?>