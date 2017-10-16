<?php
// loading autoload and connect to db
require "../vendor/autoload.php";
require '../connect.php';

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
            echo $colorController->showAll();
            break;

        case ('admincategory');
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