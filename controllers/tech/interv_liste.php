<?php
include_once 'models/interv_arrays.php';
include_once 'models/tech_arrays.php';
include_once 'util/dates.php';
include_once 'util/urls.php';

$matricule = isset($_SESSION['matricule']) ? $_SESSION['matricule'] : "C48585";
$prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : "Luc";
$nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : "Lechat";

$a_faire = get_interventions_affectees_a($matricule);
$historique = get_interventions_affectees_a($matricule, 3, null, null, "i.date_heure DESC");

include 'views/tech/interv_liste.php';
