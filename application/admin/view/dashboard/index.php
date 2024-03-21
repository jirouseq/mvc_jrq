<h1>Dashboard</h1>
<div class="row mb-3 g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>[~users~]</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        [~number~]
                        <span class="badge text-bg-primary rounded-pill"><?= $data['users']['number'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        [~active~]
                        <span class="badge text-bg-primary rounded-pill"><?= $data['users']['active'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        [~banned~]
                        <span class="badge text-bg-primary rounded-pill"><?= $data['users']['banned'] ?></span>
                    </li>
                </ul>
            </div>
            <div class="card-footer border-0 bg-white">
                <a href="<?= $this->link->get('admin', 'users', null, null) ?>" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">[~view~]</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>[~pages~]</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        [~number~]
                        <span class="badge text-bg-primary rounded-pill"><?= $data['pages']['number'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        [~published~]
                        <span class="badge text-bg-primary rounded-pill"><?= $data['pages']['published'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        [~no-published~]
                        <span class="badge text-bg-primary rounded-pill"><?= $data['pages']['no-published'] ?></span>
                    </li>
                </ul>
            </div>
            <div class="card-footer border-0 bg-white">
                <a href="<?= $this->link->get('admin', 'pages', null, null) ?>" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">[~view~]</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3 g-3 justify-content-between technologies">
    <div class="col-auto">
        <div class="card">
            <div class="card-body">
                <i class="bi bi-filetype-html"></i>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="card">
            <div class="card-body">
                <i class="bi bi-filetype-css"></i>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="card">
            <div class="card-body">
                <i class="bi bi-bootstrap"></i>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="card">
            <div class="card-body">
                <i class="bi bi-filetype-php"></i>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="card">
            <div class="card-body">
                <i class="bi bi-filetype-sql"></i>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="card">
            <div class="card-body">
                <i class="bi bi-filetype-js"></i>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="card">
            <div class="card-body">
                <i class="bi bi-filetype-sql"></i>
            </div>
        </div>
    </div>
</div>