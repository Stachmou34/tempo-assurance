<?php
/*
 * Accès réservé à la page moto pendant les essais.
 *
 * La clé n'est PAS dans ce dépôt (il est public) : elle est lue dans le fichier
 * « .moto-test », placé par le propriétaire un niveau AU-DESSUS du dossier du site,
 * donc hors de portée du web. Sans ce fichier, personne n'entre.
 *
 * - /assurance-moto.html?cle=LA-CLE : pose un cookie de 90 jours, puis affiche la page.
 * - /assurance-moto.html avec le cookie : affiche la page.
 * - Sinon : « page introuvable » (404), comme si la page n'existait pas.
 *
 * Le .htaccess fait passer /assurance-moto.html par ce fichier ; moto-form.php
 * appelle moto_acces_ok() avant tout traitement.
 */

function moto_cle() {
    $fichier = dirname(rtrim($_SERVER['DOCUMENT_ROOT'], '/')) . '/.moto-test';
    if (!is_readable($fichier)) return '';
    $cle = trim((string) file_get_contents($fichier));
    return strlen($cle) >= 16 ? $cle : '';   // clé trop courte = refusée
}

function moto_acces_ok() {
    $cle = moto_cle();
    if ($cle === '') return false;
    $jeton = hash('sha256', 'tempo-moto|' . $cle);
    return isset($_COOKIE['moto_test']) && hash_equals($jeton, (string) $_COOKIE['moto_test']);
}

function moto_introuvable() {
    http_response_code(404);
    header('X-Robots-Tag: noindex');
    $page = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/404.html';
    if (is_readable($page)) readfile($page);
    exit;
}

if (basename($_SERVER['SCRIPT_FILENAME']) === 'moto-acces.php') {
    $cle = moto_cle();
    if ($cle !== '' && isset($_GET['cle']) && hash_equals($cle, (string) $_GET['cle'])) {
        $jeton = hash('sha256', 'tempo-moto|' . $cle);
        header('Set-Cookie: moto_test=' . $jeton . '; Max-Age=7776000; Path=/; Secure; HttpOnly; SameSite=Lax');
        header('Location: /assurance-moto.html', true, 303);   // retire la clé de l'adresse
        exit;
    }
    if (!moto_acces_ok()) moto_introuvable();
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: private, no-store');
    header('X-Robots-Tag: noindex');
    readfile(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/assurance-moto.html');
    exit;
}
