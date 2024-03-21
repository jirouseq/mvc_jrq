<!DOCTYPE html>
<html lang="<?= $this->modules->get('langTag', []) ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= $this->modules->get('descriptionPage', []) ?>
    <?= $this->modules->get('keywordsPage', []) ?>
    <?= $this->modules->get('CSSBlockHome', []) ?>
    <?= $this->modules->get('TitlePage', []) ?>
</head>

<body class="body">
    <?= $this->modules->get('headerHome', []) ?>
    <?= $this->modules->get('alerts', []) ?>
    <?= $this->modules->get('mainHome', []) ?>
    <?= $this->modules->get('footerHome', []) ?>
    <?= $this->modules->get('JSBlockHome', []) ?>
</body>

</html>