<?php
include_once 'models/interv.php';
include_once 'models/mat_arrays.php';
include_once 'models/tech_arrays.php';
include_once 'util/dates.php';
include_once 'util/erreurs.php';

// un formulaire vient-il d'être transmis ?
if (isset($_POST['matricule']) || isset($_POST['date']) || isset($_POST['heure'])) {

    // dès qu'il y a une erreur on redirige vers la page avec un code erreur en $_GET

    // traitement des dates et heures
    $date = isset($_POST['date']) && $_POST['date'] != "" ? $_POST['date'] : null;
    $heure =  isset($_POST['heure']) && $_POST['heure'] != "" ? $_POST['heure'] : null;
    if ($date && $heure) {
        $date_heure = date_heure_sql($date, $heure);
    } else {
        header("Location: $uri?id=$_GET[id]&erreur=aie1");
        die();
    }

    // traitement du matricule
    $interv = get_intervention_by_id($_GET['id']);
    $matricule = isset($_POST['matricule']) && $_POST['matricule'] != "" ? $_POST['matricule'] : null;
    if ($interv['e_id'] != 1 && !$matricule) {
        header("Location: $uri?id=$_GET[id]&erreur=aie2");
        die();
    }

    // traitement des matériels
    $materiels = [];
    if (isset($_POST['materiels'])) {
        foreach ($_POST['materiels'] as $n_serie=>$_)
            $materiels[] = $n_serie;
    }

    // exécution de la requête
    $success = update_intervention($_GET['id'], $date_heure, $matricule, $materiels);
    if (!$success) {
        header("Location: $uri?id=$_GET[id]&erreur=aie3");
        die();
    }

    // si on arrive jusqu'ici, recharger la page sans erreur
    header("Location: $uri?id=$_GET[id]");
}


// récupérer le code erreur pour trouver le message à afficher
$code_erreur = isset($_GET['erreur']) ? $_GET['erreur'] : "";
$erreur = get_msg_erreur($code_erreur);



$interv = get_intervention_by_id($_GET['id']);
$creneaux = creneaux();
$date = date_input($interv['date_heure']);
$heure = heure_input($interv['date_heure']);
$all_tech = get_techniciens_agence($interv['code_agence'], 'nom');
$mat_concernes = get_materiels_by_interv($_GET['id']);
$mat_eligibles = get_materiels_by_client($interv['id_client'], $_GET['id']);

include 'views/admin/interv_edit.php';
