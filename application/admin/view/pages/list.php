<?php if (!empty($data['data'])) : ?>
    <tbody>
        <?php foreach ($data['data'] as $page) : ?>
            <tr data-idpage="<?= $page['id'] ?>" data-groupid="<?= $page['group_id'] ?>">
                <td class="px-3"><?= $page['id'] ?></td>
                <td class="px-3"><?= $page['title'] ?></td>
                <td class="text-center px-3"><?php echo date("j.n.Y", strtotime($page['createDate'])); ?></td>
                <td class="px-3"><?= $page['authorName'] ?></td>
                <td class="px-3">
                    <div class="form-check form-switch switch-success d-flex justify-content-center">
                        <input class="form-check-input switch" type="checkbox" role="switch" name="published" <?= $page['published'] === 1 ? 'checked' : '' ?>>
                    </div>
                </td>
                <td class="px-3">
                    <div class="form-check form-switch switch-success d-flex justify-content-center">
                        <input class="form-check-input switch" type="checkbox" role="switch" name="menu" <?= $page['menu'] === 1 ? 'checked' : '' ?>>
                    </div>
                </td>
                <td class="px-3">
                    <div class="form-check form-switch switch-success d-flex justify-content-center">
                        <input class="form-check-input switch" type="checkbox" role="switch" name="homepage" <?= $page['homepage'] === 1 ? 'checked' : '' ?>>
                    </div>
                </td>
                <td class="text-center"><a href="<?= $this->link->get('admin', 'pages', 'edit', null) . $page['group_id'] . '/' ?>"><i class="bi bi-eye text-primary table-action-icon table-action-detail"></i></a></td>
                <td class="text-center"><a href="#" class="btn-delete-page"><i class="bi bi-trash text-secondary"></i></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9">
                <?= $this->modules->get('pagination', $data['pagination']) ?>
            </td>
        </tr>
    </tfoot>
<?php else : ?>
    <tbody>
        <tr>
            <td colspan="9" class="text-center">[~nothing_found~]</td>
        </tr>
    </tbody>
    <tfoot></tfoot>
<?php endif ?>