<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Trang chủ</a>
                <span class="breadcrumb-item active">Giỏ hàng</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="cart">
                    <?php
                    if (isset($cart)) :
                        $totalPrice = null;
                        foreach ($cart as $v) :
                            $totalPrice += $v['Price'] * $v['Quantity'];
                    ?>
                            <tr v="<?= $v['ProductId'] ?>">
                                <td class="text-left text-ellipsis"><a href="/Web_HaiTrieu/home/detail/<?= $v['ProductId'] ?>" style="color: #6C757D;"><img src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="<?= $v['ProductName'] ?>" style="width: 50px;"><?= $v['ProductName'] ?></a></td>
                                <td class="align-middle"><span class="sub-total"><?= number_format($v['Price'], 0, ',', '.') ?></span>₫</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="qty form-control form-control-sm bg-secondary border-0 text-center" value="<?= $v['Quantity'] ?>" min="1" max="10" step="1" readonly>
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle"><span class="total-price"><?= number_format($v['Price'] * $v['Quantity'], 0, ',', '.') ?></span>₫</td>
                                <td class="align-middle del"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                            </tr>
                    <?php
                        endforeach;
                    endif
                    ?>
                </tbody>
                <tfoot class="footer-cart"></tfoot>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Chi tiết đơn đặt hàng</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="pb-2 ordersDetail">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Tạm tính</h6>
                        <h6 class="total-demo"><span></span>₫</h6>
                    </div>
                </div>
                <div class="border-bottom d-flex justify-content-between">
                    <h6 class="font-weight-medium">Phí vận chuyển</h6>
                    <h6 class="font-weight-medium"><span>0</span>₫</h6>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <h5>Tổng</h5>
                    <h5 class="total"><span></span>₫</h5>
                </div>
            </div>
            <div class="pt-2">
                <button class="checkout btn btn-block btn-primary font-weight-bold my-3 py-3">Tiến hành kiểm tra</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Cart End -->

<!--Jquery Cart-->
<script src="/Web_HaiTrieu/public/js/cart/cart.js"></script>