<div class="row justify-content-center">
    <div class="col-lg-6">
        <ul class="list-group" id="sortableMenu">
            <?php foreach ($data as $item) : ?>
                <li class="list-group-item d-flex justify-content-between" data-id="<?= $item['group_id'] ?>"><span><?= $item['title'] ?></span><i class="bi bi-arrows-expand"></i></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>