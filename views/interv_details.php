<?php
$title = $interv['id'];
ob_start();
?>
<h1>Intervention <?= $interv['id'] ?></h1>
<p>Client : <?= $interv['client'] ?></p>
<p>Planifiée le : <?= $interv['date_heure'] ?></p>
<p>Etat : <?= $interv['etat'] ?></p>
<p>Affectée à : <?= $interv['t_prenom'] . ' ' . $interv['t_nom'] ?></p>

<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'base_template.php'
?>