<?php
include_once 'views\admin\stats.php';
include_once 'models/stats.php';

$matricule = isset($_POST['matricule']) ? $_POST['matricule'] : null;
$nbrIntervention = nbr_interventions($matricule);

include 'views\admin\stats.php';
?>