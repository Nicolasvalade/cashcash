<?php
include_once 'models/interv_arrays.php';
include_once 'models/tech_arrays.php';
include_once 'util/dates.php';
include_once 'util/erreurs.php';

$f_matricule = isset($_POST['f_matricule']) ? $_POST['f_matricule'] : null;
$f_date_debut = isset($_POST['f_date_debut']) ? $_POST['f_date_debut'] : null;
$f_date_fin = isset($_POST['f_date_fin']) ? $_POST['f_date_fin'] : null;

if ($f_matricule || $f_date_debut && $f_date_fin) {
    $all_interv = get_interventions_by_technicien_date($f_matricule, $f_date_debut, $f_date_fin);
} else {
    $all_interv = get_all_interventions();
}

$all_tech = get_all_techniciens('nom');

include 'views/admin/interv_liste.php';
