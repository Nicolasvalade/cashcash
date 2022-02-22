<?php
include_once 'models/interv_arrays.php';
$all_interv = get_all_interventions();
$interv_a_affecter = get_interventions_a_affecter();
$interv_en_cours = get_interventions_affectees();
$archive = array_merge(get_interventions_cloturees(), get_interventions_annulees());
include 'views/interv_liste.php';
