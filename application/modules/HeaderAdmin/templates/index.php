<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $this->link->get('admin', 'dashboard', null, null) ?>"><img src="<?= URL . 'public/images/image/image/logo-1487245_640.png' ?>" alt="logo" style="width: 100px"></a>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#canvasMenu" aria-controls="canvasMenu">
            menu
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <?= $this->modules->get('languages', []); ?>
                </li>
                <li class="nav-item dropdown">
                    <?= $this->modules->get('user', ['environment' => 'admin']); ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="offcanvas offcanvas-start" tabindex="-1" id="canvasMenu" aria-labelledby="canvasMenuLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="nav flex-column">
            <a class="nav-link link-secondary active" aria-current="page" href="<?= $this->link->get('home', 'homepage', null, null) ?>" target="_blank"><i class="bi bi-back me-2 text-secondary"></i>frontend</a>
            <a class="nav-link link-secondary" href="<?= $this->link->get('admin', 'users', null, null) ?>"><i class="bi bi-people-fill me-2 text-secondary"></i>[~users~]</a>
            <a class="nav-link link-secondary" href="<?= $this->link->get('admin', 'pages', null, null) ?>"><i class="bi bi-file-earmark-break-fill me-2 text-secondary"></i>[~pages~]</a>
            <a class="nav-link link-secondary" href="<?= $this->link->get('admin', 'settings', null, null) ?>"><i class="bi bi-gear-fill me-2 text-secondary"></i>[~settings~]</a>
        </nav>
    </div>
</div>