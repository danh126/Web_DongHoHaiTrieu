<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Trang chủ</a>
                <span class="breadcrumb-item active">Đơn hàng của tôi</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- My Orders Start -->
<div class="container-fluid" style="width: 94%;">
    <?php
    if (!empty($arr)) :
        foreach ($arr as $orderId => $details) :
    ?>
            <div class="card mb-3">
                <div class="card-header">
                    <strong>Mã đơn hàng: </strong><span><?= $orderId ?></span>
                </div>
                <div class="card-body" id="scrollableDiv">
                    <?php
                    $o = reset($details);
                    $date = $o['OrderDate'];
                    $totalAmount = $o['TotalAmount'];
                    $status = $o['Status'];
                    foreach ($details as $v) :
                    ?>
                        <div class="subBody">
                            <p class="card-text"><strong><?= $v['ProductName'] ?></strong></p>
                            <img class="img-thumbnail" width="100px" src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="" srcset="">
                            <input type="hidden" name="pid" value="<?= $v['ProductId'] ?>">
                            <input type="hidden" name="qty" value="<?= $v['Quantity'] ?>">
                            <p class="card-text mt-2" id="qty">Số lượng: <span><?= $v['Quantity'] ?></span></p>
                            <a class="shopping btn btn-secondary mb-2" href="/Web_HaiTrieu/home/detail/<?= $v['ProductId'] ?>">Mua lại</a>
                            <?php if ($v['CommentId'] == null) : ?>
                                <button class="btnReviewed btn btn-primary mb-2" type="button" data-pid="<?= $v['ProductId'] ?>">Đánh giá sản phẩm</button>
                            <?php endif ?>
                        </div>
                    <?php endforeach; ?>
                    <div class="footerBody">
                        <p class="card-text"><strong>Thời gian đặt:</strong> <?= date("d-m-Y H:i:s", strtotime($date)) ?></p>
                        <p class="card-text"><strong>Tổng tiền:</strong> <?= number_format($totalAmount, 0, ',', '.') ?>₫</p>
                        <p class="card-text status"><strong>Trạng thái:</strong> <span><?= $status ?></span></p>
                        <a href="/Web_HaiTrieu/order/tracking/<?= $orderId ?>" class="btnDetails btn btn-primary">Xem chi tiết</a>
                        <button class="cancel btn btn-warning">Hủy đơn hàng</button>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    <?php else : ?>
        <div class="card mb-3">
            <div class="card-header text-center">
                Bạn chưa có đơn hàng nào!
            </div>
        </div>
    <?php
    endif;
    ?>

    <!-- Reviews Start -->
    <div class="modal" tabindex="-1" id="modalRv">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đánh giá sản phẩm</h5>
                    <button type="button" class="cancelRV btn btn-outline" data-bs-dismiss="modal" aria-label="Close"><i class="fa-2x fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="d-flex my-3">
                            <p class="mb-0 mr-2">Xếp hạng * :</p>
                            <div class="text-primary">
                                <i v="1" class="rating far fa-star"></i>
                                <i v="2" class="rating far fa-star"></i>
                                <i v="3" class="rating far fa-star"></i>
                                <i v="4" class="rating far fa-star"></i>
                                <i v="5" class="rating far fa-star"></i>
                            </div>
                        </div>
                        <div class="required-score mt-2 mb-2 text-danger"></div>
                        <div class="form-group">
                            <label for="message">Bình luận *</label>
                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                            <div class="required-message mt-2 mb-2 text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancelRV btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="button" class="changeReview btn btn-primary">Đánh giá</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Reviews End -->

    <!-- Reviews Success Start -->
    <div class="modal" tabindex="-1" id="modalRvSuccess">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cảm ơn bạn đã đánh giá sản phẩm!</h5>
                    <button type="button" class="cancelRVSuccess btn btn-outline" data-bs-dismiss="modal" aria-label="Close"><i class="fa-2x fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancelRVSuccess btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Reviews Success End -->
</div>
<!-- My Orders End -->

<script src="/Web_HaiTrieu/public/js/order/myorders.js"></script>