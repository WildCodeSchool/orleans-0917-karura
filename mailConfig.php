<?php

//MAX FILESIZE
$fileSize = 3145728; // 3Mo

//GET EMAIL ADDRESS FROM DATABASE
$formManager = new \Karura\Model\FormManager();
$findAddress = $formManager->findAddress();
$setTo = $findAddress->getReceptionAddress();

//CONFIGURE THE EMAIL SENDING
$transport = (new \Swift_SmtpTransport(HOST, PORT, SECURITY))
    ->setUsername(USERNAME)
    ->setPassword(PASSWORD);

$mailer = new \Swift_Mailer($transport);

$message = (new \Swift_Message($header))
    ->setFrom([$setFrom => $firstName])
    ->setTo($setTo)
    ->setBody($messageSent);

if (!empty($_FILES)) {
    if (!$_FILES['formFile']['error']) {
        if (filesize($_FILES['formFile']['tmp_name']) > $fileSize) {
            $errors['formFile'] = "Votre fichier est trop volumineux";
        } else {
            $attachment = \Swift_Attachment::fromPath($_FILES['formFile']['tmp_name'])->setFilename($_FILES['formFile']['name']);
            $message->attach($attachment);
        }
    } else {
        $errors['formFile'] = "Erreur dans l'envoi du mail. Votre fichier en pièce jointe est trop volumineux";
    }
}

if (empty($errors)) {

    $mailer->send($message);

    $messageAccusingReception = (new \Swift_Message($header))
        ->setFrom($setTo)
        ->setTo([$setFrom => $firstName])
        ->setBody('Nous avons bien reçu votre message, et vous répondrons dans les meilleurs délais.' . "\r\n" . 'Merci de ne pas répondre à ce message, l\'adresse email utilisée n\'est pas exploitée.' . "\r\n" . 'Belle journée à vous.' . "\r\n\r\n" . 'L\'équipe Karura' . "\r\n\r\n" . 'Message envoyé : ' . "\r\n" . $formMessage);

    $mailer->send($messageAccusingReception);
}
