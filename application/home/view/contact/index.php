<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h1>[~contact-form~]</h1>
            </div>
            <div class="card-body">
                <form action="<?= $this->link->get('home', 'contactForm', 'send', null) ?>" method="POST" class="needs-validation" id="formContact" novalidate>
                    <input type="text" class="form-nickname" name="nickname" id="nickname" placeholder="Your nickname" autocomplete="off" tabindex="-1">
                    <div class="mb-3">
                        <label for="subject">[~subject_message~]:</label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                        <div class="invalid-feedback">
                            [~input-empty~]
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="body">[~text_message~]:</label>
                        <textarea name="body" id="body" cols="30" rows="10" class="form-control" required></textarea>
                        <div class="invalid-feedback">
                            [~input-empty~]
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">[~your-e-mail~]:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">
                            [~message_email_empty~]
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">[~send~]</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>