<?php
include_once 'models/interv.php';
include_once 'util/dates.php';
include_once 'models/tech_arrays.php';

$interv = get_intervention_by_id($_GET['id']);
$creneaux = creneaux();
$date = substr($interv['date_heure'], 0, 10);
$heure = substr($interv['date_heure'], 11, 8); 
$all_tech = get_techniciens_agence($interv['code_agence'], 'nom');

include 'views/interv_edit.php';
