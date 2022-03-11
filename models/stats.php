<?php
function nbr_interventions($matricule,$date_debut,$date_fin)
{
        include_once 'db_config.php';
        // se connecter
        $conn = getConnexion();

        $filtre = '';
        if ($date_debut != null && $date_fin != null) {
                $filtre .= " AND intervention.date_heure BETWEEN '$date_debut' AND '$date_fin'";
              }

        $sql = "SELECT count(intervention.matricule) 
                from technicien left join intervention on technicien.matricule = intervention.matricule
                and intervention.etat = 3
                and technicien.matricule = :matricule 
                $filtre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":matricule", $matricule, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch();
        $conn = null;
        return $result;
}
function km_effectues($matricule,$date_debut,$date_fin)
{
        include_once 'db_config.php';
        // se connecter
        $conn = getConnexion();

        $filtre = '';
        if ($date_debut != null && $date_fin != null) {
                $filtre .= " AND intervention.date_heure BETWEEN '$date_debut' AND '$date_fin'";
              }

        $sql = "SELECT sum(client.distance_km)
        from technicien left join intervention on technicien.matricule = intervention.matricule
        left join client on intervention.id_client = client.id
        and intervention.etat = 3
        and technicien.matricule = :matricule
        $filtre";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":matricule", $matricule, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch();
        $conn = null;
        return $result;
}

function temps_passe($matricule,$date_debut,$date_fin)
{
        include_once 'db_config.php';
        // se connecter
        $conn = getConnexion();

        $filtre = '';
        if ($date_debut != null && $date_fin != null) {
                $filtre .= " AND intervention.date_heure BETWEEN '$date_debut' AND '$date_fin'";
              }

        $sql = "SELECT sum(concerner.temps_passe)
        from technicien left join intervention on technicien.matricule = intervention.matricule
        left join concerner on intervention.id = concerner.id_intervention 
        and intervention.etat = 3
        and technicien.matricule = :matricule
        $filtre";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":matricule", $matricule, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch();
        $conn = null;
        return $result;


        
}
