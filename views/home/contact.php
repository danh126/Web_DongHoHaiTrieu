<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-warning" href="/Web_HaiTrieu">Home</a>
                <span class="breadcrumb-item active">Liên hệ</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Contact Start -->
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Liên hệ với chúng tôi</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                    <div class="control-group">
                        <input type="text" class="form-control" id="name" placeholder="Nhập vào tên của bạn" required="required" data-validation-required-message="Vui lòng nhập tên" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" id="email" placeholder="Nhập vào địa chỉ Email" required="required" data-validation-required-message="Vui lòng nhập địa chỉ email" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" id="subject" placeholder="Nội dung tiêu đề" required="required" data-validation-required-message="Vui lòng nhập nội dung tiêu đề" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control" rows="8" id="message" placeholder="Tin nhắn" required="required" data-validation-required-message="Vui lòng nhập vào lời nhắn"></textarea>
                        <p class=" help-block text-danger"></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Gửi tin nhắn</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-30">
                <iframe style="width: 100%; height: 250px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15673.184752557441!2d106.613621!3d10.865062!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752a11320f8687%3A0xab0bc6a7dd7fdfc!2zxJDhu5NuZyBI4buTIEjhuqNpIFRyaeG7gXU!5e0!3m2!1svi!2s!4v1718283428360!5m2!1svi!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>156A Trần Quang Khải, Phường Tân Định, Quận 1</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>lienhe@donghohaitrieu.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+1900.6777</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<script>
    $($('div.navbar-nav a[href="/Web_HaiTrieu/home/contact"]')).addClass('active');
</script>