<link rel="stylesheet" href="/Web_HaiTrieu/public/css/tracking.css">
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Trang chủ</a>
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu/order/myorders">Đơn hàng của tôi</a>
                <span class="breadcrumb-item active">Theo dõi</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<div class="container-fluid mb-3" style="width: 94%;">
    <div class="card">
        <header class="card-header">Theo dõi đơn hàng</header>
        <div class="card-body">
            <h6>Mã đơn hàng: <?= $id ?></h6>
            <div class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Thời gian giao hàng ước tính:</strong> <br></div>
                    <div class="col"> <strong>Đơn vị vận chuyển:</strong> <br> J&T Express, | <i class="fa fa-phone"></i>
                        +1900 1088 </div>
                    <div class="col"> <strong>Hình thức:</strong> <br> Vận chuyển nhanh </div>
                    <div class="col"> <strong>Theo dõi #:</strong> <br> <?= $id ?> </div>
                </div>
            </div>
            <div class="track">
                <div class="step"> <span class="icon" v="1"> <i class="fa fa-check"></i> </span> <span class="text">Xác nhận đặt hàng</span> </div>
                <div class="step"> <span class="icon" v="2"> <i class="fa fa-user"></i> </span> <span class="text">
                        Chờ đơn vị vận chuyển</span> </div>
                <div class="step"> <span class="icon" v="3"> <i class="fa fa-truck"></i> </span> <span class="text">Đang vận chuyển</span> </div>
                <div class="step"> <span class="icon" v="4"> <i class="fa fa-box"></i> </span> <span class="text">Tiến hành giao hàng</span> </div>
                <div class="step"> <span class="icon" v="5"> <i class="fa-solid fa-house"></i></i> </span> <span class="text">Đã giao</span> </div>
            </div>
            <hr>
            <?PHP if (!empty($arr)) : ?>
                <ul class="row">
                    <?php foreach ($arr as $orderId => $details) : ?>
                        <?php foreach ($details as $v) : ?>
                            <li class="col-md-4">
                                <figure class="itemside mb-3">
                                    <div class="aside"><img src="/Web_HaiTrieu/public/images/product/<?= $v['ImageUrl'] ?>" class="img-sm border"></div>
                                    <figcaption class="info align-self-center">
                                        <p class="title"><?= $v['ProductName'] ?> <br>Số lượng: <?= $v['Quantity'] ?></p>
                                        <span class="text-muted"><?= number_format($v['Price'], 0, ',', '.') ?>₫</span>
                                    </figcaption>
                                </figure>
                            </li>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </ul>
                <div>
                    <?php $o = reset($details); ?>
                    <p><strong>Khách hàng:</strong> <?= htmlspecialchars($o['FullName']) ?></p>
                    <p><strong>Thời gian đặt:</strong> <?= date("d-m-Y H:i:s", strtotime($o['OrderDate'])) ?></p>
                    <p><strong>Ghi chú:</strong> <?= htmlspecialchars($o['Note']) ?></p>
                    <p><strong>Giảm giá: </strong><?= number_format($o['OrderDiscount'], 0, ',', '.') ?>₫</p>
                    <p><strong>Tổng tiền: </strong><?= number_format($o['TotalAmount'], 0, ',', '.') ?>₫</p>
                </div>
            <?php endif ?>
            <hr>
            <a href="/Web_HaiTrieu/order/myorders" class="btn btn-warning"> <i class="fa fa-chevron-left"></i> Quay lại đơn hàng</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let status = <?= $o['Status'] ?>;

        $('.track .step').each(function() {
            let stepActive = $(this).find('.icon').attr('v');
            if (stepActive <= status) {
                $(this).addClass('active');
            }
        });
    });
</script>