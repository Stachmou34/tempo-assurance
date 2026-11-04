<?php
/*
 * tempo-assurance.com — questionnaire assurance moto (assurance-moto.html).
 * Contrôle les réponses, puis envoie au gestionnaire une fiche récapitulative
 * dans l'ordre des écrans APRIL Moto, et un accusé de réception au client.
 * Rien n'est enregistré sur le serveur : la fiche part uniquement par e-mail.
 */
$DESTINATAIRE = 'contact@matemporaire.com';
$COPIE_CACHEE = 'contact@mcj-courtage.com';
$PAGE_FORM    = '/assurance-moto.html';

/* Pendant les essais : seul le propriétaire (cookie posé par moto-acces.php) peut envoyer. */
require __DIR__ . '/moto-acces.php';
if (!moto_acces_ok()) moto_introuvable();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $PAGE_FORM);
    exit;
}

function champ($k) {
    if (!isset($_POST[$k]) || is_array($_POST[$k])) return '';
    return trim(str_replace(array("\r", "\n", '%0a', '%0d'), ' ', (string) $_POST[$k]));
}
function liste($k) {
    if (!isset($_POST[$k]) || !is_array($_POST[$k])) return array();
    return array_map(function ($v) { return trim(str_replace(array("\r", "\n"), ' ', (string) $v)); }, $_POST[$k]);
}
function retour_erreur($code) {
    global $PAGE_FORM;
    header('Location: ' . $PAGE_FORM . '?erreur=' . urlencode($code));
    exit;
}
function date_ok($s) {
    if (!preg_match('#^(\d{2})/(\d{2})/(\d{4})$#', $s, $m)) return false;
    return checkdate((int) $m[2], (int) $m[1], (int) $m[3]);
}
function en_date($s) {
    preg_match('#^(\d{2})/(\d{2})/(\d{4})$#', $s, $m);
    return mktime(0, 0, 0, (int) $m[2], (int) $m[1], (int) $m[3]);
}
function un_parmi($v, $valeurs) { return in_array($v, $valeurs, true); }

/* Anti-robot : pot-de-miel et délai minimal de remplissage. */
if (champ('site_web') !== '') { header('Location: ' . $PAGE_FORM . '?envoi=ok'); exit; }
$t = (int) champ('t');
if ($t > 0 && (time() - $t) < 20) { header('Location: ' . $PAGE_FORM . '?envoi=ok'); exit; }

$statut = un_parmi(champ('statut'), array('Nouveau', 'À étudier', 'Non éligible')) ? champ('statut') : 'Nouveau';
$non_eligible = ($statut === 'Non éligible');

/* Coordonnées : toujours obligatoires (étape 6). */
$email = champ('email');
if (!un_parmi(champ('civilite'), array('Madame', 'Monsieur'))) retour_erreur('civilite');
foreach (array('nom', 'nom_naissance', 'prenom', 'pays_naissance', 'ville_naissance', 'cp', 'ville', 'adresse') as $k) {
    if (champ($k) === '' || mb_strlen(champ($k)) > 160) retour_erreur($k);
}
if (!preg_match('/^\d{5}$/', champ('cp'))) retour_erreur('cp');
if (!preg_match('/^0\d{9}$/', preg_replace('/[\s.\-]/', '', champ('telephone')))) retour_erreur('telephone');
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strtolower($email) !== strtolower(champ('email_confirmation'))) retour_erreur('email');
if (champ('consentement') !== 'Oui') retour_erreur('consentement');

/* Parcours complet : contrôles des étapes 1 à 5. Un profil « non éligible »
   peut s'arrêter à l'étape 3 et demander un rappel. */
