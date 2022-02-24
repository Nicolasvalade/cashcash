<?php
include_once 'models/interv.php';
include_once 'util/dates.php';
include_once 'models/tech_arrays.php';

if (isset($_POST['matricule']) || isset($_POST['date'])) {
    $date = isset($_POST['date']) ? $_POST['date'] : "";
    $heure =  isset($_POST['heure']) ? $_POST['heure'] : "00:00:00";
    $date_heure = date_heure($date, $heure);
    $matricule = isset($_POST['matricule']) ? $_POST['matricule'] : null;
    $success = update_intervention($_GET['id'], $date_heure, $matricule);
    if (!$success) {
        die("Erreur.");
    }
}

$interv = get_intervention_by_id($_GET['id']);
$creneaux = creneaux();
$date = date_input($interv['date_heure']);
$heure = heure_input($interv['date_heure']);
$all_tech = get_techniciens_agence($interv['code_agence'], 'nom');

include 'views/interv_edit.php';
