<div class="container-fluid px-4">
    <div class="mt-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/manager/index">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách thương hiệu</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách thương hiệu
        </div>
        <div class="card-body">
            <div id="add" class="mb-3">
                <button class="btn btn-info">Thêm thương hiệu</button>
            </div>
            <table class="table table-bordered" id="brand">
                <thead class="table-warning">
                    <tr class="text-center">
                        <th>ID thương hiệu</th>
                        <th>Tên thương hiệu</th>
                        <th>Logo thương hiệu</th>
                        <th>Tác Vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($brr as $v) : ?>
                        <tr v="<?= $v['BrandId'] ?>" class="text-center">
                            <td><?= $v['BrandId'] ?></td>
                            <td><?= $v['BrandName'] ?></td>
                            <td><img width="100px" height="100px" class="img-thumbnail" src="/Web_HaiTrieu/public/images/brand/<?= $v['LogoUrl'] ?>" alt=""></td>
                            <td>
                                <button class="update btn btn-primary">Cập nhật</button>
                                <button class="del btn btn-danger">Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end me-3">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="/Web_HaiTrieu/brand/index/?page=<?= $page - 1 ?>" aria-label="Previous" id="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <li class="page-item" id="page"><a class="page-link" href="/Web_HaiTrieu/brand/index/?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor ?>
                <li class="page-item">
                    <a class="page-link" href="/Web_HaiTrieu/brand/index/?page=<?= $page + 1 ?>" aria-label="Next" id="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Modal Add Brand -->
    <div class="modal" tabindex="-1" id="modalAdd">
        <div class="modal-dialog">
            <form class="modal-content" enctype="multipart/form-data" action="/Web_HaiTrieu/brand/add/" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm thương hiệu</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Tên thương hiệu <span class="text-danger">(*)</span></label>
                    <input class="form-control" type="text" name="name" required>
                    <label class="form-label" for="">Logo thương hiệu <span class="text-danger">(*)</span></label><br>
                    <input class="form-control" type="file" name="f" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
    <!--End Modal Add Brand-->

    <!-- Modal Edit Brand -->
    <div class="modal" tabindex="-1" id="modalEdit">
        <div class="modal-dialog">
            <form class="modal-content" enctype="multipart/form-data" action="/Web_HaiTrieu/brand/edit" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Cập nhật thương hiệu</h5>
                    <button type="button" class="close btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <label class="form-label">Tên thương hiệu <span class="text-danger">(*)</span></label>
                    <input class="form-control" type="text" name="name" required>
                    <label class="form-label" for="">Logo thương hiệu <span class="text-danger">(*)</span></label><br>
                    <img width="100px" src="" class="img-thumbnail">
                    <input class="form-control" type="hidden" name="logoUrl" value="">
                    <input class="form-control" type="file" name="f">
                </div>
                <div class="modal-footer">
                    <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
    <!--End Modal Edit Brand-->

    <!-- Modal Delete Brand -->
    <div class="modal" tabindex="-1" id="modalDelete">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bạn có muốn xóa thương hiệu này không?</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="error text-danger d-flex justify-content-center"></div>
                <div class="modal-body">
                    <label class="form-label">Tên thương hiệu</label>
                    <input class="form-control" type="text" name="name" disabled>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="confirmDel btn btn-primary">Xóa</button>
                </div>
            </form>
        </div>
    </div>
    <!--End Modal Delete Brand-->
</div>

<script src="/Web_HaiTrieu/assets/js/manager/pagination.js"></script>

<script>
    let active = <?= $page - 1 ?>;
    let numPage = <?= $page ?>;
    let pages = <?= $pages ?>;
    pagination(active, numPage, pages);
</script>

<!-- Brand Proccess -->
<script src="/Web_HaiTrieu/assets/js/manager/brand.js"></script>