$aujourdhui = mktime(0, 0, 0);
if (!$non_eligible) {
    if (!un_parmi(champ('type_vehicule'), array('Moto', 'Scooter', 'Cyclo 50 cm3', 'Quad', 'Moto verte'))) retour_erreur('type');
    if (champ('immat_inconnue') !== '1' && champ('immatriculation') === '') retour_erreur('immatriculation');
    if (champ('immat_inconnue') === '1' && (champ('marque') === '' || champ('cylindree') === '' || champ('modele') === '')) retour_erreur('vehicule');
    foreach (array('date_mec', 'date_acquisition', 'date_naissance', 'date_effet') as $k) {
        if (!date_ok(champ($k))) retour_erreur($k);
    }
    if (en_date(champ('date_acquisition')) < en_date(champ('date_mec'))) retour_erreur('date_acquisition');
    $effet = en_date(champ('date_effet'));
    if ($effet < $aujourdhui || $effet > $aujourdhui + 60 * 86400 + 3600) retour_erreur('date_effet');
    if (en_date(champ('date_naissance')) > strtotime('-18 years', $aujourdhui)) retour_erreur('age');
    foreach (array('assure_3_mois', 'suspension', 'annulation', 'resiliation', 'sinistres', 'assure_2roues_2ans', 'assure_auto_2ans') as $k) {
        if (!un_parmi(champ($k), array('Oui', 'Non'))) retour_erreur($k);
    }
    if (champ('usage') === '' || champ('carte_grise') === '' || champ('titulaire_cg') === '' || champ('formule') === '' || champ('fractionnement') === '') retour_erreur('choix');
    if (!preg_match('/^\d{5}$/', champ('cp_stationnement')) || champ('commune_stationnement') === '') retour_erreur('stationnement');
    if (!count(liste('permis'))) retour_erreur('permis');
    if (champ('bonus_2roues') === '' || champ('bonus_auto') === '') retour_erreur('bonus');

    /* Statut recalculé ici : on ne se fie pas au navigateur. */
    $motifs = array();
    if (champ('suspension') === 'Oui') $motifs[] = 'suspension de permis';
    if (champ('annulation') === 'Oui') $motifs[] = 'annulation de permis';
    if (champ('resiliation') === 'Oui') $motifs[] = 'résiliation assureur';
    if (champ('carte_grise') === 'Étrangère') $motifs[] = 'carte grise étrangère';
    if (champ('titulaire_cg') === 'Autre') $motifs[] = "carte grise au nom d'un tiers";
    if ($motifs) { $statut = 'À étudier'; $_POST['motif_statut'] = implode(', ', $motifs); }
}

/* ----- Fiche récapitulative, dans l'ordre des écrans APRIL Moto ----- */
$L = array();
$ligne = function ($libelle, $valeur) use (&$L) {
    if ($valeur === '' || $valeur === null) return;
    $L[] = $libelle . str_repeat(' ', max(1, 46 - mb_strlen($libelle, 'UTF-8'))) . ': ' . $valeur;
};
$L[] = 'STATUT : ' . $statut . (champ('motif_statut') !== '' ? ' (' . champ('motif_statut') . ')' : '');
$L[] = '';
$L[] = '=== VOTRE VÉHICULE ===';
$ligne('Type de 2-roues', champ('type_vehicule'));
$ligne('Immatriculation', champ('immat_inconnue') === '1' ? 'je ne la connais pas' : strtoupper(champ('immatriculation')));
$ligne('Marque', champ('marque'));
$ligne('Cylindrée (cm3)', champ('cylindree'));
$ligne('Modèle / version', champ('modele') . (champ('version_a2') === '1' ? ' (version A2 35 kW)' : ''));
$ligne('Date de 1re mise en circulation', champ('date_mec'));
$ligne("Date d'acquisition", champ('date_acquisition') . (champ('pas_encore_achete') === '1' ? ' (pas encore acheté)' : ''));
$L[] = '';
$L[] = '=== INFORMATIONS (USAGE) ===';
$ligne('Assuré au cours des 3 derniers mois', champ('assure_3_mois'));
$ligne('Usage', champ('usage'));
$ligne('Carte grise', champ('carte_grise'));
$ligne('Stationnement', trim(champ('cp_stationnement') . ' ' . champ('commune_stationnement')));
$L[] = '';
$L[] = '=== VOTRE PROFIL ===';
$ligne('Date de naissance', champ('date_naissance'));
$ligne('Carte grise au nom de', champ('titulaire_cg'));
foreach (liste('permis') as $p) {
    if (un_parmi($p, array('AM', 'A1', 'A2', 'A', 'B'))) $ligne('Permis ' . $p . ' obtenu le', champ('date_permis_' . $p));
}
$ligne('Bonus-malus 2-roues', champ('bonus_2roues') . (champ('bonus_2roues_3ans') !== '' ? ' (depuis + de 3 ans : ' . champ('bonus_2roues_3ans') . ')' : ''));
$ligne('Bonus-malus auto', champ('bonus_auto') . (champ('bonus_auto_3ans') !== '' ? ' (depuis + de 3 ans : ' . champ('bonus_auto_3ans') . ')' : ''));
$L[] = '';
$L[] = '=== VOS ANTÉCÉDENTS ===';
$ligne('Suspension de permis (3 ans)', champ('suspension'));
$ligne('Annulation de permis (3 ans)', champ('annulation'));
$ligne('Résiliation précédent assureur (3 ans)', champ('resiliation'));
$ligne('Sinistres auto et/ou moto (2 ans)', champ('sinistres'));
$types = liste('sinistre_type'); $dates = liste('sinistre_date'); $vehs = liste('sinistre_vehicule');
$resps = liste('sinistre_responsabilite'); $corps = liste('sinistre_corporel');
foreach ($types as $i => $type) {
    if ($type === '') continue;
    $detail = $type . ', le ' . (isset($dates[$i]) ? $dates[$i] : '?') . ', ' . (isset($vehs[$i]) ? $vehs[$i] : '?');
    if ($type === 'Circulation') {
        $detail .= ', responsabilité ' . (isset($resps[$i]) ? $resps[$i] : '?') . ', corporel : ' . (isset($corps[$i]) ? $corps[$i] : '?');
    }
    $ligne('  Sinistre ' . ($i + 1), $detail);
}
$ligne('Assuré en 2-roues (2 ans)', champ('assure_2roues_2ans'));
$ligne('  Nombre de mois assuré en 2-roues', champ('mois_assure_2roues'));
$ligne('  Ancienneté du contrat actuel', champ('anciennete_contrat'));
$ligne('  Assureur actuel (loi Hamon)', champ('assureur_actuel'));
$ligne('  N° de contrat (loi Hamon)', champ('numero_contrat'));
$ligne('Assuré en auto (2 ans)', champ('assure_auto_2ans'));
if (champ('bonus_2roues') === '0,50' && champ('assure_2roues_2ans') === 'Non') {
    $L[] = '  ! Bonus 2-roues 0,50 sans assurance moto sur la période : ramené à 1,00 par APRIL.';
}
$L[] = '';
$L[] = '=== BESOIN ===';
$ligne('Formule', champ('formule'));
$ligne('Rachat de franchise', champ('rachat_franchise'));
$ligne('Assistance complémentaire', champ('assistance'));
$ligne('Protection corporelle du conducteur', champ('protection_corporelle') . (champ('gilet_airbag') === 'Oui' ? ' (gilet airbag : oui)' : ''));
$ligne('Accessoires et équipements', champ('accessoires'));
$ligne('Panne mécanique', champ('panne_mecanique'));
$ligne('Valeur majorée', champ('valeur_majoree'));
$ligne('Fractionnement', champ('fractionnement'));
$ligne('Code promotionnel', champ('code_promo'));
$ligne("Date d'effet souhaitée", champ('date_effet'));
$L[] = '';
$L[] = '=== VOS INFOS ===';
$ligne('Civilité', champ('civilite'));
$ligne("Nom d'usage", champ('nom'));
$ligne('Nom de naissance', champ('nom_naissance'));
$ligne('Prénom', champ('prenom'));
$ligne('Pays de naissance', champ('pays_naissance'));
$ligne('Ville de naissance', champ('ville_naissance'));
$ligne('Adresse', champ('adresse'));
$ligne('Code postal + ville', champ('cp') . ' ' . champ('ville'));
$ligne('Téléphone', preg_replace('/[\s.\-]/', '', champ('telephone')));
$ligne('E-mail', $email);
$ligne('N° de permis', champ('numero_permis'));
$ligne("N° d'immatriculation", strtoupper(champ('immatriculation_confirmee')));
$ligne('Créneau de rappel', champ('creneau_rappel') !== '' ? champ('creneau_rappel') : 'indifférent');
$L[] = '';
$ligne('Consentement devis et rappel', champ('consentement') . ' (' . date('d/m/Y H:i') . ')');
$ligne('Accord prospection', champ('prospection') !== '' ? 'Oui' : 'Non');

