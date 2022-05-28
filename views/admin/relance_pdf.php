<style>
    #client {
        position: absolute;
        right: 100px;
    }

    #contenu {
        position: absolute;
        top: 200px;
    }

    .contrat {
        padding-bottom: 50px;
    }

    #signature {
        text-align: right;
    }
</style>
<!-- <p>Client : <?= var_dump($client) ?></p>
<p>Agence : <?= var_dump($agence) ?></p>
<p>Materiels : <?= var_dump($lignes) ?></p> -->

<div>
    <?= "$agence[nom]" ?><br />
    <?= "$agence[adresse]" ?><br />
    <?= "$agence[code_postal] $agence[ville]" ?><br />
    <?= "$agence[pays]" ?><br />
</div>

<div id="client">
    <?= "$client[raison_sociale]" ?><br />
    <?= "$client[adresse]" ?><br />
    <?= "$client[code_postal] $client[ville]" ?><br />
    <?= "$client[pays]" ?><br />
</div>

<div id="contenu">
    <?php // s'il y a des contrats, afficher la liste
    if ($contrats) : ?>

        <p>Madame, Monsieur,</p>
        <p>Un ou plusieurs contrats de maintenance que vous aviez souscrits chez nous arrivent bientôt à expiration.<br />
            Merci de bien vouloir prendre contact au plus vite avec votre agence Cashcash
            (<?= strtolower("$gestionnaire[prenom].$gestionnaire[nom]@cashcash.fr") ?>)
            afin de renouveler celui-ci, sans quoi vous risquez de perdre votre couverture.<br />
            Nous vous remercions de nous faire confiance et espérons vous revoir bientôt.</p>
        <p id="signature">Votre gestionnaire,<br />
            <?= "$gestionnaire[prenom] $gestionnaire[nom]" ?></p>

        <p>Vos contrats arrivant à expiration :</p>
        <ul>
            <?php foreach ($contrats as $id_contrat => $materiels) : ?>
                <div class="contrat" id="contrat-<?= $id_contrat ?>">
                    <?= "Contrat N° $id_contrat" ?><br />
                    <?= "Echéance : " . $materiels[0]['date_echeance']->format("d/m/Y") ?><br />
                    <?= "Il vous reste " . $materiels[0]['jours_restants'] . " jours."; ?><br /><br />
                    <?php foreach ($materiels as $materiel) : ?>
                        <li>N° serie : <?= "$materiel[n_serie]" ?>
                            <ul>
                                <li>Matériel : <?= "$materiel[type]" ?></li>
                                <li>Emplacement : <?= "$materiel[emplacement]" ?></li>
                            </ul>
                        </li>
                    <?php endforeach; ?>

                </div>
            <?php endforeach; ?>
        </ul>

    <?php else : ?>
        <p>Pas de relance à faire.</p>
    <?php endif; ?>
</div>