<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Home</a>
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu/home/watch/?id=<?= $c['CategoryId'] ?>"><?= $c['CategoryName'] ?></a>
                <span class="breadcrumb-item active"><?= $o['ProductName'] ?></span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="/Web_HaiTrieu/public/images/product/<?= $o['ImageUrl'] ?>" alt="Image">
                    </div>
                    <?php
                    if ($irr != null) :
                        foreach ($irr as $v) :
                    ?>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="/Web_HaiTrieu/public/images/imgdetails/<?= $v['ImageUrl'] ?>" alt="<?= $o['ProductName'] ?>">
                            </div>
                    <?php endforeach;
                    endif ?>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-warning"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-warning"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3><?= $o['ProductName'] ?></h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <?php for ($i = 1; $i <= 5; $i++) :
                            if ($i <= $rating) :
                        ?>
                                <small class="fas text-warning fa-star"></small>
                            <?php else : ?>
                                <small class="far text-warning fa-star"></small>
                        <?php endif;
                        endfor ?>
                    </div>
                    <small class="pt-1">(<?= $countCmt ?> Đánh giá)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4"><?= number_format($o['Price'], 0, ',', '.') ?>₫</h3>
                <p class="mb-4"><?= $o['Description'] ?></p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input class="id-product" type="hidden" value="<?= $o['ProductId'] ?>">
                        <input type="text" class="form-control bg-secondary border-0 text-center qty" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="add-cart btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ hàng</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-warning mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-warning px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-warning px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-warning px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-warning px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-warning active" data-toggle="tab" href="#tab-pane-2">Thông tin sản phẩm</a>
                    <a class="nav-item nav-link text-warning" data-toggle="tab" href="#tab-pane-3">Đánh giá (<?= $countCmt ?>)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-2">
                        <div class="row">
                            <div class="col-10">
                                <table class="table table-bordered">
                                    <?php foreach ($arr as $v) : ?>
                                        <tr>
                                            <th><?= $v['AttributeName'] ?></th>
                                            <td><?= $v['Value'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4"><?= $countCmt ?> đánh giá cho "<?= $o['ProductName'] ?>"</h4>
                                <?php
                                if (!empty($cmt)) :
                                    foreach ($cmt as $v) :
                                ?>
                                        <div class="media mb-4">
                                            <img src="/Web_HaiTrieu/public/images/avatar/<?= $v['Avatar'] ?>" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;" onerror="this.src='/Web_HaiTrieu/public/images/avatar/defaut.png';">
                                            <div class="media-body" v="<?= $v['Score'] ?>">
                                                <h6><?= $v['UserName'] ?><small> - <?= date("d-m-Y H:i", strtotime($v['DateComments'])) ?> <i></i></small></h6>
                                                <div class="text-primary mb-2">
                                                    <i v="1" class="rating far fa-star"></i>
                                                    <i v="2" class="rating far fa-star"></i>
                                                    <i v="3" class="rating far fa-star"></i>
                                                    <i v="4" class="rating far fa-star"></i>
                                                    <i v="5" class="rating far fa-star"></i>
                                                </div>
                                                <p><?= $v['Content'] ?></p>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                <?php else : ?>
                                    <div class="card mb-3">
                                        <div class="card-header text-center">
                                            Chưa có đánh giá về sản phẩm này!
                                        </div>
                                    </div>
                                <?php
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">SẢN PHẨM LIÊN QUAN</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <?php foreach ($o['Watch'] as $v) : ?>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
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
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<script src="/Web_HaiTrieu/public/js/watch/detail.js"></script>