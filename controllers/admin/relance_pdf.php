<?php

use Dompdf\Dompdf;
use Dompdf\Options;

include_once 'models/relance.php';
include_once 'util/dates.php';

$delai = isset($_GET['delai']) ? $_GET['delai'] : 30;

$client = get_client_by_id($_GET['id']);
$agence = get_agence_by_id($client['code_agence']);
$gestionnaire = get_gestionnaire_agence($client['code_agence']);

$lignes = get_contrats_avec_materiels($client['id']);
$contrats = [];

// remplir $contrats avec les materiels dont le contrat arrive à expiration dans X jours
foreach ($lignes as $ligne) {
    $date = new DateTime();
    $date_renouv = new DateTime($ligne['date_renouvellement']);

    $ligne['date_echeance'] = $date_renouv->add(new DateInterval('P1Y'));
    $ligne['jours_restants'] = (int) $date->diff($ligne['date_echeance'])->format('%a');

    if ($date < $ligne['date_echeance'] && $ligne['jours_restants'] < $delai) {
        $contrats[$ligne['id_contrat']][] = $ligne;
    }
}

ob_start();
include 'views/admin/relance_pdf.php';
$content = ob_get_contents();
ob_end_clean();

// DEBUG :
// echo $content;

include 'util/dompdf/autoload.inc.php';

$options = new Options();
//$options->set('defaultFont', 'Courier');

$dompdf = new Dompdf($options);
$dompdf->loadHtml($content);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$fichier = "relance_client_$client[id].pdf";

$dompdf->stream($fichier);
