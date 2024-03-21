<div class="container">
    <div class="row d-flex align-items-center justify-content-between bg-light p-3 mt-3">
        <div class="col-auto">
            <select name="" id="perPage" class="form-select" aria-label=".form-select-lg example">
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col-auto">
            <input type="search" class="form-control" placeholder="[~search~]" id="searchData">
        </div>
    </div>
    <div class="row my-3">
        <table class="table table-bordered table-admin">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="px-3" data-col-name="userEmail">
                        <div class="d-flex align-items-center justify-content-between"><span>email</span><span class="d-flex flex-column"><i class="bi bi-caret-up-fill btn btn-sm p-0 border-0 icon-sort" data-order="ASC"></i><i class="bi bi-caret-down-fill btn btn-sm p-0 border-0 icon-sort" data-order="DESC"></i></span></div>
                    </th>
                    <th scope="col" class="px-3" data-col-name="username">
                        <div class="d-flex align-items-center justify-content-between"><span>[~name~]</span><span class="d-flex flex-column"><i class="bi bi-caret-up-fill btn btn-sm p-0 border-0 icon-sort" data-order="ASC"></i><i class="bi bi-caret-down-fill btn btn-sm p-0 border-0 icon-sort" data-order="DESC"></i></span></div>
                    </th>
                    <th scope="col" class="px-3" data-col-name="active">
                        <div class="d-flex align-items-center justify-content-between"><span>[~active~]</span><span class="d-flex flex-column"><i class="bi bi-caret-up-fill btn btn-sm p-0 border-0 icon-sort" data-order="ASC"></i><i class="bi bi-caret-down-fill btn btn-sm p-0 border-0 icon-sort" data-order="DESC"></i></span></div>
                    </th>
                    <th scope="col" class="px-3" data-col-name="banned">
                        <div class="d-flex align-items-center justify-content-between"><span>[~banned~]</span><span class="d-flex flex-column"><i class="bi bi-caret-up-fill btn btn-sm p-0 border-0 icon-sort" data-order="ASC"></i><i class="bi bi-caret-down-fill btn btn-sm p-0 border-0 icon-sort" data-order="DESC"></i></span></div>
                    </th>
                    <th scope="col" class="px-3" data-col-name="role">
                        <div class="d-flex align-items-center justify-content-between"><span>[~roles~]</span><span class="d-flex flex-column"><i class="bi bi-caret-up-fill btn btn-sm p-0 border-0 icon-sort" data-order="ASC"></i><i class="bi bi-caret-down-fill btn btn-sm p-0 border-0 icon-sort" data-order="DESC"></i></span></div>
                    </th>
                    <th scope="col" class="text-center" data-col-name="createDate">
                        <div class="d-flex align-items-center justify-content-between"><span>[~create_date~]</span><span class="d-flex flex-column"><i class="bi bi-caret-up-fill btn btn-sm p-0 border-0 icon-sort" data-order="ASC"></i><i class="bi bi-caret-down-fill btn btn-sm p-0 border-0 icon-sort" data-order="DESC"></i></span></div>
                    </th>
                </tr>
            </thead>
            <?= $data['list'] ?>
        </table>
    </div>
    <div class="row">
        <?= $this->modules->get('pagination', $data['pagination']) ?>
    </div>
</div>