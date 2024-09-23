$(document).ready(function () {
    //Các trạng thái đơn hàng
    const statuses = {
        processing: 'Đang xử lý',
        wait: 'Chờ đơn vị vận chuyển',
        transported: 'Đang vận chuyển',
        process: 'Tiến hành giao hàng',
        delivered: 'Đã giao'
    };

    function closeModal(modalName, closeName) {
        $(closeName).click(function () {
            $(modalName).modal('hide');
        });
    }

    //Xử lý tương ứng với trạng thái đơn hàng
    $('.footerBody').each(function () {
        const $this = $(this);
        const status = $this.find('.status span').text().trim();
        const parent = $this.parent().parent();

        if (status === statuses.transported || status === statuses.process) {
            $this.find('.cancel').prop('disabled', true);
            parent.find('.btnReviewed').hide();
            parent.find('.shopping').hide();
        } else if (status === statuses.processing || status === statuses.wait) {
            parent.find('.btnReviewed').hide();
            parent.find('.shopping').hide();
        } else {
            $this.find('.cancel').remove();
            $this.find('.btnDetails ').remove();
            parent.find('.btnReviewed').show();

        }
    });

    //Xử lý đánh giá sản phẩm
    $('.subBody .btnReviewed').on('click', function () {

        $('.rating').removeClass('fas').addClass('far');
        $(message).val('');

        //Lấy id sản phẩm
        const pid = $(this).parent().find('input[name="pid"]').val();

        const orderId = $(this).parent().parent().parent().find('.card-header span').text();

        $(modalRv).modal('show');

        let score = null;

        $('.modal-body .rating').on('click', function () {
            score = $(this).attr('v');

            $('.rating').each(function () {
                if ($(this).attr('v') <= score) {
                    $(this).removeClass('far').addClass('fas');
                } else {
                    $(this).removeClass('fas').addClass('far');
                }
            })
        });

        $('.modal-footer .changeReview').on('click', function () {
            const comment = $(message).val();
            let errors = false;

            if (comment == '') {
                let errorText = $('.required-message');
                errorText.text('Vui lòng để lại cảm nhận về sản phẩm!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            }

            if (score == null) {
                let errorText = $('.required-score');
                errorText.text('Vui lòng để lại xếp hạng sản phẩm!');
                setTimeout(function () {
                    errorText.text('');
                }, 2000);
                errors = true;
            }

            if (errors === false) {
                NProgress.start();
                $.post('/Web_HaiTrieu/order/reviewed/', {
                    'pid': pid,
                    'content': comment,
                    'score': score,
                    'orderId': orderId
                }, (d) => {
                    if (d.reviewed == true) {
                        $('.subBody .btnReviewed[data-pid="' + pid + '"]').remove();
                        $(modalRv).modal('hide');
                        NProgress.done();
                        $(modalRvSuccess).modal('show');
                        closeModal(modalRvSuccess, '.cancelRVSuccess');
                    }
                });
            }
        });

    });

    closeModal(modalRv, '.cancelRV');

    //Xử lý hủy đơn hàng
    $('.footerBody .cancel').on('click', function () {
        let parent = $(this).parent().parent().parent();
        const orderId = parent.find('.card-header span').text();

        //Duyệt lấy giá trị của input và gôm nhóm lại thành 1 mảng
        const qtyArray = parent.find('input[name="qty"]').map(function () {
            return $(this).val();
        }).get();

        const pidArray = parent.find('input[name="pid"]').map(function () {
            return $(this).val();
        }).get();

        NProgress.start();
        $.post('/Web_HaiTrieu/order/deleteOrders/', {
            'id': orderId,
            'qty': qtyArray,
            'pid': pidArray
        }, (d) => {
            if (d['deleteOrders'] === true) {
                $(this).text('Đã hủy đơn hàng');
                $(this).prop('disabled', true);
            }
        });
        NProgress.done();
    });
});