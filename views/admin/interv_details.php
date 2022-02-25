<?php
$title = $interv['id'];
ob_start();
?>
<h1>Intervention <?= $interv['id'] ?></h1>
<p><?=$erreur?></p>

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
<?php // nom technicien si affectée ou réalisée
elseif ($interv['e_id'] == 2 || $interv['e_id'] == 3) : ?>
    <p>Affectée à : <?= $interv['t_prenom'] . ' ' . $interv['t_nom'] ?></p>
<?php endif; ?>

<?php // s'il y a des matériels, afficher la liste
if ($all_mat):?>
    <table>
        <thead>
            <tr>
            <th>N° serie</th>
            <th>Emplacement</th>
            <th>Matériel</th>
            <th>Commentaire</th>
            <th>Temps passé</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_mat as $mat) : ?>
                <tr>
                    <td><?= "$mat[n_serie]" ?></td>
                    <td><?= "$mat[emplacement]" ?></td>
                    <td><?= "$mat[type]" ?></td>
                    <td><?= "$mat[commentaire]" ?></td>
                    <td><?= "$mat[temps_passe]" ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else:?>
    <p>Aucun matériel</p>
<?php endif;?>



<p>

    <a href="<?= $index_admin ?>/interventions">
        <button>Retourner à la liste</button>
    </a>

    <?php // Bouton modifier si l'intervention n'est pas encore réalisée
    if ($interv['e_id'] < 3) : ?>
        <a href="<?= $index_admin ?>/intervention/edit?id=<?= $interv['id'] ?>">
            <button>Modifier</button>
        </a>
    <?php endif; ?>
    
    <?php // fiche pdf si l'intervention est affectée ou réalisée
    if ($interv['e_id'] == 2 || $interv['e_id'] == 3) : ?>
        <a href="<?= $index_admin ?>/pdf/intervention?id=<?= $interv['id'] ?>">
            <button>Fiche PDF</button>
        </a>
    <?php endif;?>

</p>

<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'templates/base.php';