$sujet = '[Moto] ' . $statut . ' : ' . champ('prenom') . ' ' . champ('nom') . ' (' . (champ('type_vehicule') !== '' ? champ('type_vehicule') : 'rappel') . ')';
$corps = "Demande de devis moto reçue sur tempo-assurance.com\n\n" . implode("\n", $L) . "\n";
$entetes = "From: formulaire@tempo-assurance.com\r\n"
         . "Reply-To: " . $email . "\r\n"
         . "Bcc: " . $COPIE_CACHEE . "\r\n"
         . "Content-Type: text/plain; charset=UTF-8\r\n";
$envoye = @mail($DESTINATAIRE, '=?UTF-8?B?' . base64_encode($sujet) . '?=', $corps, $entetes);
if (!$envoye) retour_erreur('envoi');

/* Accusé de réception : texte fixe, sans reprendre les réponses du formulaire. */
$accuse = "Bonjour,\n\n"
        . "Nous avons bien reçu votre demande de devis d'assurance moto.\n"
        . "Un courtier MCJ Courtage la reprend et vous rappelle avec votre devis.\n\n"
        . "Une question d'ici là : 09 78 31 02 93.\n\n"
        . "L'équipe Tempo-Assurance\n"
        . "MCJ Courtage, courtier en assurance, ORIAS n° 26008651\n";
@mail($email, '=?UTF-8?B?' . base64_encode('Votre demande de devis moto') . '?=', $accuse,
      "From: contact@matemporaire.com\r\nContent-Type: text/plain; charset=UTF-8\r\n");

header('Location: ' . $PAGE_FORM . '?envoi=ok');
exit;
