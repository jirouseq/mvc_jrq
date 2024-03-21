<ul class="pagination">
    <li><a href="<?= $data['url'] . ($data['page'] - 1) ?>" class="<?= $data['page'] == 1 ? 'disabled' : "" ?>">[~previous~]</a></li>
    <?php for ($i = 1; $i < $data['numPages'] + 1; $i++) : ?>
        <?php if ($i == $data['page']) : ?>
            <li><a class="<?= $data['numPages'] > 1 ? 'active' : '' ?>" href="<?= $data['url'] . $i ?>"><?= $i ?></a></li>
        <?php else : ?>
            <li><a href="<?= $data['url'] . $i ?>"><?= $i ?></a></li>
        <?php endif ?>
    <?php endfor ?>
    <li><a href="<?= $data['url'] . ($data['page'] + 1) ?>" class="<?= $data['page'] == $data['numPages'] ? 'disabled' : '' ?>">[~next~]</a></li>
</ul>