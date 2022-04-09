<?php
$title = 'Stats';
ob_start();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src = "graph.js"></script>
<form action="" method="POST">

    <label for="n_tech">Matricule</label>
    <input type="text" id="id_ip_ntech" name="matricule">

    <div>
    <label for="f-date-debut">Du</label>
    <input onchange="submitForm()" value="<?= $f_date_debut ?>" name="f_date_debut" id="f-date-debut" type="date" />
    <label for="f-date-fin">au</label>
    <input onchange="submitForm()" value="<?= $f_date_fin ?>" name="f_date_fin" id="f-date-fin" type="date" />
    </div>

    <input type="submit" value="Rechercher">

    <?php // afficher le bouton reset si un filtre est appliqué
    if ($f_date_debut || $f_date_fin) : ?>
        <div>
        <button type="button" onclick="resetForm()">Effacer</button>
        </div>
    <?php endif; ?>

</form>

    

<?= $matricule ?>

<div>
    <p>Nombre d'interventions : <p id="nb_intervention"><?= $nb_interv[0] ?></p>
    <p>Km parcourus : <p id ="km_effectue"><?= $km[0] ?></p></p>
    <p>Temps passé : <?= $temps[0] ?></p>
</div>

    </br>
    <canvas id = "graph_interv_gerant"></canvas>
<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'templates/base.php';
?>
<p>statistique<p>