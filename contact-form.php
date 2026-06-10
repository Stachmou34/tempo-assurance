<?php
/*
 * tempo-assurance.com — traitement du formulaire de contact.
 * Remplace l'ancien gestionnaire WebSite X5 (imemail/imEmailForm.php).
 * Anti-spam : champ pot-de-miel + question arithmétique + contrôle de délai.
 */

$DESTINATAIRE = 'contact@mcj-courtage.com';
$PAGE_FORM    = '/contact.html';
$PAGE_OK      = '/confirmation-mail.html';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $PAGE_FORM);
    exit;
}

function champ($k) {
    return isset($_POST[$k]) ? trim((string) $_POST[$k]) : '';
}
function ligne_sure($s) {
    // neutralise toute injection d'en-têtes mail
    return str_replace(array("\r", "\n", '%0a', '%0d'), ' ', $s);
}
function retour_erreur($msg) {
    global $PAGE_FORM;
    header('Location: ' . $PAGE_FORM . '?erreur=' . urlencode($msg));
    exit;
}

/* Pot-de-miel : un robot remplit ce champ caché, pas un humain. */
if (champ('site_web') !== '') {
    header('Location: ' . $PAGE_OK); // on fait croire au robot que c'est passé
    exit;
}

/* Contrôle de délai : un envoi en moins de 3 s est un robot. */
$t = (int) champ('t');
if ($t > 0 && (time() - $t) < 3) {
    header('Location: ' . $PAGE_OK);
    exit;
}

$nom       = ligne_sure(champ('nom'));
$telephone = ligne_sure(champ('telephone'));
$email     = ligne_sure(champ('email'));
$message   = champ('message');

/* Question anti-spam (les deux opérandes voyagent avec le formulaire). */
$a = (int) champ('captcha_a');
$b = (int) champ('captcha_b');
$reponse = (int) champ('captcha');
if ($a < 1 || $b < 1 || ($a + $b) !== $reponse) {
    retour_erreur('captcha');
}

if ($nom === '' || $email === '' || $message === '') {
    retour_erreur('champs');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    retour_erreur('email');
}
if (mb_strlen($message) > 5000) {
    retour_erreur('longueur');
}

$sujet = '[tempo-assurance.com] Message de ' . $nom;
$corps = "Message recu via le formulaire de contact de tempo-assurance.com\n\n"
       . "Nom        : " . $nom . "\n"
       . "Telephone  : " . $telephone . "\n"
       . "Email      : " . $email . "\n\n"
       . "Message :\n" . $message . "\n";

$entetes = "From: formulaire@tempo-assurance.com\r\n"
         . "Reply-To: " . $email . "\r\n"
         . "Content-Type: text/plain; charset=UTF-8\r\n";

@mail($DESTINATAIRE, '=?UTF-8?B?' . base64_encode($sujet) . '?=', $corps, $entetes);

header('Location: ' . $PAGE_OK);
exit;
