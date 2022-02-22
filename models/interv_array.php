<?php
function get_all_interventions()
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT i.id, i.date_heure, e.libelle AS lb_etat, e.etat AS id_etat, 
    t.nom AS t_nom, t.prenom AS t_prenom, c.raison_sociale AS client
    FROM intervention i, client c, etat e, technicien t
    WHERE i.id_client=c.id AND i.etat=e.etat AND i.matricule=t.matricule
    ORDER BY id_etat";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();


  // fermer la connexion
  $conn = null;
  return $result;
}
