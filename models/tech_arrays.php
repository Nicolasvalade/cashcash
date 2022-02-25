<?php

function get_all_techniciens($ordered_by = 'matricule')
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT *
    FROM technicien
    ORDER BY $ordered_by";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();


  // fermer la connexion
  $conn = null;
  return $result;
}

function get_techniciens_agence($code_agence, $ordered_by = 'matricule')
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT *
    FROM technicien
    WHERE code_agence=:code
    ORDER BY $ordered_by;";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':code', $code_agence, PDO::PARAM_STR);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();


  // fermer la connexion
  $conn = null;
  return $result;
}

