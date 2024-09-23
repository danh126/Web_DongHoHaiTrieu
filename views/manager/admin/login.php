<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header" id="login">
                                <h3 class="text-center font-weight-light my-4">Đăng nhập quản trị</h3>
                                <p class="login-result text-center text-danger"></p>
                            </div>
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="eml" id="inputEmail" type="email" placeholder="name@example.com" />
                                    <label for="inputEmail">Tài khoản Email</label>
                                    <p class="email-null text-center text-danger"></p>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="pwd" id="inputPassword" type="password" placeholder="Password" />
                                    <label for="inputPassword">Mật khẩu</label>
                                    <p class="pwd-null text-center text-danger"></p>
                                </div>
                                <div class="remember form-check mb-3">
                                    <input class="form-check-input" name="rem" id="inputRememberPassword" type="checkbox" value="1" />
                                    <label class="form-check-label" for="inputRememberPassword">Ghi nhớ tài khoản</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="">Quên mật khẩu?</a>
                                    <button class="login-button btn btn-primary">Đăng nhập</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
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
<script src="/Web_HaiTrieu/public/js/progress.js"></script>
<script src="/Web_HaiTrieu/public/js/auth/admin.js"></script>