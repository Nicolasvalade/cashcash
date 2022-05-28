<?php
include_once 'models/stats.php';
include_once 'util/dates.php';

$f_date_debut = isset($_POST['f_date_debut']) ? $_POST['f_date_debut'] : null;
$f_date_fin = isset($_POST['f_date_fin']) ? $_POST['f_date_fin'] : null;
$matricule = isset($_POST['matricule']) && $_POST['matricule'] != "" ? $_POST['matricule'] : null;
$nb_interv = 0;
$km = 0;
$temps = 0;
if ($matricule) {
    $nb_interv = nbr_interventions($matricule,$f_date_debut,$f_date_fin);
    $km = km_effectues($matricule,$f_date_debut,$f_date_fin);
    $temps = temps_passe($matricule,$f_date_debut,$f_date_fin);
}

include 'views/admin/stats.php';
