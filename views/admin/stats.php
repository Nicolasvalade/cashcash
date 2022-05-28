<?php
$title = 'Stats';
ob_start();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="graph.js"></script>

<br />
<form id="f-stats" action="#" method="POST" class="form-filtre">

    <!-- Bouton technicien -->
    <div>
        <label for="f-matricule">Technicien</label>
        <select onchange="submitForm()" name="f_matricule" id="f-matricule">
            <option value="">Tous</option>

            <?php foreach ($all_tech as $tech) : ?>
                <?php // garder affiché le technicien selectionné
                if ($tech['matricule'] == $f_matricule) : ?>
                    <option selected value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>
                <?php else : ?>
                    <option value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>
                <?php endif; ?>

            <?php endforeach; ?>

        </select>
    </div>

    <!-- Boutons dates -->
    <div>
        <?php // n'activer les dates que si un technicien est choisi
        if (!($f_matricule || $f_date_debut || $f_date_fin)) : ?>
            <label for="f-date-debut">Du</label>
            <input disabled onchange="submitForm()" value="<?= $f_date_debut ?>" name="f_date_debut" id="f-date-debut" type="date" />
            <label for="f-date-fin">au</label>
            <input disabled onchange="submitForm()" value="<?= $f_date_fin ?>" name="f_date_fin" id="f-date-fin" type="date" />
        <?php else : ?>
            <label for="f-date-debut">Du</label>
            <input onchange="submitForm()" value="<?= $f_date_debut ?>" name="f_date_debut" id="f-date-debut" type="date" />
            <label for="f-date-fin">au</label>
            <input onchange="submitForm()" value="<?= $f_date_fin ?>" name="f_date_fin" id="f-date-fin" type="date" />
        <?php endif; ?>
    </div>

    <!-- Bouton effacer -->
    <div>
        <?php // n'activer le bouton effacer que si un technicien est choisi
        if (!($f_matricule || $f_date_debut || $f_date_fin)) : ?>
            <button disabled type="button" onclick="resetForm()">Effacer</button>
        <?php else : ?>
            <button type="button" onclick="resetForm()">Effacer</button>
        <?php endif; ?>
    </div>
</form>
<br />

<!-- Afficher les données si un technicien est choisi -->
<?php if ($f_matricule) : ?>
    <div>
        <p>Nombre d'interventions : <?= $nb_interv[0] ?></p>
        <p>Km parcourus : <?= $km[0] ?></p>
        <p>Temps passé : <?= $temps[0] ?></p>
    </div>
<?php endif; ?>

<!-- Charger les données dès qu'on change un filtre -->
<script>
    function resetForm() {
        document.getElementById('f-matricule').value = "";
        document.getElementById('f-date-debut').value = "";
        document.getElementById('f-date-fin').value = "";
        document.getElementById('f-stats').submit();
    }

    function submitForm() {
        document.getElementById('f-stats').submit();
    }
</script>

</br>
<canvas id="graph_interv_gerant"></canvas>

<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();

// et envoyer $content à ce fichier qui contient le moule de chaque page
require_once 'templates/base.php';
?>