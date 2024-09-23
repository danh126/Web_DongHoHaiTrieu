$(document).ready(function () {
    //Xử lý rating
    $('.media').each(function () {
        let score = $(this).find('.media-body').attr('v');

        $(this).find('.rating').each(function (ratingIndex) {
            if (ratingIndex < score) {
                $(this).removeClass('far').addClass('fas');
            } else {
                $(this).removeClass('fas').addClass('far');
            }
        });
    });

    //Xử lý thêm vào giỏ hàng
    $('.add-cart').click(function () {
        let id = $(this).parent().find('.id-product').val()
        let qty = $(this).parent().find('.qty').val();
        if (qty > 0) {
            NProgress.start();
            $.post('/Web_HaiTrieu/cart/add/' + id, {
                'qty': qty
            }, (d) => {
                if (d == 1) {
                    $(location).attr('href', '/Web_HaiTrieu/cart');
                }
                NProgress.done();
            });
        }
    });
});