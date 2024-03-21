<?php if (isset($_SESSION['user']['uid_authentication_user']) && is_int($_SESSION['user']['uid_authentication_user'])) : ?>
    <a class="nav-link dropdown-toggle link-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span><?= $_SESSION['user']['username'] ?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <?php if ($data['environment'] === 'home') : ?>
            <?php if ($_SESSION['user']['role'] === 'user') : ?>
                <li><a class="dropdown-item link-secondary" href="<?= $this->link->get('home', 'profile', null, null) ?>">[~profile~]</a></li>
            <?php else : ?>
                <li><a class="dropdown-item link-secondary" href="<?= $this->link->get('home', 'profile', null, null) ?>">[~profile~]</a></li>
                <li><a class="dropdown-item link-secondary" href="<?= $this->link->get('admin', 'dashboard', null, null) ?>">[~administration~]</a></li>
            <?php endif; ?>
            <li><a class="dropdown-item link-secondary" href="<?= $this->link->get('home', 'logout', 'logout', null) ?>" id="logoutUser">[~logout~]</a></li>
        <?php elseif ($data['environment'] === 'admin') : ?>
            <li><a class="dropdown-item link-secondary" href="<?= $this->link->get('home', 'logout', 'logout', null) ?>" id="logoutUser">[~logout~]</a></li>
        <?php endif; ?>
    </ul>
<?php else : ?>
    <a class="nav-link link-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item link-secondary" href="<?= $this->link->get('home', 'login', null, null) ?>"><i class="bi bi-box-arrow-in-right me-2"></i>[~login~]</a></li>
        <li><a class="dropdown-item link-secondary" href="<?= $this->link->get('home', 'registration', null, null) ?>"><i class="bi bi-person-fill-add me-2"></i>[~registration~]</a></li>
    </ul>
<?php endif ?>