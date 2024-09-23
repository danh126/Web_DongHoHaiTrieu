<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $this->meta['title'] ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?= $this->meta['description'] ?>" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="/Web_HaiTrieu/public/images/logo-icon.png" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/Web_HaiTrieu/public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/Web_HaiTrieu/public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/Web_HaiTrieu/public/css/style.css" rel="stylesheet">
    <link href="/Web_HaiTrieu/public/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/Web_HaiTrieu/public/js/progress.js"></script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">Giới thiệu</a>
                    <a class="text-body mr-3" href="">Liên hệ</a>
                    <a class="text-body mr-3" href="">Hỗ trợ</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <?php if ($member != null) : ?>
                            <button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown"><?= $member['UserName'] ?>&ensp;
                                <img width="30px" style="border-radius: 50%" alt="Avatar" src="/Web_HaiTrieu/public/images/avatar/<?= $member['Avatar'] ?>" onerror="this.src='/Web_HaiTrieu/public/images/avatar/defaut.png';" />
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/Web_HaiTrieu/auth/profile">Thông tin tài khoản</a>
                                <a class="dropdown-item" href="/Web_HaiTrieu/order/myorders">Đơn hàng của tôi</a>
                                <a class="dropdown-item" href="/Web_HaiTrieu/auth/logout">Đăng xuất</a>
                            </div>
                        <?php else : ?>
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Tài khoản</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/Web_HaiTrieu/auth">Đăng nhập</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="/Web_HaiTrieu" class="text-decoration-none">
                    <img src="/Web_HaiTrieu/public/images/logo.png" alt="No images logo" width="250">
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="/Web_HaiTrieu/home/search/">
                    <div class="input-group">
                        <input type="search" name="q" class="form-control" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" placeholder="Tìm kiếm sản phẩm đồng hồ">
                        <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Tổng đài tư vấn</p>
                <h5 class="m-0">+1900.6777</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Danh mục</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <a href="/Web_HaiTrieu/home/category" class="nav-item nav-link">Tất cả đồng hồ</a>
                        <?php foreach ($crr as $v) : ?>
                            <a href="/Web_HaiTrieu/home/<?= $v['CategoryUrl'] ?>" class="nav-item nav-link"><?= $v['CategoryName'] ?></a>
                        <?php endforeach ?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="/Web_HaiTrieu" class="text-decoration-none d-block d-lg-none">
                        <img src="/Web_HaiTrieu/public/images/logo.png" alt="No images logo" width="250">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="/Web_HaiTrieu" class="nav-item nav-link">Trang chủ</a>
                            <?php foreach ($crr as $v) : ?>
                                <a href="/Web_HaiTrieu/home/<?= $v['CategoryUrl'] ?>" class="nav-item nav-link"><?= $v['CategoryName'] ?></a>
                            <?php endforeach ?>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="/Web_HaiTrieu/home/favorites" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?= !empty($member) ? $member['favorites'] : '0' ?></span>
                            </a>
                            <a href="/Web_HaiTrieu/cart" class="btn px-0 ml-3" id="CartAni">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;" id="box-cart"><?= isset($qtyCart) ? $qtyCart : '' ?></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    <?php
    require_once("views/{$url}.php");
    ?>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Đồng Hồ Hải Triều</h5>
                <p class="mb-4">Hơn 25 thương hiệu đồng hồ nổi tiếng đến từ các nền công nghiệp đồng hồ hàng đầu thế giới như: Thụy Sỹ, Nhật Bản, Mỹ,... Có mặt tại hệ thống ShowRoom đồng hồ Hải Triều.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>156A Trần Quang Khải, Phường Tân Định, Quận 1</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>lienhe@donghohaitrieu.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>1900.6777</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Hệ Thống Cửa Hàng</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>TP. Hồ Chí Minh</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Hà Nội</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Hải Phòng</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Biên Hoà - Bình Dương</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Đà Nẵng</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Trung Tâm Bảo Hành</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">THÔNG TIN</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Thông tin liên hệ</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Thanh toán - Trả góp</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Liên hệ đối tác doanh nghiệp</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Vận chuyển & Giao nhận </a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Tin khuyến mãi</h5>
                        <p>Nhận những thông tin về đồng hồ khuyến mãi</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nhập vào địa chỉ Email">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Gửi</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Theo dõi chúng tôi</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; Copyright <a class="text-primary" href="#">Hải Triều</a>. Designed
                    by
                    <a class="text-primary" href="#">Nguyen Thanh Danh</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/Web_HaiTrieu/public/lib/easing/easing.min.js"></script>
    <script src="/Web_HaiTrieu/public/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/Web_HaiTrieu/public/js/main.js"></script>
</body>

</html>