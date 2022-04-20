<?php
include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/authentification.inc.php"; // pour pouvoir utiliser isLoggedOn()

if (isset($_GET["action"])) {
    $action = $_GET["action"];
} 
else {
    $action = "defaut";
}

/*
si on se contente de , sans aucun controle OWASP LFI RFI
include "$action";
alors par exemple
http://localhost:8888/restoTP5/?action=C:\Windows\System32\drivers\etc\hosts
affiche le contenu d'un fichier systeme windows (ici texte)
*/
$fichier = controleurPrincipal($action);    
include "$racine/controleur/$fichier";      

?>
     