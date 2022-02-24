<?php

use Dompdf\Dompdf;
use Dompdf\Options;

include_once 'models/interv.php';
$interv = get_intervention_by_id($_GET['id']);

ob_start();
include 'views/admin/interv_pdf.php';
$content = ob_get_contents();
ob_end_clean();

include 'util/dompdf/autoload.inc.php';

$options = new Options();
//$options->set('defaultFont', 'Courier');

$dompdf = new Dompdf($options);
$dompdf->loadHtml($content);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$fichier = "intervention_$interv[id].pdf";

$dompdf->stream($fichier);
