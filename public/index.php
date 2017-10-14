<?php
// loading autoload and connect to db
require "../vendor/autoload.php";
require '../connect.php';

// routeur
if (!empty($_GET['route'])) {
    switch ($_GET['route']) {
        case ('search');
            // simple search in name of models
            $modelController = new \Karura\Controller\ModelController();
            echo $modelController->showSearchAction($_GET['search']);
            break;

        case ('category');
            // models of one category
            $modelController = new \Karura\Controller\ModelController();
            echo $modelController->showByCategoryAction($_GET['category']);
            break;

        case ('contact');
            // go to contact page
            $homeController = new \Karura\Controller\HomeController();
            echo $homeController->showContact();
            break;

        case ('mentions');
            // go to contact page
            $homeController = new \Karura\Controller\HomeController();
            echo $homeController->showMentions();
            break;

        default:
            // go to homepage by default
            $homeController = new \Karura\Controller\HomeController();
            echo $homeController->showHome();
    }
} else {
    // go to homepage by default
    $homeController = new \Karura\Controller\HomeController();
    echo $homeController->showHome();
}

?>