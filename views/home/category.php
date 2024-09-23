<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Trang chủ</a>
                <span class="breadcrumb-item active">Tất cả đồng hồ</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><img width="20" src="/Web_HaiTrieu/public/images/icon/filter.png">&ensp;<span class="bg-secondary pr-3">Bộ lọc</span></h5>
            <!-- Brand Start -->
            <div class="bg-light p-4 mb-30">
                <form>
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Thương hiệu</span></h5>
                    <?php foreach ($brr as $v) : ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="filter custom-control-input" name="brand" value="<?= $v['BrandId'] ?>" id="<?= $v['BrandId'] ?>">
                            <label class="custom-control-label" for="<?= $v['BrandId'] ?>"><?= $v['BrandName'] ?></label>
                            <span class="badge border font-weight-normal"><?= $v['Total'] ?></span>
                        </div>
                    <?php endforeach ?>
                </form>
            </div>
            <!-- Brand End -->

            <!--Filter Price Start-->
            <div class="bg-light p-4 mb-30">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Khoảng giá</span></h5>
                <div class="d-flex justify-content-center align-items-center">
                    <input type="text" class="form-control form-control-sm bg-secondary border-0" value="<?= $min ?>" name="price-filter" style="width: 130px;" placeholder="₫ TỪ">&ensp;&ensp;
                    <input type="text" class="form-control form-control-sm bg-secondary border-0" value="<?= $max ?>" name="price-filter" style="width: 130px;" placeholder="₫ ĐẾN">
                </div>
                <div class="errorr mt-4 text-danger text-center"></div>
                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <button class="confirm-price btn btn-primary btn-block">Áp dụng</button>
                </div>
            </div>
            <!--Filter Price End-->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a class="btn btn-sm btn-light" href="/Web_HaiTrieu/home/category"><i class="fa fa-th-large"></i></a>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                    </div>
                </div>
                <?php foreach ($o as $v) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="/Web_HaiTrieu/cart/add/<?= $v['ProductId'] ?>"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate d-block" href="/Web_HaiTrieu/home/detail/<?= $v['ProductId'] ?>"><?= $v['ProductName'] ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5><?= number_format($v['Price'], 0, ',', '.') ?> ₫</h5>
                                    <!--<h6 class="text-muted ml-2"><del>$123.00</del></h6>-->
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                <div class="col-12">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item page-prev"><a class="page-link" href="/Web_HaiTrieu/home/category/?<?= $q ?>page=<?= $page - 1 ?>"><i class="fa-solid fa-left-long"></i></a></li>
                            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                <li class="page-item page"><a class="page-link" href="/Web_HaiTrieu/home/category/?<?= $q ?>page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endfor ?>
                            <li class="page-item page-next"><a class="page-link" href="/Web_HaiTrieu/home/category/?<?= $q ?>page=<?= $page + 1 ?>"><i class="fa-solid fa-right-long"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<!-- Filter -->
<script src="/Web_HaiTrieu/public/js/watch/filter.js"></script>

<!-- Keypress -->
<script src="/Web_HaiTrieu/public/js/keypress.js"></script>

<!-- Pagination -->
<script src="/Web_HaiTrieu/public/js/watch/pagination.js"></script>

<script>
    $($('div.navbar-nav a[href="/Web_HaiTrieu/home/category"]')).addClass('active');

    let active = <?= $page - 1 ?>;
    let numPage = <?= $page ?>;
    let pages = <?= $pages ?>;
    pagination(active, numPage, pages);

    let minPrice = <?= $minPrice ?>;
    let maxPrice = <?= $maxPrice ?>;

    getFilter(
        '/Web_HaiTrieu/home/category/?',
        ['brand', 'price'],
        '.confirm-price',
        minPrice,
        maxPrice,
        '.filter'
    );
</script>