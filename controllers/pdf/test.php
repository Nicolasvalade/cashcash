<?php
use Dompdf\Dompdf;

require_once 'util/dompdf/autoload.inc.php';

$dompdf = new Dompdf();
$dompdf->loadHtml('test');
$dompdf->render();
$dompdf->stream();
