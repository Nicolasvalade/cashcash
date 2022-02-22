<?php
function get_all_interventions()
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT i.id, i.date_heure, e.libelle AS e_libelle, e.etat AS e_id, 
    t.nom AS t_nom, t.prenom AS t_prenom, c.raison_sociale AS client
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
  $sql = "SELECT i.id, i.date_heure, e.libelle AS etat, c.raison_sociale AS client
  FROM intervention i, client c, etat e
  WHERE i.id_client=c.id AND i.etat=e.etat AND i.etat=:id
  ORDER BY i.date_heure ASC";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id',$id_etat,PDO::PARAM_INT);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();


  // fermer la connexion
  $conn = null;
  return $result;
}

function get_interventions_a_affecter()
{
  return get_interventions_by_etat(1);
}

function get_interventions_affectees()
{
  return get_interventions_by_etat(2);
}

function get_interventions_cloturees()
{
  return get_interventions_by_etat(3);
}

function get_interventions_annulees()
{
  return get_interventions_by_etat(4);
}