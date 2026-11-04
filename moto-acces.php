<?php
/*
 * Accès réservé à la page moto pendant les essais : la page demande un mot de passe.
 *
 * Le mot de passe n'est pas dans ce dépôt (il est public) : seules ses empreintes y sont.
 * - MOTO_MDP_HASH : empreinte bcrypt du mot de passe, vérifiée avec password_verify().
 * - MOTO_COOKIE_CHECK : sha256 du cookie posé après un bon mot de passe. Le cookie vaut
 *   hash_hmac('sha256', 'tempo-moto-cookie', mot de passe) : impossible à fabriquer
 *   sans connaître le mot de passe.
 * Pour changer de mot de passe : recalculer les deux empreintes (voir le playbook).
 *
 * Le .htaccess fait passer /assurance-moto.html par ce fichier ; moto-form.php
 * appelle moto_acces_ok() avant tout traitement.
 */
define('MOTO_MDP_HASH', '$2y$11$kz.ffdMWfUcpponJhrmFTes6woJNLSvTfoSPnFLa1xxNzl7k/E.H2');
define('MOTO_COOKIE_CHECK', '296cc4fe3b1dc88601db1d7d8a7f16635d7d62a133bcde206cd64bea6789eea8');

function moto_acces_ok() {
    return isset($_COOKIE['moto_test'])
        && hash_equals(MOTO_COOKIE_CHECK, hash('sha256', (string) $_COOKIE['moto_test']));
}

function moto_introuvable() {
    http_response_code(404);
    header('X-Robots-Tag: noindex');
    $page = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/404.html';
    if (is_readable($page)) readfile($page);
    exit;
}

function moto_demande_mdp($erreur) {
    http_response_code($erreur ? 403 : 401);
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: private, no-store');
    header('X-Robots-Tag: noindex');
    echo '<!DOCTYPE html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">'
       . '<meta name="robots" content="noindex"><title>Page en test - Tempo-assurance</title>'
       . '<style>body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;background:#F8FAFC;'
       . 'font-family:system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;color:#1F2937;padding:20px;box-sizing:border-box}'
       . 'form{background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:28px 24px;width:100%;max-width:360px;box-shadow:0 8px 28px rgba(15,23,42,.14)}'
       . 'h1{font-size:1.25rem;color:#0F172A;margin:0 0 6px}p{margin:0 0 16px;color:#64748B;font-size:.95rem}'
       . 'label{display:block;font-weight:600;color:#0F172A;margin-bottom:6px}'
       . 'input{width:100%;box-sizing:border-box;font-size:1rem;padding:12px 13px;border:1px solid #E2E8F0;border-radius:9px}'
       . 'button{margin-top:14px;width:100%;background:#0F172A;color:#fff;border:none;border-radius:10px;padding:14px;font-size:1rem;font-weight:600;cursor:pointer}'
       . '.err{color:#B91C1C;font-weight:600}</style></head><body>'
       . '<form method="post" action="/assurance-moto.html"><h1>Page en test</h1>'
       . '<p>Cette page est réservée. Saisissez le mot de passe.</p>'
       . ($erreur ? '<p class="err" role="alert">Mot de passe incorrect.</p>' : '')
       . '<label for="mdp">Mot de passe</label><input type="password" id="mdp" name="mot_de_passe" autocomplete="current-password" required autofocus>'
       . '<button type="submit">Entrer</button></form></body></html>';
    exit;
}

if (basename($_SERVER['SCRIPT_FILENAME']) === 'moto-acces.php') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mot_de_passe'])) {
        $mdp = trim((string) $_POST['mot_de_passe']);
        if (password_verify($mdp, MOTO_MDP_HASH)) {
            $cookie = hash_hmac('sha256', 'tempo-moto-cookie', $mdp);
            header('Set-Cookie: moto_test=' . $cookie . '; Max-Age=7776000; Path=/; Secure; HttpOnly; SameSite=Lax');
            header('Location: /assurance-moto.html', true, 303);
            exit;
        }
        sleep(2);   // freine les essais en série
        moto_demande_mdp(true);
    }
    if (!moto_acces_ok()) moto_demande_mdp(false);
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: private, no-store');
    header('X-Robots-Tag: noindex');
    readfile(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/assurance-moto.html');
    exit;
}
