<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h1>[~login~]</h1>
            </div>
            <div class="card-body">
                <form id="mb-3 formLogin" action="<?= $this->link->get('home', 'login', 'login', null) ?>" method="POST">
                    <?php if (isset($data['message'])) : ?>
                        <div class="text-danger"><?= $data['message'] ?>!</div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="userEmail">email:</label>
                        <input type="email" name="userEmail" id="userEmail" class="form-control" value="<?= isset($data['userEmail']) ? $data['userEmail'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password">[~password~]:</label>
                        <input type="password" name="password" id="password" class="form-control" minlength="1">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">[~login~]</button>
                    </div>

                </form>
            </div>
            <div class="card-footer text-center">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?= $this->link->get('home', 'registration', null, null) ?>"><small>[~registration~]</small></a></li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item"><a href="<?= $this->link->get('home', 'forgottenPassword', null, null) ?>"><small>[~forgotten-password~]</small></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>