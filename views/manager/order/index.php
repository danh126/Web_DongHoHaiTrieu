<div class="container-fluid px-4">
    <div class="mt-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/manager/index">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách đơn hàng</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách đơn hàng
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="order">
                <thead class="table-warning">
                    <tr class="text-center">
                        <th>ID Đơn Hàng</th>
                        <th>Tên tài khoản</th>
                        <th>Tên khách hàng</th>
                        <th>Ngày Mua Hàng</th>
                        <th>Giảm giá</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Tác Vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orr as $v) : ?>
                        <tr v="<?= $v['OrderId'] ?>" class="text-center">
                            <td><?= $v['OrderId'] ?></td>
                            <td><?= $v['MemberName'] ?></td>
                            <td><?= $v['FullName'] ?></td>
                            <td><?= date("d-m-Y H:i:s", strtotime($v['OrderDate'])) ?></td>
                            <td><?= number_format($v['OrderDiscount'], 0, ',', '.') ?>₫</td>
                            <td><?= number_format($v['TotalAmount'], 0, ',', '.') ?>₫</td>
                            <td class="text-success"><?= $v['Status'] ?></td>
                            <td>
                                <button class="orderDetails btn btn-primary">Chi tiết đơn hàng</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end me-3">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="/Web_HaiTrieu/order/index/?page=<?= $page - 1 ?>" aria-label="Previous" id="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <li class="page-item" id="page"><a class="page-link" href="/Web_HaiTrieu/order/index/?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor ?>
                <li class="page-item">
                    <a class="page-link" href="/Web_HaiTrieu/order/index/?page=<?= $page + 1 ?>" aria-label="Next" id="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="modal" tabindex="-1" id="details">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="rsDelete mt-2 mb-2 text-center text-danger"></div>
                <div id="scroll">
                    <div class="modal-body">
                        <div class="order-info"></div>
                        <div class="mb-3">
                            <p><strong>Trạng thái:</strong></p>
                            <select name="status" id="status" class="form-select">
                                <?php foreach ($scc as $v) : ?>
                                    <option value="<?= $v['StatusId'] ?>"><?= $v['Status'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <p class="rsUpdate mt-2 mb-2 text-danger"></p>
                        </div>
                        <table class="table table-bordered" id="rs">
                        </table>
                    </div>
                    <div class="modal-footer mb-2">
                        <button class="updateStatus btn btn-success">Cập nhật trạng thái</button>
                        <button class="deleteOrders btn btn-danger">Hủy đơn hàng</button>
                        <button class="close btn btn-secondary">Thoát</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/Web_HaiTrieu/assets/js/manager/order.js"></script>
<script src="/Web_HaiTrieu/assets/js/manager/pagination.js"></script>

<script>
    let active = <?= $page - 1 ?>;
    let numPage = <?= $page ?>;
    let pages = <?= $pages ?>;
    pagination(active, numPage, pages);
</script>