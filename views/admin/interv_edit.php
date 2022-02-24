<?php
$title = 'Modifier une intervention';
ob_start(); ?>
<h1>Modifier l'intervention <?= $interv['id'] ?></h1>

<form method="post" action="#" id="form-edit">
    <label>Client</label>
    <input name="client" type="text" value="<?= $interv['client'] ?>" disabled />

    <?php // modifier date et heure
    if ($interv['e_id'] < 3) : ?>
        <div>
            <label>Date</label>
            <input onchange="submitForm()" type="date" name="date" id="date" value="<?= $date ?>" />
            <?php // si la date est choisie, afficher l'heure
            if ($date != "0000-00-00") : ?>
                <select onchange="submitForm()" name="heure" id="heure">
                    <option value=""></option>
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
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php // modifier le technicien si l'intervention est déjà affectée
    if ($interv['e_id'] == 2) : ?>
        <div>
            <label>Techicien</label>
            <select onchange="submitForm()" name="matricule">
                <option value=""></option>

                <?php foreach ($all_tech as $tech) : ?>

                    <?php // par défaut, afficher le technicien déjà affecté
                    if ($tech['matricule'] == $interv['matricule']) : ?>
                        <option selected value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>

                    <?php else : ?>
                        <option value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>

                    <?php endif; ?>

                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

</form>

<p>
    <a href="<?= $index_admin ?>/intervention?id=<?= $interv['id'] ?>">
        <button>Retourner sur la fiche</button>
    </a>
</p>

<script>
    function submitForm() {
        document.getElementById('form-edit').submit();
    }
</script>

<?php
$content = ob_get_clean();
require_once 'templates/base.php';
