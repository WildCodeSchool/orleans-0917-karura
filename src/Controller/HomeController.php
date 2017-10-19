

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
var_dump($declinationsByCat);

        // pour le moment affichage des modeles avec TOUTES les couleurs dispos
        // à terme on affichera uniquement une des couleur + modal
        return $this->twig->render('home.html.twig', [
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
<<<<<<< Updated upstream
        //
        return $this->twig->render('contact.html.twig');
=======
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

                $sendTo = "loann.meignant@hotmail.fr";
                $from = $_POST['formMail'];
                $gender = $_POST['gender'];
                $firstName = $_POST['formFirstName'];
                $lastName = $_POST['formLastName'];
                $message = $_POST['formMessage'];

                $subject = "Envoi de message sur Karura.com";
                $header = 'De ' . $from;

                $messageSent = $gender . ' ' . $firstName . ' ' . $lastName . " vous a envoyé un message sur Karura.com :" . "\r\n" . $message;

//                var_dump($sendTo);
//                var_dump($subject);
//                var_dump($messageSent);
//                var_dump($header);

                sendmail($sendTo, $subject, $messageSent, $header);

                var_dump(mail($sendTo, $subject, $messageSent, $header));


                //INSERER LE MESSAGE "BIEN ENVOYÉ" SUR LA PAGE DE REDIRECTION
//                header('Location: index.php');
            }

        }
        return $this->twig->render('contact.html.twig', [
            'errors' => $errors,
        ]);
>>>>>>> Stashed changes
    }

    /**
     * @return string
     */
    public function showMentions()
    {
        // show mentions légales
        return $this->twig->render('mentions.html.twig', [
            'data_id' => 'data',
        ]);
    }
}

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
var_dump($declinationsByCat);

        // pour le moment affichage des modeles avec TOUTES les couleurs dispos
        // à terme on affichera uniquement une des couleur + modal
        return $this->twig->render('home.html.twig', [
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
<<<<<<< Updated upstream
        //
        return $this->twig->render('contact.html.twig');
        return $this->twig->render('contact.html.twig');
=======
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

                $sendTo = "loann.meignant@hotmail.fr";
                $from = $_POST['formMail'];
                $gender = $_POST['gender'];
                $firstName = $_POST['formFirstName'];
                $lastName = $_POST['formLastName'];
                $message = $_POST['formMessage'];

                $subject = "Envoi de message sur Karura.com";
                $header = 'De ' . $from;

                $messageSent = $gender . ' ' . $firstName . ' ' . $lastName . " vous a envoyé un message sur Karura.com :" . "\r\n" . $message;

//                var_dump($sendTo);
//                var_dump($subject);
//                var_dump($messageSent);
//                var_dump($header);

                sendmail($sendTo, $subject, $messageSent, $header);

                var_dump(mail($sendTo, $subject, $messageSent, $header));


                //INSERER LE MESSAGE "BIEN ENVOYÉ" SUR LA PAGE DE REDIRECTION
//                header('Location: index.php');
            }

        }
        return $this->twig->render('contact.html.twig', [
            'errors' => $errors,
        ]);
>>>>>>> Stashed changes
    }

    /**
     * @return string
     */
    public function showMentions()
    {
        // show mentions légales
        return $this->twig->render('mentions.html.twig', [
            'data_id' => 'data',
        ]);
    }
}