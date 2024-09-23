<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Trang chủ</a>
                <span class="breadcrumb-item active">Thông tin tài khoản</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Porfile Start -->
<div class="container-fluid" style="width: 94%;">
    <?php if (!empty($member)) : ?>
        <div class="row gy-4 gy-lg-0">
            <div class="col-12 col-lg-4 col-xl-3">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="card widget-card border-light shadow-sm">
                            <div class="card-header text-bg-primary">Xin chào, <?= $member['UserName'] ?></div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="avatar-wrapper">
                                        <img class="profile-pic" id="avt" src="/Web_HaiTrieu/public/images/avatar/<?= $member['Avatar'] ?>" data-old-src="/Web_HaiTrieu/public/images/avatar/<?= $member['Avatar'] ?>" onerror="this.src='/Web_HaiTrieu/public/images/avatar/defaut.png';" />
                                        <div class="upload-button">
                                            <i class="fa-solid fa-arrow-up-from-bracket text-primary"></i>
                                        </div>
                                        <input class="file-upload" type="file" accept="image/*" />
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush mb-4">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6 class="m-0">Ngày tạo tài khoản: <?= date("d-m-Y", strtotime($member['DateCreat'])) ?></h6>
                                        <span></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6 class="m-0">Số lần mua hàng: <?= $member['countOrders'] ?></h6>
                                        <span></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6 class="m-0">Xếp loại:</h6>
                                        <span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xl-9">
                <div class="card widget-card border-light shadow-sm">
                    <div class="card-body p-4">
                        <ul class="nav nav-tabs" id="profileTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Thông tin</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane" type="button" role="tab" aria-controls="password-tab-pane" aria-selected="false">Mật khẩu</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-4" id="profileTabContent">
                            <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Tên tài khoản</label>
                                        <input class="form-control" name="username" type="text" value="<?= $member['UserName'] ?>" disabled placeholder="Nhập vào tên">
                                        <p class="username-null text-danger"></p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Họ Tên</label>
                                        <input class="form-control" name="fullname" type="text" value="<?= $member['FullName'] ?>" disabled placeholder="Nhập vào tên">
                                        <p class="fname-null text-danger"></p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" type="email" value="<?= $member['Email'] ?>" disabled placeholder="Nhập vào Email">
                                        <p class="email-null text-danger"></p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Số điện thoại</label>
                                        <input class="form-control" name="phone" type="text" value="<?= $member['Phone'] ?>" disabled placeholder="Nhập vào số điện thoại">
                                        <p class="phone-null text-danger"></p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Giới tính</label>
                                        <input class="form-control" name="gender" type="text" value="<?= $member['Gender'] ?>" disabled placeholder="Nhập vào số điện thoại">
                                        <p class="gender-null text-danger"></p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Địa chỉ</label>
                                        <input class="form-control" name="address" type="text" value="<?= $member['Address'] ?>" disabled placeholder="Nhập vào địa chỉ">
                                        <p class="address-null text-danger"></p>
                                    </div>
                                </div>
                                <div class="command">
                                    <button class="updateProfile btn btn-primary"><i class="fa-solid fa-user-pen"></i> Cập nhật thông tin</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
                                <div class="text-success text-center" id="changePass"></div>
                                <div class="row gy-3 gy-xxl-4">
                                    <div class="col-12">
                                        <label for="currentPassword" class="form-label">Nhập mật khẩu cũ</label>
                                        <input type="password" class="form-control" id="currentPassword">
                                        <p class="oldPass-null text-danger"></p>
                                    </div>
                                    <div class="col-12">
                                        <label for="newPassword" class="form-label">Nhập mật khẩu mới</label>
                                        <input type="password" class="form-control" id="newPassword">
                                        <p class="newPass-null text-danger"></p>
                                    </div>
                                    <div class="col-12">
                                        <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                                        <input type="password" class="form-control" id="confirmPassword">
                                        <p class="confirmPass-null text-danger"></p>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="newpass btn btn-primary"><i class="fa-solid fa-user-pen"></i> Đổi mật khẩu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
<!-- Profile End -->

<script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/Web_HaiTrieu/public/js/auth/validate.js"></script>
<script src="/Web_HaiTrieu/public/js/auth/profile.js"></script>