<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Trang chủ</a>
                <span class="breadcrumb-item active">Sản phẩm yêu thích</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Favorite Start -->
<div class="container-fluid pt-2 pb-3" style="width: 94%;">
    <?php if (!empty($frr)) : ?>
        <div class="row">
            <?php foreach ($frr as $v) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="bg-light mb-4">
                        <div class="text-right">
                            <button class="deleteFavorite btn btn-outline-dark mt-2 mr-2"><i class="fa-solid fa-heart" style="color: #A01C27;"></i></button>
                        </div>
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="<?= $v['ProductName'] ?>">
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate d-block" href="/Web_HaiTrieu/home/detail/<?= $v['ProductId'] ?>"><?= $v['ProductName'] ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5><?= number_format($v['Price'], 0, ',', '.') ?>₫</h5>
                                <input type="hidden" name="id" value="<?= $v['ProductId'] ?>">
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small>(99)</small>
                            </div>
                            <div class="mt-2">
                                <a class="btn btn-primary" href="/Web_HaiTrieu/cart/add/<?= $v['ProductId'] ?>"><i class="fa-solid fa-cart-shopping mr-2"></i>Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php else : ?>
        <div class="bg-light text-center">
            <p class="pt-2 pb-2">Danh sách sản phẩm yêu thích của bạn đang trống!</p>
        </div>
    <?php endif ?>
</div>
<!-- Favorite End -->
<script src="/Web_HaiTrieu/public/js/watch/favorites.js"></script>