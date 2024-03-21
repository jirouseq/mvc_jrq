<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>[~profile~]</h1>
                <button class="btn btn-sm btn-outline-secondary align-self-center">[~delete~] [~profile~]</button>
            </div>
            <div class="card-body">
                <form id="formProfile">
                    <div class="mb-3">
                        <label for="username">[~name~]:</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $username ?>" required>
                        <div class="invalid-feedback">
                            [~message_username_empty~] Min 2 [~chars~]
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail">email:</label>
                        <input type="email" name="userEmail" id="userEmail" class="form-control" value="<?= $userEmail ?>" required>
                        <div class="invalid-feedback">
                            [~message_email_empty~]
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <a class="btn btn-sm btn-outline-secondary" id="profileChangePasswordBtn">změnit heslo</a>
                    </div>
                    <div class="d-none" id="profileChangePassword">
                        <div class="mb-3">
                            <label for="password">[~password~]:</label>
                            <input type="password" name="password" id="password" class="form-control" minlength="8">
                            <div class="invalid-feedback">
                                [~message_password_empty~] Min 8 [~chars~]
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="passwordAgain">[~password_again~]:</label>
                            <input type="password" name="passwordAgain" id="passwordAgain" class="form-control" minlength="8">
                            <div class="invalid-feedback">
                                [~password-not-match~]
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">[~save~]</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>