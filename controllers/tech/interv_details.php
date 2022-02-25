<?php
include_once 'models/interv.php';
include_once 'models/tech_arrays.php';
include_once 'util/dates.php';
include_once 'util/erreurs.php';

if (isset($_POST['valider'])) {
    $materiels=[];
    $i = 0;
    while (isset($_POST["n_serie_$i"])&&isset($_POST["comm_$i"])&&isset($_POST["temps_$i"])){
        $materiels[]= [
            "n_serie" => $_POST["n_serie_$i"],
            "commentaire" => $_POST["comm_$i"],
            "temps_passe" => $_POST["temps_$i"]
        ];
    }
    if (count($materiels)==0){
        header("Location: $uri?id=$_GET[id]&erreur=tid1");
        die();
    }
    $success = valider_interv($_GET['id'], $materiels);
    if (!$success) {
        header("Location: $uri?id=$_GET[id]&erreur=tid2");
        die();
    }
    header("Location: $uri?id=$_GET[id]");
}

// récupérer le code erreur pour trouver le message à afficher
$code_erreur = isset($_GET['erreur']) ? $_GET['erreur'] : "";
$erreur = get_msg_erreur($code_erreur);

$interv = get_intervention_by_id($_GET['id']);
$all_tech = get_techniciens_agence($interv['code_agence'], 'nom');
include 'views/admin/interv_details.php';
