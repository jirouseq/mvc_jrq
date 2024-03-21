<div class="container" id="pageParent">
    <div class="row d-flex align-items-center justify-content-between bg-light p-3 my-3">
        <input type="hidden" class="form-control" value="<?= $this->link->get('admin', 'pages', 'edit', null) . $data['data'][$this->session->get('language', 'code')]['group_id'] . '/' ?>" id="linkEdit">
        <div class="col-auto">
            <div class="d-inline-flex align-items-center">
                <label for="pageAuthor" class="col-form-label me-3">[~author~]:</label>
                <input type="text" class="form-control" name="authorName" value="<?= $this->session->get('user', 'username') ?>" id="pageAuthor" readonly>
            </div>
        </div>
        <div class="col-auto">
            <a href="<?= $this->link->get('admin', 'pages', null, null) ?>" class="btn btn-sm btn-outline-primary">[~finish_editing~]</a>
            <button class="btn btn-sm btn-outline-danger" id="deletePage">[~delete~]</button>
        </div>
    </div>
    <div class="row">
        <ul class="nav nav-tabs nav-tabs-pages">
            <?php foreach ($data['languages'] as $code => $name) : ?>
                <?php if ($code === $this->session->get('language', 'code')) : ?>
                    <li class="nav-item">
                        <a class="nav-link language-form-link active" href="#" data-code="<?= $code ?>"><?= $name ?></a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link language-form-link" href="#" data-code="<?= $code ?>"><?= $name ?></a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
        <div class="col-12 border border-top-0 p-3" id="pageContent">

            <?php foreach ($data['languages'] as $code => $name) : ?>
                <form method="post" id="formPage" data-version="<?= $code ?>" class="<?= $code !== $this->session->get('language', 'code') ? 'd-none' : 'active' ?>">
                    <input type="hidden" name="idPage" id="idPage" value="<?= $data['data'][$code]['id'] ?>">
                    <input type="hidden" name="group_id" id="groupId" value="<?= $data['data'][$code]['group_id'] ?>">
                    <div class="row flex-column my-3">
                        <div class="col my-3">
                            <input type="text" class="form-control" name="title" value="<?= $data['data'][$code]['title'] ?>" placeholder="[~title~]">
                        </div>
                        <div class="col my-3">
                            <input type="text" class="form-control" name="heading" value="<?= $data['data'][$code]['heading'] ?>" placeholder="[~heading~]">
                        </div>
                        <div class="col my-3">
                            <textarea type="text" class="form-control textEditor" name="text" placeholder=""><?= $data['data'][$code]['text'] ?></textarea>
                        </div>
                        <div class="col my-3">
                            <textarea type="text" class="form-control" name="description" placeholder="[~description~]"><?= $data['data'][$code]['description'] ?></textarea>
                        </div>
                        <div class="col my-3">
                            <textarea type="text" class="form-control" name="keywords" placeholder="[~keywords~]"><?= $data['data'][$code]['keywords'] ?></textarea>
                        </div>
                    </div>
                </form>
            <?php endforeach ?>

        </div>
    </div>
</div>