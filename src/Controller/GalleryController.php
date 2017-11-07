<?php
/**
 * Created by PhpStorm.
 * User: coralie
 * Date: 06/11/17
 * Time: 12:22
 */

namespace Karura\Controller;


use Karura\Model\Gallery;
use Karura\Model\GalleryManager;

class GalleryController extends Controller
{
    public function showGallery()
    {
        $galleryManager = new GalleryManager();
        $pictures = $galleryManager->findAll();

        return self::render('gallery.html.twig', [
            'pictures' => $pictures,
        ]);

    }

    public function showAllAdminGalleryAction()
    {
        $galleryManager = new GalleryManager();
        $pictures = $galleryManager->findAll();

        return self::render('Admin/adminGallery.html.twig', [
            'pictures' => $pictures,
        ]);

    }

    public function addPicture()
    {
        $errors = [];

        $galleryManager = new GalleryManager();

        if (!empty($_POST['adding'])) {


            $picture = new Gallery();
            $picture->setName('');

            if ($_FILES['files']['size'] > MAXSIZE) {
                $errors[] = 'L\'image est trop volumineuse';

            } elseif ($_FILES['files']['error']) {
                $errors[] = 'Vous avez rencontré une erreur lors du chargement de l\'image';
            }


            if (empty($errors)) {

                $ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
                $uniqueName = 'image' . uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['files']['tmp_name'], 'assets/images/gallery/' . $uniqueName);

                $picture->setName($uniqueName);
                $galleryManager->insert($picture);

                $this->setMessage('L\'image a bien été ajoutée', 'success');

                header('Location: admin.php?route=admingallery');
                exit;
            }
        }

        return $this->render('Admin/addGallery.html.twig', [
            'errors' => $errors,
        ]);
    }


    public function deletePicture()
    {
        if (!empty($_POST['id'])) {
            $galleryManager = new GalleryManager();
            $picture = $galleryManager->find($_POST['id']);
            if ($picture->getName() and file_exists('./assets/images/gallery/') . $picture->getName()) {
                unlink("./assets/images/gallery/" . $picture->getName());
            }

            $galleryManager->delete($picture);

            self::setMessage('L\'image a bien été supprimée de la base de données', 'success');

            header('Location: admin.php?route=admingallery');
            exit;
        }

    }

}