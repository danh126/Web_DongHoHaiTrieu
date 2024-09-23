<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Trang chủ</a>
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu/cart">Giỏ hàng</a>
                <span class="breadcrumb-item active">Đặt hàng</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5" id="checkout">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Thông tin chi tiết</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="row" id="profile">
                    <div class="col-md-6 form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="fname" type="text" value="<?= !empty($member) ? $member['FullName'] : '' ?>" placeholder="Nhập vào tên">
                        <p class="fname-null text-danger"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" name="eml" type="text" value="<?= !empty($member) ? $member['Email'] : '' ?>" placeholder=" Nhập vào địa chỉ E-mail">
                        <p class="eml-null text-danger"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" name="phone" type="text" value="<?= !empty($member) ? $member['Phone'] : '' ?>" placeholder="Nhập vào số điện thoại">
                        <p class="phone-null text-danger"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Địa chỉ giao hàng</label>
                        <input class="form-control" name="address" type="text" value="<?= !empty($member) ? $member['Address'] : '' ?>" placeholder="Nhập vào địa chỉ">
                        <p class="address-null text-danger"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Ghi chú</label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Chi tiết đơn hàng</span></h5>
            <div class="input-group mb-30" id="coupon">
                <input type="text" class="form-control border-0 p-4" placeholder="Nhập mã giảm giá">
                <div class="input-group-append">
                    <button class="btn btn-primary">Sử dụng mã giảm</button>
                </div>
            </div>
            <div id="coupon-error" class="mb-30">
                <h6 class="text-danger"></h6>
            </div>
            <div class="bg-light p-30 mb-5">
                <h6 class="mb-3">Sản phẩm</h6>
                <div class="border-bottom" id="scrollableDiv">
                    <?php foreach ($cart as $v) : ?>
                        <div>
                            <div class="d-flex justify-content-between">
                                <p class="text-ellipsis"><img src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="<?= $v['ProductName'] ?>" width="80" class="img-thumbnail">&nbsp;<?= $v['ProductName'] ?></p>
                            </div>
                            <div class="text-right">
                                <p><span><?= number_format($v['Price'], 0, ',', '.') ?></span>₫</p>
                                <p><span>Số lượng: </span><?= $v['Quantity'] ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Tạm tính</h6>
                        <h6 class="sub-total"><span><?= number_format($subTotal, 0, ',', '.') ?></span>₫</h6>
                    </div>
                    <div class="d-flex justify-content-between mb-3 coupon-apply"></div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Phí vận chuyển</h6>
                        <h6 class="font-weight-medium"><span>0</span>₫</h6>
                    </div>
                </div>
                <div class="pt-2" id="finalTotal">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Tổng tiền</h5>
                        <h5 class="final-total"><span><?= number_format($finalTotal, 0, ',', '.') ?></span>₫</h5>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Hình thức thanh toán</span></h5>
                <div class="bg-light p-30">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="paypal">
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" checked class="custom-control-input" name="payment" id="directcheck" value="1">
                            <label class="custom-control-label" for="directcheck">Thanh toán khi nhận hàng</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                            <label class="custom-control-label" for="banktransfer">Chuyển khoản</label>
                        </div>
                    </div>
                    <button class="confirmOrders btn btn-block btn-primary font-weight-bold py-3">Đặt hàng</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->

<script src="/Web_HaiTrieu/public/js/auth/validate.js"></script>
<script src="/Web_HaiTrieu/public/js/cart/checkout.js"></script>