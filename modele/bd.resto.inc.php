<?php

include_once "bd.inc.php";

class Resto //c'est une classe "Métier", de votre MCD, à l'image de la table Resto de MySQL
{
    private $idR,$nomR,$numAdrR,$voieAdrR,$cpR,$villeR,$latitudeDegR,$longitudeDegR,$descR,$horairesR;

    function __construct($idR, $nomR, $numAdrR, $voieAdrR, $cpR, $villeR, $latitudeDegR, $longitudeDegR, $descR, $horairesR)
    {
        $this->idR = $idR;
        $this->nomR = $nomR;
        $this->numAdrR = $numAdrR;
        $this->voieAdrR = $voieAdrR;
        $this->cpR = $cpR;
        $this->villeR = $villeR;
        $this->latitudeDegR = $latitudeDegR;
        $this->longitudeDegR = $longitudeDegR;
        $this->descR = $descR;
        $this->horairesR = $horairesR;
    }
    function getIdR(){
        return $this->idR;
    }
    function getNomR(){
        return $this->nomR;
    }
    function getNumAdrR(){
        return $this->numAdrR;
    }
    function getVoieAdrR(){
        return $this->voieAdrR;
    }
    function getCpR(){
        return $this->cpR;
    }
    function getVilleR(){
        return $this->villeR;
    }
}

function getRestos()
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = new Resto(
                $ligne['idR'],$ligne['nomR'],$ligne['numAdrR'],$ligne['voieAdrR'],
                $ligne['cpR'],$ligne['villeR'],$ligne['latitudeDegR'],$ligne['longitudeDegR'],
                $ligne['descR'],$ligne['horairesR']);
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat; //tableau d'objets Resto
}

function getRestoByIdR($idR)
{

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosByNomR($nomR)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where nomR like :nomR");
        $req->bindValue(':nomR', "%" . $nomR . "%", PDO::PARAM_STR);

        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosByAdresse($voieAdrR, $cpR, $villeR)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where voieAdrR like :voieAdrR and cpR like :cpR and villeR like :villeR");
        $req->bindValue(':voieAdrR', "%" . $voieAdrR . "%", PDO::PARAM_STR);
        $req->bindValue(':cpR', $cpR . "%", PDO::PARAM_STR);
        $req->bindValue(':villeR', "%" . $villeR . "%", PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosAimesByMailU($mailU)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.* from resto,aimer where resto.idR = aimer.idR and mailU = :mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

