<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h1>[~forgotten-password~]</h1>
            </div>
            <div class="card-body">
                <form action="<?= $this->link->get('home', 'registration', 'restore', null) ?>" method="POST" class="needs-validation" id="formRestorePassword" novalidate>
                    <input type="hidden" name="idUser" value="<?= $data['id_user'] ?>">
                    <div class="mb-3">
                        <label for="password">[~password~]:</label>
                        <input type="password" name="password" id="password" class="form-control" minlength="8" required>
                        <div class="invalid-feedback">
                            [~message_password_empty~] Min 8 [~chars~]
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordAgain">[~password_again~]:</label>
                        <input type="password" name="passwordAgain" id="passwordAgain" class="form-control" minlength="8" required>
                        <div class="invalid-feedback">
                            [~password-not-match~]
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">[~restore~]</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>