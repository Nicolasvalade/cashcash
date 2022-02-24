<?php
$title = 'Liste des clients';
ob_start();
?>
<h1>Liste des clients</h1>
<ul>
  <?php foreach ($client_array as $client) : ?>
    <li>
      <a href="<?= $index ?>/client?id=<?= $client['id'] ?>">
        <?= "client $client[id]" ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'base_template.php'
?>