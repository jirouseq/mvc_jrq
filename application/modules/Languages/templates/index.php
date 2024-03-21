<a nohref class="nav-link link-light dropdown-toggle" data-bs-auto-close="outside" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?= URL ?>/public/images/sys/<?= $_SESSION['language']['code'] ?>.png" alt="" class="me-2" /><?= $data['languages'][$data['active']] ?></a>
<ul class="dropdown-menu dropdown-menu-end">
    <?php foreach ($data['languages'] as $code => $name) : ?>
        <?php if ($code !== $data['active']) : ?>
            <li><a href="<?= $this->link->get('home', 'homepage', null, $code) ?>" class="dropdown-item link-secondary"><img src="<?= URL ?>/public/images/sys/<?= $code ?>.png" alt="" class="me-2" /><?= $name ?></a></li>
        <?php endif ?>
    <?php endforeach; ?>
</ul>