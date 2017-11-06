<?php
// loading autoload and connect to db
require "../vendor/autoload.php";
require '../connect.php';
require '../config.php';

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

} elseif ($route == 'search') {
    // simple search in name of models
    $modelController = new \Karura\Controller\ModelController();
    echo $modelController->showSearchAction($_GET['search']);

} elseif ($route == 'category') {
    // models of one category
    $modelController = new \Karura\Controller\ModelController();
    echo $modelController->showByCategoryAction($_GET['category']);

} elseif ($route == 'contact') {
    // go to contact page
    $homeController = new \Karura\Controller\HomeController();
    echo $homeController->showContact();

} elseif ($route == 'mentions') {
    // go to mentions page
    $homeController = new \Karura\Controller\HomeController();
    echo $homeController->showMentions();

} elseif ($route == 'product') {
    $modelController = new \Karura\Controller\ModelController();
    echo $modelController->showProduct();

} elseif ($route == 'catalog') {
    $modelController = new \Karura\Controller\HomeController();
    echo $modelController->showCatalog();

} else {
    // go to homepage by default
    $homeController = new \Karura\Controller\HomeController();
    echo $homeController->showHome();
}

?>

