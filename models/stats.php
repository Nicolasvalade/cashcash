<?php 
function nbr_interventions($matricule){
include_once 'db_config.php';
  // se connecter
  $conn = getConnexion();


$sql = "SELECT technicien.matricule ,technicien.nom, technicien.prenom , count(intervention.matricule) 
            from 'technicien' left join intervention on technicien.matricule = intervention.matricule
            where technicien.matricule = ':matricule'
            and intervention.etat = 3";
$stmt = $conn ->prepare($sql);
$stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR).

$stmt->execute();
$result = $stmt->fetch();

$conn = null;
return $result;



}
function km_effectuee(){
    
        include_once 'db_config.php';
          // se connecter
          $conn = getConnexion();
        
        
        $sql = "SELECT technicien.matricule ,technicien.nom, technicien.prenom ,sum(client.distance_km)
                from technicien left join intervention on technicien.matricule = intervention.matricule
                left join client on intervention.id_client = client.id
                and intervention.etat = 3
                and intervention.date_heure between cast('2021-06-14 06:30:00' as date) and cast('2022-02-24 19:44:56' as date)
                group by technicien.matricule";
        
        $stmt = $conn ->prepare($sql);
        
        $stmt->execute();
        
        $result = $stmt->fetchAll();

}

function temps_passee(){
    
        include_once 'db_config.php';
          // se connecter
          $conn = getConnexion();
        
        
        $sql = "SELECT technicien.matricule ,technicien.nom, technicien.prenom , sum(concerner.temps_passe)
                from technicien left join intervention on technicien.matricule = intervention.matricule
                left join concerner on intervention.id = concerner.id_intervention 
                and intervention.etat = 3
                and intervention.date_heure between cast('2021-06-14 06:30:00' as date) and cast('2022-02-24 19:44:56' as date)
                group by technicien.matricule";
        
        $stmt = $conn ->prepare($sql);
        
        $stmt->execute();
        
        $result = $stmt->fetchAll();

}
?>