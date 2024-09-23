<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="<?= $this->meta['description'] ?>" />
    <meta name="author" content="" />
    <title><?= $this->meta['title'] ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="/Web_HaiTrieu/public/images/logo-icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link href="/Web_HaiTrieu/assets/css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="/Web_HaiTrieu/assets/js/all.js"></script>
    <script src="/Web_HaiTrieu/public/js/progress.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/Web_HaiTrieu/manager/index">Hải Triều</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Nội dung tìm kiếm..." aria-label="Nội dung tìm kiếm..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown mt-3">
                <?php if ($admin != null) : ?>
                    <p class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><?= $admin['UserName'] ?></p>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Thông tin</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="/Web_HaiTrieu/admin/logout">Đăng xuất</a></li>
                    </ul>
                <?php endif ?>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="/Web_HaiTrieu/manager/index">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            Trang chủ
                        </a>
                        <!-- Category Manager -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="false" aria-controls="category">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                            Quản lý danh mục
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="category" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/Web_HaiTrieu/category/index">Danh sách danh mục</a>
                            </nav>
                        </div>
                        <!-- Brand Manager -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#brand" aria-expanded="false" aria-controls="brand">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-copyright"></i></i></div>
                            Quản lý thương hiệu
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="brand" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/Web_HaiTrieu/brand/index">Thương hiệu đồng hồ</a>
                            </nav>
                        </div>
                        <!-- Product Manager-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#product" aria-expanded="false" aria-controls="product">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                            Quản lý sản phẩm
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="product" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/Web_HaiTrieu/product/index">Danh sách sản phẩm</a>
                            </nav>
                        </div>
                        <!-- Member Manager -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#member" aria-expanded="false" aria-controls="member">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            Quản lý người dùng
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="member" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/Web_HaiTrieu/member/index">Danh sách người dùng</a>
                            </nav>
                        </div>
                        <!-- Order Manager -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#order" aria-expanded="false" aria-controls="order">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                            Quản lý đơn hàng
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="order" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/Web_HaiTrieu/order/index">Danh sách đơn hàng</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Vai trò:</div>
                    Quản trị viên
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <?php
                require_once("views/{$url}.php");
                ?>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Hải Triều</div>
                        <div>
                            <a href="">
                                Designed by Nguyen Thanh Danh
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/Web_HaiTrieu/assets/js/scripts.js"></script>
</body>

</html>