<style>
    td,
    th {
        padding: 5px 5px;
        font-size: 12px;
    }

    table {
        border-collapse: collapse;
    }

    tr {
        border: 1px solid black;
    }
</style>
<h1>Intervention <?= $interv['id'] ?></h1>
<p>Client : <?= $interv['client'] ?></p>
<p>Planifiée le : <?= date_locale($interv['date_heure']) ?> <?= heure_courte($interv['date_heure']) ?></p>
<p>Etat : <?= $interv['e_libelle'] ?></p>
<p>Affectée à : <?= $interv['t_prenom'] . ' ' . $interv['t_nom'] ?></p>
<?php // s'il y a des matériels, afficher la liste
if ($all_mat) : ?>
    <ul>
        <?php foreach ($all_mat as $mat) : ?>
            <li>N° serie : <?= "$mat[n_serie]" ?>
                <ul>
                    <li>Matériel : <?= "$mat[type]" ?></li>
                    <li>Emplacement : <?= "$mat[emplacement]" ?></li>
                    <?php if ($interv['e_id'] == 3) : ?>
                        <li>Commentaire : <?= "$mat[commentaire]" ?></li>
                        <li>Temps passé : <?= "$mat[temps_passe]" ?></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun matériel</p>
<?php endif; ?>