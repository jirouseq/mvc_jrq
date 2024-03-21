<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h1>[~registration~]</h1>
            </div>
            <div class="card-body">
                <form action="<?= $this->link->get('home', 'registration', 'add', null) ?>" method="POST" class="needs-validation" id="formRegistration" novalidate>
                    <input type="text" class="form-nickname" name="nickname" id="nickname" placeholder="Your nickname" autocomplete="off" tabindex="-1">
                    <div class="mb-3">
                        <label for="username">[~name~]:</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <div class="invalid-feedback">
                            [~message_username_empty~] Min 2 [~chars~]
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail">email:</label>
                        <input type="email" name="userEmail" id="userEmail" class="form-control" required>
                        <div class="invalid-feedback">
                            [~message_email_empty~]
                        </div>
                    </div>
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
                        <button type="submit" class="btn btn-primary">[~register~]</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <ul class="list-inline text-center">
                    <li class="list-inline-item"><a href="<?= $this->link->get('home', 'login', null, null) ?>"><small>[~login~]</small></a></li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item"><a href="<?= $this->link->get('home', 'forgottenPassword', null, null) ?>"><small>[~forgotten-password~]</small></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>