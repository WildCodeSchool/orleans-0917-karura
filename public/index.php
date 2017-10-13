<?php
// loading autoload and connect to db
require "../vendor/autoload.php";
require '../connect.php';


if (!empty($_GET['route'])) {
    switch ($_GET['route']) {
        case ('home');
            $homeController = new \Karura\Controller\HomeController();
            echo $homeController->showHome();
            break;

        case ('search');
            $modelController = new \Karura\Controller\ModelController();
            echo $modelController->showSearchAction('5');
            break;
    }
}

?>