<?php
$title = 'Liste des interventions';
ob_start();
?>
<h1>Liste des interventions</h1>

<?php if ($erreur) : ?>
    <p><?= $erreur ?></p>
<?php endif; ?>

<form id="f-client" method="POST" action="#">
    <p>
        <label for="f-client">Client</label>
        <select onchange="submitForm()" name="f_client" id="f-client">
            <option value=""></option>

            <?php foreach ($all_clients as $client) : ?>

                <?php // garder affiché le technicien selectionné
                if ($client['id'] == $f_client) : ?>
                    <option selected value="<?= $client['id'] ?>"><?= $client['raison_sociale'] ?></option>

                <?php else : ?>
                    <option value="<?= $client['id'] ?>"><?= $client['raison_sociale'] ?></option>
                <?php endif; ?>

            <?php endforeach; ?>

        </select>
    </p>
</form>

<form method="POST" action="#">

    <input type="hidden" name="client" value="<?= $f_client ?>">
    <p>
        <label>Date</label>
        <input type="date" name="date" id="date" value="" />
        <select name="heure" id="heure">
            <option value=""></option>

            <?php foreach ($creneaux as $creneau) : ?>
                <option value="<?= $creneau['value'] ?>">
                    <?= $creneau['label'] ?>
                </option>
            <?php endforeach; ?>

        </select>
    </p>

    <?php if (!$f_client) : ?>
        <p>Sélectionnez un client pour voir les matériels éligibles.</p>
    <?php // montrer la liste des matériels éligibles
    elseif ($mat_eligibles) : ?>
        <p>Matériels éligibles</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>N° serie</th>
                    <th>Emplacement</th>
                    <th>Matériel</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($mat_eligibles as $mat) : ?>
                    <tr>
                        <td><input type="checkbox" name="materiels[<?= "$mat[n_serie]" ?>]" /></td>
                        <td><?= "$mat[n_serie]" ?></td>
                        <td><?= "$mat[emplacement]" ?></td>
                        <td><?= "$mat[type]" ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    <?php else : ?>
        <p>Le client n'a pas de matériel éligible.</p>

    <?php endif; ?>

    <p><button type="submit">Enregistrer</button></p>
</form>


<script>
    function resetForm() {
        document.getElementById('f-client').value = "";
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