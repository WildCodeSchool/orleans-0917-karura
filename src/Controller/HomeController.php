<?php

namespace Karura\Controller;

use Karura\Model\CategoryManager;
use Karura\Model\DeclinationManager;

class HomeController extends Controller
{
    /**
     * @return string
     */
    public function showHome()
    {
        // show some models in home -> using model manager
        //1* find all category
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        //2* find all declinations for each category
        $declinationManager = new DeclinationManager();
        $declinationsByCat = [];
        foreach ($categories as $category) {
            $declinationsByCat[$category->getName()] = $declinationManager->findByCategory($category);
        }

        // pour le moment affichage des modeles avec TOUTES les couleurs dispos
        // à terme on affichera uniquement une des couleur + modal
        return self::render('home.html.twig', [
            'declinationsByCat' => $declinationsByCat,
        ]);
    }


    /**
     * @return string
     */
    public function showCatalog()
    {
        // show some models in home -> using model manager
        //1* find all category
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        //2* find all declinations for each category
        $declinationManager = new DeclinationManager();
        $declinationsByCat = [];
        foreach ($categories as $category) {
            $declinationsByCat[$category->getName()] = $declinationManager->findByCategory($category);
        }

        // pour le moment affichage des modeles avec TOUTES les couleurs dispos
        // à terme on affichera uniquement une des couleur + modal
        return $this->twig->render('catalog.html.twig', [
            'declinationsByCat' => $declinationsByCat,
        ]);
    }

    /**
     * @return string
     */
    public function showContact()
    {
        // show contact page
        // make args to formate form when you came from model contact redirection
        // TODO

        $errors = [];

        if (!empty($_POST)) {

            if (empty($_POST['formLastName'])) {
                $errors['formLastName'] = "Merci de renseigner votre nom";
            }
            if (empty($_POST['formMail'])) {
                $errors['formMail'] = "Merci de renseigner votre email";
            }
            if (empty($_POST['formMessage'])) {
                $errors['formMessage'] = "Merci d'écrire un message";
            }

            if (count($errors) == 0) {

                $setTo = "loann.meignant@hotmail.fr";
                $setFrom = $_POST['formMail'];
                $gender = $_POST['gender'];
                $firstName = $_POST['formFirstName'];
                $lastName = $_POST['formLastName'];
                $phoneForm = $_POST['formTel'];
                $formMessage = $_POST['formMessage'];
                $header = "Envoi de message sur Karura.com";

                if ($phoneForm) {
                    $phone = $phoneForm;
                } else {
                    $phone = "non renseigné";
                }

                $messageSent = $gender . ' ' . $firstName . ' ' . $lastName . ' vous a envoyé un message sur Karura.com :' . "\r\n\r\n" . $formMessage . "\r\n\r\n" .
                    'E-mail : ' . $setFrom . "\r\n" . 'Téléphone : ' . $phone;

                $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                    ->setUsername('fsacado1@gmail.com')
                    ->setPassword('tarteauxpommes');

                $mailer = new \Swift_Mailer($transport);

                $message = (new \Swift_Message($header))
                    ->setFrom([$setFrom => $firstName])
                    ->setTo([$setTo => 'Loann'])
                    ->setBody($messageSent);

                if (!empty($_FILES)) {
                    if ($_FILES['formFile']['error'] !== 4) {
                        if (filesize($_FILES['formFile']['tmp_name']) > 26214400) {
                            $errors['formFile'] = "Votre fichier est trop volumineux";
                        } else {
                            $attachment = \Swift_Attachment::fromPath($_FILES['formFile']['tmp_name'])->setFilename($_FILES['formFile']['name']);
                            $message->attach($attachment);
                        }
                    }
                }

                $mailer->send($message);

                $messageAccusingReception = (new \Swift_Message($header))
                    ->setFrom([$setTo])
                    ->setTo([$setFrom => $firstName])
                    ->setBody('Nous avons bien reçu votre message, et vous répondrons dans les meilleurs délais.' . "\r\n" . 'Belle journée à vous' . "\r\n\r\n" . 'Message envoyé : ' . "\r\n" . $formMessage);

                $mailer->send($messageAccusingReception);

            }

            //INSERER LE MESSAGE "BIEN ENVOYÉ" SUR LA PAGE DE REDIRECTION
//                header('Location: index.php');
        }

        return self::render('contact.html.twig', [
            'errors' => $errors,
        ]);
    }

    /**
     * @return string
     */
    public function showMentions()
    {
        // show mentions légales
        return self::render('mentions.html.twig');
    }
}

