<?php if (isset($data['numPages']) && $data['numPages'] > 0) : ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link <?= $data['page'] == 1 ? 'disabled' : "" ?>" href="<?= $data['url'] . ($data['page'] - 1) ?>" data-page="<?= ($data['page'] - 1) ?>">[~previous~]</a></li>
            <?php for ($i = 1; $i < $data['numPages'] + 1; $i++) : ?>
                <?php if ($i == $data['page']) : ?>
                    <li class="page-item"><a class="page-link <?= $data['numPages'] > 1 ? 'active' : '' ?>" href="<?= $data['url'] . $i ?>" data-page="<?= $i ?>"><?= $i ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="<?= $data['url'] . $i ?>" data-page="<?= $i ?>"><?= $i ?></a></li>
                <?php endif ?>
            <?php endfor ?>
            <li class="page-item"><a class="page-link <?= $data['page'] == $data['numPages'] ? 'disabled' : '' ?>" href="<?= $data['url'] . ($data['page'] + 1) ?>" data-page="<?= ($data['page'] + 1) ?>">[~next~]</a></li>
        </ul>
    </nav>
<?php endif ?>