<div class="container-fluid px-4">
    <div class="mt-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/manager/index">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách sản phẩm
        </div>
        <div class="card-body">
            <div id="add" class="mb-3">
                <a class="btn btn-info" href="/Web_HaiTrieu/product/add">Thêm sản phẩm</a>
            </div>
            <table class="table table-bordered">
                <thead class="table-warning">
                    <tr>
                        <th>ID Sản Phẩm</th>
                        <th>Tên Danh Mục</th>
                        <th>Tên Thương Hiệu</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Mô Tả</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Hình Ảnh</th>
                        <th>Tác Vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wrr as $v) : ?>
                        <tr v="<?= $v['ProductId'] ?>">
                            <td><?= $v['ProductId'] ?></td>
                            <td><?= $v['CategoryName'] ?></td>
                            <td><?= $v['BrandName'] ?></td>
                            <td class="text-truncate-td"><?= $v['ProductName'] ?></td>
                            <td class="text-truncate-td"><?= $v['Description'] ?></td>
                            <td><?= number_format($v['Price'], 0, ',', '.') ?> ₫</td>
                            <td><?= $v['Quantity'] ?></td>
                            <td><img width="100" src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="<?= $v['ProductName'] ?>" class="img-thumbnail"></td>
                            <td>
                                <a class="edit btn btn-primary" href="/Web_HaiTrieu/product/edit/?id=<?= $v['ProductId'] ?>&page=<?= $page ?>">Cập nhật</a>
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
                    <a class="page-link" href="/Web_HaiTrieu/product/index/?page=<?= $page - 1 ?>" aria-label="Previous" id="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <li class="page-item" id="page"><a class="page-link" href="/Web_HaiTrieu/product/index/?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor ?>
                <li class="page-item">
                    <a class="page-link" href="/Web_HaiTrieu/product/index/?page=<?= $page + 1 ?>" aria-label="Next" id="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="modal" tabindex="-1" id="modalDel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bạn có chắc muốn xóa sản phẩm?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="rs text-danger text-center mt-2"></div>
                <div class="modal-body">
                    <label class="form-lable">Tên sản phẩm</label>
                    <input class="form-control mt-2" type="text" name="name" disabled>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="button" class="confirmDel btn btn-danger">Xóa sản phẩm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/Web_HaiTrieu/assets/js/manager/pagination.js"></script>

<script>
    let active = <?= $page - 1 ?>;
    let numPage = <?= $page ?>;
    let pages = <?= $pages ?>;
    pagination(active, numPage, pages);

    //Xử lý xóa sản phẩm
    $('.del').on('click', function() {
        $('.modal-body').find('input[name="name"]').val('');

        let pid = $(this).closest('tr').attr('v');
        let name = $(this).closest('tr').find('td').eq(3).text();

        $(modalDel).modal('show');
        $('.modal-body').find('input[name="name"]').val(name);

        $('.confirmDel').on('click', function() {
            $.post('/Web_HaiTrieu/product/delete', {
                'pid': pid
            }, (d) => {
                if (d.delete === true) {
                    location.reload();
                } else {
                    let rs = $('.rs');
                    rs.text('Không thể xóa sản phẩm này!');
                    setTimeout(function() {
                        rs.text('')
                    }, 4000);
                }
            });
        });
    });
</script>