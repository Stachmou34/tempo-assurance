<?php
/* Test minimal : si cette adresse répond 500, PHP ne s'exécute pas sur le serveur
   (problème d'hébergement, pas de code). Elle doit afficher « php ok ».
   À supprimer une fois le PHP réparé. */
header('Content-Type: text/plain; charset=utf-8');
header('X-Robots-Tag: noindex');
echo "php ok\n";
