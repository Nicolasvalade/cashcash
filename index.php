
<?php
// gestion des routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$domaine = '/cashcash';
$index = '/cashcash/index.php';
$index_admin = '/cashcash/index.php/admin';
$index_tech = '/cashcash/index.php/tech';

switch (true) {

    // Espace commun
  case ($uri == $index):
    require_once 'views/accueil.php';
    break;

    // Espace gérant
  case ($uri == $index_admin . '/interventions'):
    require_once 'controllers/admin/interv_liste.php';
    break;
  case ($uri == $index_admin . '/intervention'  && isset($_GET['id'])):
    require_once 'controllers/admin/interv_details.php';
    break;
  case ($uri == $index_admin . '/intervention/edit'  && isset($_GET['id'])):
    require_once 'controllers/admin/interv_edit.php';
    break;
  case ($uri == $index_admin . '/pdf/intervention'  && isset($_GET['id'])):
    require_once 'controllers/admin/interv_pdf.php';
    break;

    // Espace technicien
  case ($uri == $index_tech . '/interventions'):
    require_once 'controllers/tech/interv_liste.php';
    break;
  case ($uri == $index_tech . '/intervention'  && isset($_GET['id'])):
    require_once 'controllers/tech/interv_valid.php';
    break;

    // Tests
  case ($uri == $index . '/pdf/test'):
    require_once 'util/pdf_test.php';
    break;

    // 404
  default:
    header('Status: 404 Not Found');
    echo '<!DOCTYPE html><html><body>Erreur 404 : page introuvable.</body></html>';
}
