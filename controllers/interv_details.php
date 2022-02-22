<?php
include_once 'models/interv.php';
include_once 'models/tech_arrays.php';
if(isset($_POST['affecter_a']))
{
    $success = affecter_a($_GET['id'],$_POST['affecter_a']);
    if(!$success)
    {
        die("Erreur.");
    }
    else
    {
        include 'controllers/pdf/interv_pdf.php';
    }
}
else
{
    $interv = get_intervention_by_id($_GET['id']);
    $all_tech = get_all_techniciens();
    include 'views/interv_details.php';
}

