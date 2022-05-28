<?php

function get_client_by_id($id)
{
    include_once 'models/db_config.php';
    // se connecter
    $conn = getConnexion();

    // préparer la requête et l'exécuter
    $sql = "SELECT * FROM client WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // demander un retour sous forme de tableau associatif
    $result = $stmt->fetch();

    // fermer la connexion
    $conn = null;
    return $result;
}


function get_agence_by_id($code_agence)
{
    include_once 'models/db_config.php';
    // se connecter
    $conn = getConnexion();

    // préparer la requête et l'exécuter
    $sql = "SELECT * FROM agence WHERE code=:code_agence";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':code_agence', $code_agence, PDO::PARAM_STR);
    $stmt->execute();

    // demander un retour sous forme de tableau associatif
    $result = $stmt->fetch();

    // fermer la connexion
    $conn = null;
    return $result;
}



function get_contrats_avec_materiels($id_client)
{
    include_once 'models/db_config.php';
    // se connecter
    $conn = getConnexion();

    // préparer la requête et l'exécuter
    $sql = "SELECT materiel.n_serie, materiel.emplacement, materiel.id_contrat, type.libelle as type, contrat.date_renouvellement
    FROM materiel, contrat, type
    WHERE materiel.reference = type.reference
    AND materiel.id_contrat = contrat.id
    AND materiel.id_client = :id_client";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
    $stmt->execute();

    // demander un retour sous forme de tableau associatif
    $result = $stmt->fetchAll();

    // fermer la connexion
    $conn = null;
    return $result;
}

function get_gestionnaire_agence($code_agence){
    include_once 'models/db_config.php';
    // se connecter
    $conn = getConnexion();

    // préparer la requête et l'exécuter
    $sql = "SELECT * FROM gerant WHERE code_agence=:code_agence";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':code_agence', $code_agence, PDO::PARAM_STR);
    $stmt->execute();

    // demander un retour sous forme de tableau associatif
    $result = $stmt->fetch();

    // fermer la connexion
    $conn = null;
    return $result;
}