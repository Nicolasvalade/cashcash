<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= $domaine ?>/styles/base.css" rel="stylesheet">
    <title><?= $title ?></title>
</head>

<body>
    <nav>
        <a href="<?= $index ?>">Accueil</a>
        <a href="<?= $index ?>/interventions">Interventions</a>
    </nav>
    <?= $content ?>
</body>

</html>