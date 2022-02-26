<?php
$title = 'Modifier une intervention';
ob_start(); ?>
<h1>Modifier l'intervention <?= $interv['id'] ?></h1>

<?php if ($erreur) : ?>
    <p><?= $erreur ?></p>
<?php endif; ?>

<form method="POST" action="?id=<?= $interv['id'] ?>" id="form-edit">
    <p>
        <label>Client</label>
        <input name="client" type="text" value="<?= $interv['client'] ?>" disabled />
    </p>

    <?php // modifier date et heure
    if ($interv['e_id'] < 3) : ?>
        <p>
            <label>Date</label>
            <input type="date" name="date" id="date" value="<?= $date ?>" />
            <select name="heure" id="heure">
                <?php foreach ($creneaux as $creneau) : ?>

                    <?php // par défaut, afficher l'heure précédemment prévue
                    if ($creneau['value'] == $heure) : ?>
                        <option selected value="<?= $creneau['value'] ?>">
                            <?= $creneau['label'] ?>
                        </option>

                    <?php else : ?>
                        <option value="<?= $creneau['value'] ?>">
                            <?= $creneau['label'] ?>
                        </option>

                    <?php endif; ?>

                <?php endforeach; ?>
            </select>
        </p>
    <?php endif; ?>

    <?php // modifier le technicien si l'intervention est déjà affectée
    if ($interv['e_id'] == 2) : ?>
        <p>
            <label>Techicien</label>
            <select name="matricule" id="matricule">
                <?php foreach ($all_tech as $tech) : ?>

                    <?php // par défaut, afficher le technicien déjà affecté
                    if ($tech['matricule'] == $interv['matricule']) : ?>
                        <option selected value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>

                    <?php else : ?>
                        <option value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>

                    <?php endif; ?>

                <?php endforeach; ?>
            </select>
        </p>
    <?php endif; ?>

    <?php // s'il y a déjà des matériels dans l'intervention, afficher la liste
    if ($mat_concernes) : ?>
        <p>Matériels concernés</p>
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

                <?php foreach ($mat_concernes as $mat) : ?>
                    <tr>
                        <td><input checked type="checkbox" name="materiels[<?= "$mat[n_serie]" ?>]" /></td>
                        <td><?= "$mat[n_serie]" ?></td>
                        <td><?= "$mat[emplacement]" ?></td>
                        <td><?= "$mat[type]" ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    <?php else : ?>
        <p>Aucun matériel concerné pour le moment.</p>

    <?php endif; ?>


    <?php // montrer la liste des matériels éligibles
    if ($mat_eligibles) : ?>
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
        <p>Le client n'a pas de matériel ou tous les matériels sont déjà concernés.</p>

    <?php endif; ?>


    <p><button type="submit">Enregistrer</button></p>
</form>


<p>
    <a href="<?= $index_admin ?>/intervention?id=<?= $interv['id'] ?>">
        <button>Retourner sur la fiche</button>
    </a>
</p>
<?php
$content = ob_get_clean();
require_once 'templates/base.php';
