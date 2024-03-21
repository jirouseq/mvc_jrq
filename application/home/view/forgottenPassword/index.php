<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h1>[~forgotten-password~]</h1>
            </div>
            <div class="card-body">
                <form action="<?= $this->link->get('home', 'forgottenPassword', 'sendToken', null) ?>" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="userEmail">email:</label>
                        <input type="email" name="userEmail" id="userEmail" class="form-control" required>
                        <div class="invalid-feedback">
                            [~message_email_empty~]
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">[~reset-password~]</button>
                    </div>

                </form>
            </div>
            <div class="card-footer text-center">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?= $this->link->get('home', 'login', null, null) ?>"><small>[~login~]</small></a></li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item"><a href="<?= $this->link->get('home', 'registration', null, null) ?>"><small>[~registration~]</small></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>