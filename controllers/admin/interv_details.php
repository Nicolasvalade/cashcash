<?php
include_once 'models/interv.php';
include_once 'models/mat_arrays.php';
include_once 'models/tech_arrays.php';
include_once 'util/dates.php';

if (isset($_POST['affecter_a'])) {
    $matricule = $_POST['affecter_a'] != "" ? $_POST['affecter_a'] : null;
    $success = affecter_interv_a($_GET['id'], $matricule);
    if (!$success) {
        header("Location: $uri?id=$_GET[id]&erreur=aid1");
        die();
    }
    header("Location: $uri?id=$_GET[id]");
}

$interv = get_intervention_by_id($_GET['id']);
$all_mat = get_materiels_by_interv($_GET['id']);
$all_tech = get_techniciens_agence($interv['code_agence'], 'nom');
include 'views/admin/interv_details.php';
