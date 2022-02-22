<?php
$title = $interv['id'];
ob_start();
?>
<h1>Intervention <?= $interv['id'] ?></h1>
<p>Client : <?= $interv['client'] ?></p>
<p>Planifiée le : <?= $interv['date_heure'] ?></p>
<p>Etat : <?= $interv['e_libelle'] ?></p>
<?php if($interv['t_nom'] !== NULL) : ?>
    <p>Affectée à : <?= $interv['t_prenom'] . ' ' . $interv['t_nom'] ?></p>
    <a href="<?= $index ?>/pdf/intervention?id=<?= $interv['id'] ?>">
        <button>Fiche PDF</button>
    </a>
<?php else : ?>
    <form method="POST" action="#">
        <select name="affecter_a">
            <?php foreach($all_tech as $tech) : ?>
                <option value="<?=$tech['matricule'] ?>"><?="$tech[nom] $tech[prenom]"?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Affecter</button>
    </form>
<?php endif; ?>
<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'base_template.php'
?>
<script>
    // 
</script>