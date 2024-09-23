<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <?php foreach ($srr['slide'] as $v) : ?>
                        <div class="carousel-item position-relative slide-index" style="height: 430px;" v="<?= $v['SlideId'] ?>">
                            <img class="position-absolute w-100 h-100" src="/Web_HaiTrieu/public/images/<?= $v['ImageUrl'] ?>" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown"><?= $v['Title'] ?></h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn"><?= $v['Description'] ?></p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="/Web_HaiTrieu/home/watch/?id=<?= $v['ProductLink'] ?>">Mua Ngay</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <?php foreach ($srr['bst'] as $v) : ?>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="/Web_HaiTrieu/public/images/<?= $v['ImageUrl'] ?>" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase"><?= $v['Title'] ?></h6>
                        <h3 class="text-white mb-3"><?= $v['Description'] ?></h3>
                        <a href="/Web_HaiTrieu/home/watch/?id=<?= $v['ProductLink'] ?>" class="btn btn-primary">Mua Ngay</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Đồng hồ chính hãng</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Miễn phí vận chuyển</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Hỗ trợ đổi trả</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Tư vấn khách hàng 24/7</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->

<!-- Watch Men Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?= $crr[0]['CategoryName'] ?></span></h2>
    <div class="row px-xl-5" id="rsM">
        <?php foreach ($wrr[1] as $v) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <input type="hidden" name="id" value="<?= $v['ProductId'] ?>">
                        <img class="img-fluid w-100" src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="<?= $v['ProductName'] ?>">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="/Web_HaiTrieu/cart/add/<?= $v['ProductId'] ?>"><i class="fa fa-shopping-cart"></i></a>
                            <a class="favorite btn btn-outline-dark btn-square"><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate d-block" href="/Web_HaiTrieu/home/detail/<?= $v['ProductId'] ?>"><?= $v['ProductName'] ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?= number_format($v['Price'], 0, ',', '.'); ?> ₫</h5>
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
    </div>
    <div class="text-center">
        <input type="hidden" name="men" value="<?= $pages[1] ?>">
        <button id="btnMen" class="btn btn-outline-dark"><i class="fa-solid fa-arrow-down"></i> Xem thêm</button>
    </div>
</div>
<!-- Watch Men End -->


<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <?php foreach ($srr['sale'] as $v) : ?>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="/Web_HaiTrieu/public/images/<?= $v['ImageUrl'] ?>" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase"><?= $v['Title'] ?></h6>
                        <h3 class="text-white mb-3"><?= $v['Description'] ?></h3>
                        <a href="" class="btn btn-primary">Mua Ngay</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<!-- Offer End -->


<!-- Watch Women Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?= $crr[1]['CategoryName'] ?></span></h2>
    <div class="row px-xl-5" id="rsWM">
        <?php foreach ($wrr[2] as $v) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <input type="hidden" name="id" value="<?= $v['ProductId'] ?>">
                        <img class="img-fluid w-100" src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="<?= $v['ProductName'] ?>">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="/Web_HaiTrieu/cart/add/<?= $v['ProductId'] ?>"><i class="fa fa-shopping-cart"></i></a>
                            <a class="favorite btn btn-outline-dark btn-square"><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate d-block" href="/Web_HaiTrieu/home/detail/<?= $v['ProductId'] ?>"><?= $v['ProductName'] ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?= number_format($v['Price'], 0, ',', '.'); ?> ₫</h5>
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
    </div>
    <div class="text-center">
        <input type="hidden" name="women" value="<?= $pages[2] ?>">
        <button id="btnWomen" class="btn btn-outline-dark"><i class="fa-solid fa-arrow-down"></i> Xem thêm</button>
    </div>
</div>
<!-- Watch Women End -->

<!-- Watch Couple Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?= $crr[2]['CategoryName'] ?></span></h2>
    <div class="row px-xl-5" id="rsC">
        <?php foreach ($wrr[3] as $v) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <input type="hidden" name="id" value="<?= $v['ProductId'] ?>">
                        <img class="img-fluid w-100" src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="<?= $v['ProductName'] ?>">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="/Web_HaiTrieu/cart/add/<?= $v['ProductId'] ?>"><i class="fa fa-shopping-cart"></i></a>
                            <a class="favorite btn btn-outline-dark btn-square"><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate d-block" href="/Web_HaiTrieu/home/detail/<?= $v['ProductId'] ?>"><?= $v['ProductName'] ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?= number_format($v['Price'], 0, ',', '.'); ?> ₫</h5>
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
    </div>
    <div class="text-center">
        <input type="hidden" name="couple" value="<?= $pages[3] ?>">
        <button id="btnCouple" class="btn btn-outline-dark"><i class="fa-solid fa-arrow-down"></i> Xem thêm</button>
    </div>
</div>
<!-- Watch Couple End -->

<!-- Brand Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <?php foreach ($brr as $v) : ?>
                    <div class="bg-light p-4">
                        <img width="250px" height="120px" src="/Web_HaiTrieu/public/images/brand/<?= $v['LogoUrl'] ?>" alt="">
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- Brand End -->
<script src="/Web_HaiTrieu/public/js//watch/getdata.js"></script>
<script>
    $($('div.navbar-nav a[href="/Web_HaiTrieu"]')).addClass('active');
</script>