<?php
$title = 'Liste des interventions';
ob_start();
?>
    <form action="#" method="POST">

                    <label for = "n_tech">Matricule</label>
                    <input type ="text" id="id_ip_ntech" name="matricule">

                    <label for="dt_debut">date de début</label>
                    <input type="date" id="dt_debut" name="dt_debut"
                        value=""
                        min="" max="">

                    <label for="dt_fin "    >date de fin</label>
                    <input type="date" id="dt_fin" name="dt_fin"
                    value=""
                    min="" max="">
                    
                    <input type="submit" value="Rechercher">

    </form>

    

    <li>
    <ul>nombre d'intervention</ul>
    <ul><?= $nbrIntervention["count(intervention.matricule)"]?></ul>

    </li>   
<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'templates/base.php';
?>       
