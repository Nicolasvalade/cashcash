<?php
$title = 'Liste des interventions';
ob_start();
?>
<h1>Liste des interventions</h1>

<?php if(count($interv_a_affecter)===0) : ?>
  <p>Aucune intervention à affecter.</p>
<?php else : ?>
  <p>Interventions à affecter :</p>
  <ul>
    <?php foreach ($interv_a_affecter as $interv) : ?>
      <li>
        <a href="<?= $index ?>/intervention?id=<?= $interv['id'] ?>">
          <?= "Intervention $interv[id] du $interv[date_heure], $interv[client]" ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<p>Toutes les interventions</p>
<ul>
  <?php foreach ($all_interv as $interv) : ?>
    <li>
      <a href="<?= $index ?>/intervention?id=<?= $interv['id'] ?>">
        <?= "Intervention $interv[id] du $interv[date_heure], $interv[client]" ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>

<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'base_template.php'
?>