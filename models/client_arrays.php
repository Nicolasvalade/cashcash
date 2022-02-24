<?php
function get_all_clients()
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT *  FROM client";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();


  // fermer la connexion
  $conn = null;
  return $result;
}