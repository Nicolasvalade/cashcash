<?php
include_once 'models/interv.php';
include_once 'util/dates.php';
include_once 'models/tech_arrays.php';
if (isset($_POST['affecter_a'])) {
    $success = affecter_a($_GET['id'], $_POST['affecter_a']);
    if (!$success) {
        die("Erreur.");
    }
}
$interv = get_intervention_by_id($_GET['id']);
$all_tech = get_techniciens_agence($interv['code_agence'], 'nom');
include 'views/interv_details.php';
