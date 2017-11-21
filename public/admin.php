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
    $route = 'admin'; // go to home by default
}

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

} elseif (substr($route, 0, 10) == 'adminmodel') {
    $modelController = new \Karura\Controller\ModelController();
    if ($route == 'adminmodeladd') {
        echo $modelController->addModel();
    } elseif ($route == 'adminmodeldelete') {
        echo $modelController->deleteModel();
    } elseif ($route == 'adminmodelupdate') {
        echo $modelController->updateModel();
    } else {
        echo $modelController->showAllAdminAction();
    }

} elseif (substr($route, 0, strlen('admingallery')) == 'admingallery') {
    $galleryController = new \Karura\Controller\GalleryController();
    if ($route == 'admingalleryadd') {
        echo $galleryController->addPicture();
    } elseif ($route == 'admingallerydelete') {
        echo $galleryController->deletePicture();
    } else {
        echo $galleryController->showAllAdminGalleryAction();
    }

} elseif (substr($route, 0, strlen('admindeclination')) == 'admindeclination') {
    $declinationController = new \Karura\Controller\DeclinationController();
    if ($route == 'admindeclinationadd') {
        echo $declinationController->addDeclination();
    } elseif ($route == 'admindeclinationdelete') {
        echo $declinationController->deleteDeclination();
    } elseif ($route == 'admindeclinationupdate') {
        echo $declinationController->updateDeclination();
    } elseif ($route == 'admindeclination-change-maincolor') {
        echo $declinationController->changeMainColor($_POST['id']);
    } else {
        echo $declinationController->showAllByModel();
    }

} elseif ($route == 'admincategory') {
    $adminController = new \Karura\Controller\AdminController();
    echo $adminController->showAdminCategory();

} elseif (substr($route, 0, 9) == 'adminform') {
    $formController = new \Karura\Controller\FormController();
    if ($route == 'adminform-reception-address-update') {
        echo $formController->updateReceptionAddress();
    } else {
        echo $formController->showAll();
    }

} elseif (substr($route, 0, 9) == 'adminhome'){
    $homeController = new \Karura\Controller\HomeController();
    if ($route == 'adminhomeupdate') {
        echo $homeController->showAdminUpdate();
    } else {
        echo $homeController->showAdminHome();
    }

} else {
    $adminController = new \Karura\Controller\AdminController();
    echo $adminController->showMainPage();
}

?>

