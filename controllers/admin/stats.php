<?php
include_once 'models/stats.php';
include_once 'models/tech_arrays.php';
include_once 'util/dates.php';

$f_matricule = isset($_POST['f_matricule']) && $_POST['f_matricule'] != "" ? $_POST['f_matricule'] : null;
$f_date_debut = isset($_POST['f_date_debut']) && $_POST['f_date_debut'] != "" ? $_POST['f_date_debut'] : null;
$f_date_fin = isset($_POST['f_date_fin']) && $_POST['f_date_fin'] != "" ? $_POST['f_date_fin'] : null;

$all_tech = get_all_techniciens('nom');

if ($f_matricule) {
    $nb_interv = nbr_interventions($f_matricule,$f_date_debut,$f_date_fin);
    $km = km_effectues($f_matricule,$f_date_debut,$f_date_fin);
    $temps = temps_passe($f_matricule,$f_date_debut,$f_date_fin);
}

include 'views/admin/stats.php';
