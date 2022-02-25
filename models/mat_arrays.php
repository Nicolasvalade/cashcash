<?php function get_materiels_by_interv($id_intervention)
{
  include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();

  // préparer la requête et l'exécuter
  $sql = "SELECT m.n_serie, m.emplacement, t.libelle AS type, c.commentaire, c.temps_passe 
    FROM materiel m, concerner c, type t
    WHERE m.n_serie=c.n_serie AND m.reference=t.reference AND c.id_intervention=:id
    ORDER BY m.n_serie ASC;";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_intervention, PDO::PARAM_INT);
  $stmt->execute();

  // demander un retour sous forme de tableau associatif
  $result = $stmt->fetchAll();

  // fermer la connexion
  $conn = null;
  return $result;
}
