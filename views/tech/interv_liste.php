<?php
$title = "Interventions de $prenom $nom ($matricule)";
ob_start();
?>
<h1>Interventions de <?= "$prenom $nom ($matricule)" ?></h1>

<table>
  <thead>
    <tr>
      <th>N°</th>
      <th>Client</th>
      <th>Date</th>
      <th>Heure</th>
      <th>Distance (km)</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($all_interv as $interv) : ?>

      <tr class="clickable" onclick="window.location='<?= $index_tech ?>/intervention?id=<?= $interv['id'] ?>'">
        <td><?= "$interv[id]" ?></td>
        <td><?= "$interv[client]" ?></td>
        <td><?= date_locale($interv['date_heure']) ?></td>
        <td><?= heure_courte($interv['date_heure']) ?></td>
        <td><?= "$interv[distance_km]" ?></td>
        <td>
          <?php $adresse = "$interv[adresse] $interv[ville] $interv[code_postal] $interv[pays]"?>
          <a href="https://www.google.com/maps/dir/?api=1&destination=<?=url_maps($adresse)?>">
            <button>Google Maps</button>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>

<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'templates/base.php';
?>