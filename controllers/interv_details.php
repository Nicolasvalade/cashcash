<?php
require_once 'models/interv.php';
$interv = get_intervention_by_id($_GET['id']);
require_once 'views/interv_details.php';
