<!DOCTYPE html>
<html lang="<?= $_SESSION['language']['code'];  ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->modules->get('descriptionPage', []) ?>
    <?= $this->modules->get('keywordsPage', []) ?>
    <?= $this->modules->get('CSSBlockAdmin', []) ?>
    <?= $this->modules->get('TitlePage', []) ?>
</head>

<body>
    <?= $this->modules->get('headerAdmin', []) ?>
    <?= $this->modules->get('alerts', []) ?>
    <?= $this->modules->get('mainAdmin', []) ?>
    <?= $this->modules->get('footerAdmin', []) ?>
    <?= $this->modules->get('JSBlockAdmin', []) ?>
</body>

</html>