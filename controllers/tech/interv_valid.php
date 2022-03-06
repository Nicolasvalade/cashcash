<?php
include_once 'models/interv.php';
include_once 'models/mat_arrays.php';
include_once 'util/dates.php';

if (isset($_POST['materiels'])) {

  $materiels = $_POST['materiels'];

  if (count($materiels) == 0) {
    header("Location: $uri?id=$_GET[id]&erreur=tiv1");
    die();
  }
  $success = valider_interv($_GET['id'], $materiels);
  if (!$success) {
    header("Location: $uri?id=$_GET[id]&erreur=tiv2");
    die();
  }
  header("Location: $uri?id=$_GET[id]");
}

$all_mat = get_materiels_by_interv($_GET['id']);
$interv = get_intervention_by_id($_GET['id']);
include 'views/tech/interv_valid.php';
