<div class="container-fluid px-4">
    <div class="mt-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/manager/index">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách danh mục</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách danh mục sản phẩm
        </div>
        <div class="card-body">
            <div id="add" class="mb-3">
                <button class="btn btn-info">Thêm danh mục</button>
            </div>
            <table id="table" class="table table-bordered">
                <thead class="table-warning">
                    <tr class="text-center">
                        <th>ID Danh Mục</th>
                        <th>Tên Danh Mục</th>
                        <th>Mô Tả</th>
                        <th>Đường dẫn danh mục</th>
                        <th>Tác Vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($crr as $v) : ?>
                        <tr v="<?= $v['CategoryId'] ?>">
                            <td class="text-center"><?= $v['CategoryId'] ?></td>
                            <td><?= $v['CategoryName'] ?></td>
                            <td><?= $v['Description'] ?></td>
                            <td><?= $v['CategoryUrl'] ?></td>
                            <td class="text-center">
                                <button class="edit btn btn-primary">Cập nhật</button>
                                <button class="del btn btn-danger">Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Add Category -->
    <div class="modal" tabindex="-1" id="modalAdd">
        <div class="modal-dialog">
            <form class="modal-content" action="/Web_HaiTrieu/category/add" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Tên danh mục <span class="text-danger">(*)</span></label>
                    <input class="form-control" type="text" name="name" required>
                    <label class="form-label">Mô tả</label>
                    <textarea class="form-control" type="text" name="desc" id="desc"></textarea>
                    <label class="form-label">Đường dẫn thư mục <span class="text-danger">(*)</span></label>
                    <input class="form-control" type="text" name="categoryUrl" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
    <!--End Modal Add Category-->

    <!-- Modal Edit Category -->
    <div class="modal" tabindex="-1" id="modalEdit">
        <div class="modal-dialog">
            <form class="modal-content" action="/Web_HaiTrieu/category/edit" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Cập nhật danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <label class="form-label">Tên danh mục <span class="text-danger">(*)</span></label>
                    <input class="form-control" type="text" name="name" required>
                    <label class="form-label">Mô tả</label>
                    <textarea class="form-control" type="text" name="desc" id="desc"></textarea>
                    <label class="form-label" for="">Đường dẫn danh mục <span class="text-danger">(*)</span></label>
                    <input class="form-control" type="text" name="categoryUrl">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
    <!--End Modal Edit Category-->

    <!-- Modal Delete Category -->
    <div class="modal" tabindex="-1" id="modalDel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bạn có chắc chắn muốn xóa?</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="error text-danger d-flex justify-content-center"></div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <label class="form-label">Tên danh mục</label>
                    <input class="form-control" type="text" name="name" readonly>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button class="confirmDel btn btn-primary">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal Delete Category-->
</div>

<!-- Category Proccess -->
<script src="/Web_HaiTrieu/assets/js/manager/category.js"></script>