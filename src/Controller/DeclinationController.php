<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:39
 */

namespace Karura\Controller;


use Karura\Model\ColorManager;
use Karura\Model\Declination;
use Karura\Model\DeclinationManager;
use Karura\Model\ModelManager;

class DeclinationController extends Controller
{
    public function showAllAction()
    {
        $declinationManager = new DeclinationManager();
        $declinations = $declinationManager->findAll();

        return self::render('Declination/showAll.html.twig', [
                'declinations' => $declinations,
            ]);
    }

    public function showOneAction($id)
    {
        $declinationManager = new DeclinationManager();
        $declination = $declinationManager->find($id);

        return self::render('Declination/showOne.html.twig', [
                'declination' => $declination,
            ]);
    }

    public function showAllByModel()
    {
        $modelManager = new ModelManager();
        $model = $modelManager->find((int)$_GET["modelId"]);

        $declinationManager = new DeclinationManager();
        $declinationsByModel = $declinationManager->findByModel($model);

        $colorManager = new ColorManager();
        $colors = $colorManager->findAll();

        $resColor = [];

        foreach($colors as $color)
        {
          $resColor[$color->getId()] = $color;
        }

        return self::render('Admin/adminDeclination.html.twig', [
            'declinations' => $declinationsByModel,
            'model' => $model,
            'colors' =>$resColor,
        ]);
    }

    public function deleteDeclination()
    {
        if (!empty($_POST['id'])) {
            $declinationManager = new DeclinationManager();
            $declination = $declinationManager->find($_POST['id']);
            if(file_exists('./assets/images/') . $declination->getSecondaryImage()) {
                unlink('./assets/images/' . $declination->getSecondaryImage());
            }
            if(file_exists('./assets/images/') . $declination->getMainImage()) {
                unlink('./assets/images/' . $declination->getMainImage());
            }
            $declinationManager->delete($declination);

            self::setMessage('La déclinaison a bien été supprimée de la base de données', 'success');

            header('Location: admin.php?route=admindeclination&modelId=' . $declination->getModelId());
            exit;
        }
    }

    public function updateDeclination()
    {
        $declinationManager = new DeclinationManager();
        $declination = $declinationManager->find($_POST['id']);
        $errors=[];

        if (!empty($_POST['updating'])) {

            for($i=0; $i<=1;$i++) {
                if($_FILES['files']['error'][$i]==0){
                    if($_FILES['files']['size'][$i]>MAXSIZE){
                        $message[]='L\'image est trop volumineuse';
                    }elseif ($_FILES['files']['error'][$i]) {
                        $message[] = 'Vous avez une erreur';
                    } else {
                        $ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
                        $uniqueName = 'image' . uniqid() . '.' . $ext;
                        move_uploaded_file($_FILES['files']['tmp_name'][$i], 'assets/images/' . $uniqueName);

                        if($i==0) {
                            if(file_exists('./assets/images/') . $declination->getSecondaryImage()) {
                                unlink('./assets/images/' . $declination->getSecondaryImage());
                                $declination->setSecondaryImage($uniqueName);
                            }
                        } else {
                            if(file_exists('./assets/images/') . $declination->getMainImage()) {
                                unlink('./assets/images/' . $declination->getMainImage());
                                $declination->setMainImage($uniqueName);
                            }
                        }
                    }
                }

            }

            $declination->setColorId($_POST['color_id']);

            $declinationManager->update($declination);

            $this->setMessage('La déclinaison a bien été modifié','success');
        }

        $colorManager = new ColorManager();
        $colors = $colorManager->findAll();

        $resColor = [];

        foreach($colors as $color)
        {
            $resColor[$color->getId()] = $color;
        }

        return $this->render('Admin/updateDeclination.html.twig', [
            'declination' => $declination,
            'colors' => $resColor,
        ]);
    }

    public function addDeclination()
    {
        $errors=[];

        $modelManager = new ModelManager();
        $model = $modelManager->find($_POST['model_id']);

        if (!empty($_POST['adding'])) {

            $declinationManager = new DeclinationManager();
            $declination = new Declination();
            $declination->setSecondaryImage('');
            $declination->setMainImage('');

            for ($i = 0; $i <= 1; $i++) {
                if($_FILES['files']['error'][$i]==0) {
                    if ($_FILES['files']['size'][$i] > MAXSIZE) {
                        $message[] = 'L\'image est trop volumineuse';
                    } else {
                        $ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
                        $uniqueName = 'image' . uniqid() . '.' . $ext;
                        move_uploaded_file($_FILES['files']['tmp_name'][$i], 'assets/images/' . $uniqueName);

                        if ($i == 0) {
                            $declination->setSecondaryImage($uniqueName);
                        } else {
                            $declination->setMainImage($uniqueName);
                        }
                    }
                }
            }

            $declination->setColorId($_POST['color_id']);
            $declination->setModelId($_POST['model_id']);
            // if the decl is alone, it's the main_color
            $main_color = count($declinationManager->findByModel($model)) ? 0 : 1;
            $declination->setMainColor($main_color);

            if ($declinationManager->findByColorAndModel($_POST['color_id'], $_POST['model_id'])) {
                $errors['twice'] = 'Cette déclinaison existe déjà';
            }

            if (empty($errors)) {
                $declinationManager->insert($declination);

                $this->setMessage('La déclinaison a bien été ajoutée', 'success');

                header('Location: admin.php?route=admindeclination&modelId=' . $declination->getModelId());
                exit;
            }
        }

        $colorManager = new ColorManager();
        $colors = $colorManager->findAll();

        $resColor = [];

        foreach($colors as $color)
        {
            $resColor[$color->getId()] = $color;
        }

        return $this->render('Admin/addDeclination.html.twig', [
            'errors'=>$errors,
            'colors' => $resColor,
            'model'=>$model,
            'post'=>$_POST,
        ]);
    }

    public function changeMainColor($declination_id)
    {
        $declinationManager = new DeclinationManager();
        $declination = $declinationManager->find($declination_id);

        $modelManager = new ModelManager();
        $model = $modelManager->find($declination->getModelId());

        $declinations = $declinationManager->findByModel($model);

        foreach ($declinations as $declination) {
            if ($declination->getId() != $declination_id) {
                $declination->setMainColor(0);
            } else {
                $declination->setMainColor(1);
            }
            $declinationManager->update($declination);
        }

        header('Location: admin.php?route=admindeclination&modelId=' . $declination->getModelId());
        exit();
    }


}
