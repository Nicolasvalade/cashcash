<?php
$title = 'Liste des Clients';
ob_start();
?>
<h1>Liste des Clients</h1>

<form id="f-id" method="POST" action="#" class="form-filtre">

  <div>
    <label for="f-id">Client</label>
    <select onchange="submitForm(this)" name="f_raison_sociale" id="f-id">
      <option value=""></option>

      <?php foreach ($all_tech as $client) : ?>

        <?php // garder affiché le technicien selectionné
        if ($client['id'] == $f_id) : ?>
          <option selected value="<?= $client['id'] ?>"><?= "$client[raison_sociale]" ?></option>

        <?php else : ?>
          <option value="<?= $client['id'] ?>"><?= "$client[raison_sociale]" ?></option>
        <?php endif; ?>

      <?php endforeach; ?>

    </select>
  </div>
</form>

<table>
  <thead>
    <tr>
      <th>N°</th>
      <th>Raison_sociale</th>
      <th>Ville</th>
      <th>Adresse</th>
      <th>Telephone</th>
      <th>email</th>
      <th>distance_km</th>
      <th>duree_deplacement_minutes</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($all_clients as $client) : ?>

        <tr>

        <td><?= $client['id'] ?></td> 
        <td><?= "$client[raison_sociale]" ?></td>
        <td><?= "$client[ville]" ?></td>
        <td><?= "$client[adresse]" ?></td>
        <td><?= "$client[telephone]" ?></td>
        <td><?= "$client[email]" ?></td>
        <td><?= "$client[distance_km]" ?></td>
        <td><?= "$client[duree_deplacement_minutes]" ?></td>
        </tr>
      <?php endforeach; ?>

  </tbody>
</table>

<script>
  function resetForm() {
    document.getElementById('f-id').value = "";
    document.getElementById('f-client').submit();
  }

  function submitForm() {
    document.getElementById('f-client').submit();
  }
</script>

<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'templates/base.php';
?>