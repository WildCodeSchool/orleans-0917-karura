<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 25/10/17
 * Time: 09:40
 */

namespace Karura\Controller;
use Karura\Model\Form;
use Karura\Model\FormManager;

/**
 * Class FormController
 * @package Karura\Controller
 */
class FormController extends Controller
{
    /**
     * @return string
     */
    public function showAll()
    {
        $formManager = new formManager();
        $formReceptionAddress = $formManager->findAddress();

        return self::render('Admin/adminForm.html.twig', [
            'formReceptionAddress' => $formReceptionAddress,
        ]);
    }

    /**
     * @return string
     */
    public function updateReceptionAddress()
    {
        $formManager = new FormManager();

        if (!empty($_POST['formReceptionAddress'])) {
            $form = new Form();
            $form->setReceptionAddress($_POST['formReceptionAddress']);

            $formManager->update($form);

            self::setMessage('Votre adresse email a correctement été modifiée.', 'success');

            header('Location: index.php?route=adminform');
            exit;
        }

        return self::render('Admin/updateFormReceptionAddress.html.twig', []);
    }
}
