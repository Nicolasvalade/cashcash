<?php
function get_all_interventions()
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT i.id, i.date_heure, e.libelle AS e_libelle, e.etat AS e_id, t.matricule,
    t.nom AS t_nom, t.prenom AS t_prenom, c.raison_sociale AS client, c.code_agence
    FROM intervention i LEFT JOIN technicien t ON i.matricule=t.matricule, client c, etat e
    WHERE i.id_client=c.id AND i.etat=e.etat
    ORDER BY i.id DESC;";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();


  // fermer la connexion
  $conn = null;
  return $result;
}

function get_interventions_by_etat($id_etat)
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT i.id, i.date_heure, e.libelle AS e_libelle, e.etat AS e_id, t.matricule,
    t.nom AS t_nom, t.prenom AS t_prenom, c.raison_sociale AS client, c.code_agence
    FROM intervention i LEFT JOIN technicien t ON i.matricule=t.matricule, client c, etat e
    WHERE i.id_client=c.id AND i.etat=e.etat AND i.etat=:id
    ORDER BY i.date_heure ASC";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_etat, PDO::PARAM_INT);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();


  // fermer la connexion
  $conn = null;
  return $result;
}

function get_interventions_by_technicien_date($matricule = null, $date_debut = null, $date_fin = null, $ordered_by = 'i.id DESC')
{

  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // définir le filtre à appliquer
  $filtre = '';
  if ($matricule != null) {
    $filtre .= " AND i.matricule='$matricule'";
  }
  if ($date_debut != null && $date_fin != null) {
    $filtre .= " AND i.date_heure BETWEEN '$date_debut' AND '$date_fin'";
  }

  // préparer la requête et l'exécuter
  $sql = "SELECT i.id, i.date_heure, e.libelle AS e_libelle, e.etat AS e_id, t.matricule,
  t.nom AS t_nom, t.prenom AS t_prenom, c.raison_sociale AS client, c.code_agence
  FROM intervention i LEFT JOIN technicien t ON i.matricule=t.matricule, client c, etat e
  WHERE i.id_client=c.id AND i.etat=e.etat $filtre
  ORDER BY $ordered_by;";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();

  // fermer la connexion
  $conn = null;
  return $result;
}


function get_interventions_affectees_a($matricule = null, $etat = 2, $date_debut = null, $date_fin = null, $ordered_by = 'c.distance_km')
{

  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // définir le filtre à appliquer
  $filtre = '';
  if ($matricule != null) {
    $filtre .= " AND i.matricule='$matricule'";
  }
  if ($date_debut != null && $date_fin != null) {
    $filtre .= " AND i.date_heure BETWEEN '$date_debut' AND '$date_fin'";
  }

  // préparer la requête et l'exécuter
  $sql = "SELECT i.id, i.date_heure, c.raison_sociale AS client, c.distance_km
  FROM intervention i LEFT JOIN technicien t ON i.matricule=t.matricule, client c, etat e
  WHERE i.id_client=c.id AND i.etat=e.etat AND i.etat=$etat $filtre
  ORDER BY $ordered_by;";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();

  // fermer la connexion
  $conn = null;
  return $result;
}
