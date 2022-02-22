<?php
$title = 'Modifier une intervention';
ob_start(); ?>
<h1>Modifier l'intervention <?= $interv['id'] ?></h1>

<label>Client</label>
<input type="text" value="<?=$interv['client']?>" disabled />

<?php // modifier date et heure si l'intervention n'est pas clôturée
if ($interv['e_id'] < 3) : ?>
    <div>
        <label>Date</label>
        <input type="date" name="date" value="<?=$date?>"/>
    </div>
    <div>
        <label>Heure</label>
        <select name="heure">
            <option value=""></option>
            <?php foreach ($creneaux as $creneau) : ?>

                <?php // garder affiché le technicien selectionné
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
    </div>
<?php endif; ?>

<?php // modifier technicien si l'intervention est affectée mais pas encore clôturée
if ($interv['e_id'] == 2) : ?>
    <div>
        <label>Techicien</label>
        <select name="technicien">
            <option value=""></option>

            <?php foreach ($all_tech as $tech) : ?>

                <?php // garder affiché le technicien selectionné
                if ($tech['matricule'] == $interv['matricule']) : ?>
                    <option selected value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>

                <?php else : ?>
                    <option value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>

                <?php endif; ?>

            <?php endforeach; ?>
        </select>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();
require_once 'templates/base.php';
