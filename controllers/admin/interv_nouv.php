
<?php
include_once 'models/interv.php';
include_once 'models/cli_arrays.php';
include_once 'models/mat_arrays.php';
include_once 'util/dates.php';

$f_client = isset($_POST['f_client']) && $_POST['f_client'] != "" ? $_POST['f_client'] : null;
$mat_eligibles = $f_client ? get_materiels_by_client($f_client) : null;

// un formulaire vient-il d'être transmis ?
if (isset($_POST['client']) || isset($_POST['date']) || isset($_POST['heure'])) {

    // dès qu'il y a une erreur on redirige vers la page avec un code erreur en $_GET

    // traitement du client
    $client = isset($_POST['client']) && $_POST['client'] != "" ? $_POST['client'] : null;
    if (!$client) {
        header("Location: $uri?erreur=ain1");
        die();
    }

    // traitement des dates et heures
    $date = isset($_POST['date']) && $_POST['date'] != "" ? $_POST['date'] : null;
    $heure =  isset($_POST['heure']) && $_POST['heure'] != "" ? $_POST['heure'] : null;
    if ($date && $heure) {
        $date_heure = date_heure_sql($date, $heure);
    } else {
        header("Location: $uri?erreur=ain2");
        die();
    }

    // traitement des matériels
    $materiels = [];
    if (isset($_POST['materiels'])) {
        foreach ($_POST['materiels'] as $n_serie => $_)
            $materiels[] = $n_serie;
    }

    // exécution de la requête
    $success = insert_intervention($date_heure, $client, $materiels);
    if (!$success) {
        header("Location: $uri?erreur=ain3");
        die();
    }

    // si on arrive jusqu'ici, retourner sur la liste avec message de succès
    header("Location: $index_admin/interventions?erreur=ail1");
}

$all_clients = get_all_clients();
$creneaux = creneaux();

include 'views/admin/interv_nouv.php';
