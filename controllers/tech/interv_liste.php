<?php
include_once 'models/interv_arrays.php';
include_once 'util/dates.php';
include_once 'models/tech_arrays.php';

$matricule = isset($_SESSION['matricule']) ? $_SESSION['matricule'] : "C48585";
$prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : "Luc";
$nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : "Lechat";

$all_interv = get_interventions_affectees_a($matricule);

include 'views/tech/interv_liste.php';
