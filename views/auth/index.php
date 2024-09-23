<link rel="stylesheet" href="/Web_HaiTrieu/public/css/auth.css">
<div class="container">
    <!--Data or Content-->
    <div class="box-1">
        <div class="content-holder">
            <h2 style="color:aliceblue">Chào mừng bạn đến với Hải Triều!</h2>

            <button class="button-1" onclick="signup()">Đăng ký tài khoản</button>
            <button class="button-2" onclick="login()">Đăng nhập</button>
        </div>
    </div>

    <!--Forms-->
    <div class="box-2">
        <div class="login-form-container" id="login">
            <h1>Đăng nhập tài khoản</h1>
            <p class="register-result"></p>
            <p class="login-result"></p>
            <input type="text" placeholder="Nhâp vào Email" name="email" class="input-field" required>
            <p class="email-null error-null"></p>
            <input type="password" placeholder="Nhập vào mật khẩu" name="pwd" class="input-field" required>
            <p class="pwd-null error-null"></p>
            <div class="remember">
                <label for="rem">Ghi nhớ tài khoản</label>&ensp;
                <input type="checkbox" name="rem" id="rem" value="1">
            </div>
            <button class="login-button">Đăng nhập</button>
        </div>

        <!--Create Container for Signup form-->
        <div class="signup-form-container" id="register">
            <h1>Đăng ký tài khoản</h1>
            <p class="register-result"></p>
            <input type="text" placeholder="Tên tài khoản" name="user" class="input-field" required>
            <p class="user-null error-null"></p>
            <input type="email" placeholder="Địa chỉ Email" name="email" class="input-field" required>
            <p class="email-null error-null"></p>
            <div>
                <label>Giới tính</label>&nbsp;&nbsp;&nbsp;&ensp;
                <label for="male">Nam</label>&nbsp;&nbsp;
                <input type="radio" value="Nam" name="gender" id="male">&ensp;
                <label for="female">Nữ</label>&nbsp;&nbsp;
                <input type="radio" value="Nữ" name="gender" id="female">&ensp;
                <label for="other">Khác</label>&nbsp;&nbsp;
                <input type="radio" value="Khác" name="gender" id="other">&ensp;
            </div>
            <p class="gender-null error-null"></p>
            <input type="password" placeholder="Mật khẩu" name="pwd" class="input-field" required>
            <p class="pwd-null error-null"></p>
            <button class="signup-button">Đăng ký</button>
        </div>
    </div>
</div>


<script src="/Web_HaiTrieu/public/js/auth/validate.js"></script>
<script src="/Web_HaiTrieu/public/js/auth/user.js"></script>