<?php if (!empty($data['data'])) : ?>
    <tbody>
        <?php foreach ($data['data'] as $user) : ?>
            <tr id="<?= $user['id'] ?>">
                <td class="px-3"><a href="mailto:<?= $user['userEmail'] ?>"><?= $user['userEmail'] ?></a></td>
                <td class="px-3"><?= $user['username'] ?></td>
                <td class="px-3 text-center">
                    <?php if ($user['active']) : ?>
                        <span class="badge bg-success">[~yes~]</span>
                    <?php else : ?>
                        <span class="badge bg-secondary">[~no~]</span>
                    <?php endif ?>
                </td>
                <td class="px-3">
                    <div class="form-check form-switch switch-danger d-flex justify-content-center">
                        <input class="form-check-input switch-ban" type="checkbox" role="switch" name="banned" <?= $user['banned'] === 1 ? 'checked' : '' ?>>
                    </div>
                </td>
                <td class="px-3">
                    <select class="form-select select-role" data-style="btn-white border text-dark" data-width="100%" name="role">
                        <?php foreach ($data['roles'] as $role) : ?>
                            <option value="<?= $role['role'] ?>" <?= $user['role'] === $role['role'] ? 'selected' : '' ?>><?= $role['role'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
                <td class="text-center px-3"><?php echo date("j.n.Y", strtotime($user['createDate'])); ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
                <?= $this->modules->get('pagination', $data['pagination']) ?>
            </td>
        </tr>
    </tfoot>
<?php else : ?>
    <tbody>
        <tr>
            <td colspan="6" class="text-center">[~nothing_found~]</td>
        </tr>
    </tbody>
    <tfoot></tfoot>
<?php endif ?>