<?php
$title = 'Liste des intervs';
ob_start();
?>
<h1>Liste des interventions</h1>
<ul>
  <?php foreach ($interv_array as $interv) : ?>
    <li>
      <a href="<?= $index ?>/intervention?id=<?= $interv['id'] ?>">
        <?= "Intervention $interv[id], $interv[client] : $interv[t_prenom] $interv[t_nom]" ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'base_template.php'
?>