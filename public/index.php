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


switch ($route) {
    case ('home');
        $homeController = new \Karura\Controller\HomeController();
        echo $homeController->showHome();
        break;

    case ('admin');
        // admin
        $adminController = new \Karura\Controller\AdminController();
        // subpages
        if (!empty($_GET['adminRoute'])) {
            $adminController = new \Karura\Controller\AdminController();

            switch ($_GET['adminRoute']) {
                case ('color');
                    echo $adminController->showAdminColor();
                    break;

                case ('category');
                    echo $adminController->showAdminCategory();
                    break;

                default;
                    echo $adminController->showAdminMainPage();
            }

        } else {
            echo $adminController->showAdminMainPage();
        }
        break;

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
        // go to mentions page
        $homeController = new \Karura\Controller\HomeController();
        echo $homeController->showMentions();
        break;

    default;
        // go to homepage by default
        $homeController = new \Karura\Controller\HomeController();
        echo $homeController->showHome();
}

?>