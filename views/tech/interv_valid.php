<?php
$title = $interv['id'];
ob_start(); ?>
<h1>Intervention <?= $interv['id'] ?></h1>

<?php if ($erreur) : ?>
    <p><?= $erreur ?></p>
<?php endif; ?>

<p>Client : <?= $interv['client'] ?></p>
<p>Planifiée le : <?= date_locale($interv['date_heure']) ?> <?= heure_courte($interv['date_heure']) ?></p>
<p>Etat : <?= $interv['e_libelle'] ?></p>

<?php // s'il y a des matériels, afficher la liste
if ($all_mat) : ?>
    <form method="POST" action="#">
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
                        <td>
                            <?php if ($interv['e_id'] == 2) : ?>
                                <input type="text" name="materiels[<?= $mat['n_serie'] ?>][commentaire]">
                            <?php else : ?>
                                <?= "$mat[commentaire]" ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($interv['e_id'] == 2) : ?>
                                <input type="number" name="materiels[<?= $mat['n_serie'] ?>][temps_passe]">
                            <?php else : ?>
                                <?= "$mat[temps_passe]" ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <?php if ($interv['e_id'] == 2) : ?>
            <button type="submit">Valider l'intervention</button>
        <?php endif; ?>
    </form>

<?php else : ?>
    <p>Aucun matériel. Contactez votre agence.</p>

<?php endif; ?>

<p>
    <a href="<?= $index_tech ?>/interventions">
        <button>Retourner à la liste</button>
    </a>
</p>

<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'templates/base.php';
