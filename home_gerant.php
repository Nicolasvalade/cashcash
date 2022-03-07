<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashcash</title>
</head>
<body>
    <?php
      $host = '127.0.0.1';
      $dbname = 'cashcash';
      $username = 'root';
      $password = ' ';
    try{
        $base = new PDO("mysql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password");
        echo "conexion reussi";
     }catch (PDOException $e){
         echo $e->getMessage();
     }
   
    
    ?>
    
    
    
    
            <form action="home_gerant.php" method="POST">
                <label for = "n_tech">Nom du techniciens</label>
                <input type ="text" id="id_ip_ntech" name="ip_Ntech">

                <label for="dt_debut">date de début</label>
                <input type="date" id="dt_debut" name="dt_debut"
                    value=""
                    min="" max="">

                <label for="dt_fin ">date de fin</label>
                <input type="date" id="dt_fin" name="dt_fin"
                value=""
                min="" max="">
                
            <input type="submit" value="Rechercher">


            </form>

    <?php
            $sql = "SELECT technicien.matricule ,technicien.nom, technicien.prenom , count(intervention.matricule) as 'nombre_intervention' 
            from 'technicien' left join intervention on technicien.matricule = intervention.matricule
            where technicien.matricule = '$_POST[ip_Ntech]'
            and intervention.etat = 3";
            $stmt = $base ->prepare($sql);
            

            $nbrIntervention = $stmt-> query();
              
    ?>

            <div>         
                        
                            <li>
                            <ul>nombre d'intervention</ul>
                            <ul><? echo "$nbrIntervention[nombre_intervention]"?></ul>
                            
                            </li>
                        
            </div>
    
            

     

    
     


</body>
</html>
