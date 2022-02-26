<?php
function get_intervention_by_id($id_intervention)
{
  include_once 'models/db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT i.id, i.date_heure, e.libelle AS e_libelle, e.etat AS e_id, t.matricule,
    t.nom AS t_nom, t.prenom AS t_prenom, c.raison_sociale AS client, c.code_agence, i.id_client
    FROM intervention i LEFT JOIN technicien t ON i.matricule=t.matricule, client c, etat e
    WHERE i.id_client=c.id AND i.etat=e.etat
    AND i.id=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_intervention, PDO::PARAM_INT);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetch();

  // fermer la connexion
  $conn = null;
  return $result;
}

function affecter_interv_a($id_intervention, $matricule)
{
  if ($matricule == null) return false;

  include_once 'models/db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "UPDATE intervention
    SET matricule=:matricule, etat=2, date_heure=date_heure
    WHERE id=:id AND etat=1";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_intervention, PDO::PARAM_INT);
  $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
  $success = $stmt->execute();
  if (!$success) {
    return false;
  }


  // fermer la connexion
  $conn = null;
  return true;
}

function insert_intervention($date_heure, $id_client, $materiels)
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // début de la transaction
  $conn->beginTransaction();

  // préparer la requête et l'exécuter
  $sql = "INSERT INTO intervention (date_heure, id_client, etat)
    VALUES (:date_heure, :id_client, 1)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':date_heure', $date_heure, PDO::PARAM_STR);
  $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);

  // si erreur lors de l'exécution, annuler toutes les modifications effectuées
  $success = $stmt->execute();
  if (!$success) {
    $conn->rollBack();
    return false;
  }

  $id_intervention = $conn->lastInsertId();

  foreach ($materiels as $n_serie) {
    $sql = "INSERT INTO concerner (n_serie, id_intervention)
      VALUES (:n_serie, :id_intervention);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':n_serie', $n_serie, PDO::PARAM_STR);
    $stmt->bindParam(':id_intervention', $id_intervention, PDO::PARAM_INT);

    // en cas d'erreur lors de l'exécution, on annule toutes les modifications effectuées
    $success = $stmt->execute();
    if (!$success) {
      $conn->rollBack();
      return false;
    }
  }

  // valider la transaction
  $conn->commit();

  // fermer la connexion
  $conn = null;
  return true;
}

function update_intervention($id_intervention, $date_heure, $matricule, $materiels)
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // début de la transaction
  $conn->beginTransaction();

  // modifier date, heure, matricule
  $sql = "UPDATE intervention
    SET date_heure=:date_heure, matricule=:matricule
    WHERE id=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_intervention, PDO::PARAM_INT);
  $stmt->bindParam(':date_heure', $date_heure, PDO::PARAM_STR);
  $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
  $success = $stmt->execute();
  if (!$success) {
    $conn->rollBack();
    return false;
  }

  // supprimer tous les matériels
  $sql = "DELETE FROM concerner WHERE id_intervention=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_intervention, PDO::PARAM_INT);
  $success = $stmt->execute();
  if (!$success) {
    $conn->rollBack();
    return false;
  }

  // ajouter les matériels sélectionner
  foreach ($materiels as $n_serie) {
    $sql = "INSERT INTO concerner (n_serie, id_intervention)
      VALUES (:n_serie, :id_intervention);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':n_serie', $n_serie, PDO::PARAM_STR);
    $stmt->bindParam(':id_intervention', $id_intervention, PDO::PARAM_INT);

    // en cas d'erreur lors de l'exécution, on annule toutes les modifications effectuées
    $success = $stmt->execute();
    if (!$success) {
      $conn->rollBack();
      return false;
    }
  }

  // valider la transaction
  $conn->commit();

  // fermer la connexion
  $conn = null;
  return true;
}

function annuler_interv($id_intervention)
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "UPDATE intervention
      SET date_heure=date_heure, etat=4
      WHERE id=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_intervention, PDO::PARAM_INT);
  $success = $stmt->execute();

  return $success;
}

function valider_interv($id_intervention, $materiels)
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // début de la transaction
  $conn->beginTransaction();

  // préparer la requête et l'exécuter
  $sql = "UPDATE intervention
    SET date_heure=date_heure, etat=3
    WHERE id=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_intervention, PDO::PARAM_INT);

  // si erreur lors de l'exécution, annuler toutes les modifications effectuées
  $success = $stmt->execute();
  if (!$success) {
    $conn->rollBack();
    return false;
  }

  foreach ($materiels as $n_serie => $materiel) {
    $sql = "UPDATE concerner
      SET commentaire=:commentaire, temps_passe=:temps_passe
      WHERE n_serie=:n_serie AND id_intervention=:id_intervention;";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':n_serie', $n_serie, PDO::PARAM_STR);
    $stmt->bindParam(':id_intervention', $id_intervention, PDO::PARAM_INT);
    $stmt->bindParam(':commentaire', $materiel['commentaire'], PDO::PARAM_STR);
    $stmt->bindParam(':temps_passe', $materiel['temps_passe'], PDO::PARAM_INT);

    // en cas d'erreur lors de l'exécution, on annule toutes les modifications effectuées
    $success = $stmt->execute();
    if (!$success) {
      $conn->rollBack();
      return false;
    }
  }

  // valider la transaction
  $conn->commit();

  // fermer la connexion
  $conn = null;
  return true;
}
