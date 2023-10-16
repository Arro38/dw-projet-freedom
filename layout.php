<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>

<body>
    <h1><?= $titre ?></h1>
    <div style="display:flex; justify-content:space-around;">
        <div>
            <h2>Contenu</h2>
            <?= $contenu ?>
        </div>
        <div>
            <h2>Ajouter en amis</h2>
            <?php if (isset($contenu_friend)) echo $contenu_friend ?>
        </div>
    </div>
</body>

</html>