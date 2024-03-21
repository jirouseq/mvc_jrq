<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $this->link->get('home', 'homepage', null, null) ?>"><img src="<?= URL . 'public/images/image/image/logo-1487245_640.png' ?>" alt="logo" style="width: 100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach ($data as $menuItem) : ?>
                    <li class="nav-item">
                        <a class="nav-link link-light" aria-current="page" href="<?= URL . $this->session->get('language', 'code') . DS . $menuItem['url']; ?>"><?= $menuItem['title']; ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
            <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?= $this->modules->get('writeUs', []); ?>
                </li>
                <li class="nav-item dropdown">
                    <?= $this->modules->get('languages', []); ?>
                </li>
                <li class="nav-item dropdown">
                    <?= $this->modules->get('user', ['environment' => 'home']); ?>
                </li>
            </ul>
        </div>
    </div>
</nav>