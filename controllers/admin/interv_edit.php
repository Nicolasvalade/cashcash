<?php
include_once 'models/interv.php';
include_once 'util/dates.php';
include_once 'models/tech_arrays.php';

// un formulaire vient-il d'être transmis ?
if(isset($_POST['matricule']) || isset($_POST['date']) || isset($_POST['heure'])){
    
    // traitement des dates et heures
    $date = isset($_POST['date']) && $_POST['date'] != "" ? $_POST['date'] : null;
    $heure =  isset($_POST['heure']) && $_POST['heure'] != "" ? $_POST['heure'] : null;
    if($date && $heure){
        $date_heure = date_heure_sql($date, $heure);
    }else{
        header("Location: $uri?id=$_GET[id]&error=1");
        die();
    }

    // traitement du matricule
    $interv = get_intervention_by_id($_GET['id']);
    $matricule = isset($_POST['matricule']) && $_POST['matricule']!=""? $_POST['matricule'] : null;
    if($interv['e_id']!=1 && !$matricule){
        header("Location: $uri?id=$_GET[id]&error=2");
        die();
    }

    // exécution de la requête
    $success = update_intervention($_GET['id'], $date_heure, $matricule);
    if (!$success){
        header("Location: $uri?id=$_GET[id]&error=3");
        die();
    }

    header("Location: $uri?id=$_GET[id]");
}

$error="";
if(isset($_GET['error'])){
    switch($_GET['error']){
        case 1:
            $error = "Choisissez une date et une heure valides.";
            break;
        case 2:
            $error = "Choisissiez un technicien valide.";
            break;
        case 3:
            $error = "Echec de la modification.";
            break;
    }
}

$interv = get_intervention_by_id($_GET['id']);
$creneaux = creneaux();
$date = date_input($interv['date_heure']);
$heure = heure_input($interv['date_heure']);
$all_tech = get_techniciens_agence($interv['code_agence'], 'nom');

include 'views/admin/interv_edit.php';
