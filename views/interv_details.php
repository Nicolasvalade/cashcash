<?php
$title = $interv['id'];
ob_start();
?>
<h1>Intervention <?= $interv['id'] ?></h1>
<p>Client : <?= $interv['client'] ?></p>
<p>Planifiée le : <?= date_locale($interv['date_heure']) ?> <?= heure_courte($interv['date_heure']) ?></p>
<p>Etat : <?= $interv['e_libelle'] ?></p>

<?php // Formulaire d'affectation si non affectée
if ($interv['e_id'] == 1) : ?>
    <form method="POST" action="#">
        <select name="affecter_a">
            <?php foreach ($all_tech as $tech) : ?>
                <option value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Affecter</button>
    </form>

<?php // Bouton PDF et nom technicien si affectée ou réalisée
elseif ($interv['e_id'] == 2 || $interv['e_id'] == 3) : ?>
    <p>Affectée à : <?= $interv['t_prenom'] . ' ' . $interv['t_nom'] ?></p>
    <p>
        <a href="<?= $index ?>/pdf/intervention?id=<?= $interv['id'] ?>">
            <button>Fiche PDF</button>
        </a>
    </p>
<?php endif; ?>


<?php // Bouton modifier si l'intervention n'est pas encore réalisée
if ($interv['e_id'] < 3) : ?>
    <p>
        <a href="<?= $index ?>/intervention/edit?id=<?= $interv['id'] ?>">
            <button>Modifier</button>
        </a>
    </p>
<?php endif; ?>


<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'templates/base.php';
