$(document).ready(function () {

    //Hàm check active Status
    function activeStatus() {
        let activeStatus = $('#status option:selected').val();

        if (activeStatus > 2) {
            $('.modal-footer .deleteOrders').remove();
        }

        if (activeStatus == 5) {
            $('.modal-footer .deleteOrders').remove();
            $('.modal-footer .updateStatus').remove();
            $('.modal-footer .close').before('<button class="btn btn-primary">Đơn hàng đã giao</button>');
        }
    }


    $('.orderDetails').off('click').on('click', function () {

        $(rs).empty();
        let id = $(this).closest('tr').attr('v');

        $.post('/Web_HaiTrieu/order/details', {
            'id': id
        }, (d) => {
            let orderId = d[0]['OrderId'];
            let fullName = d[0]['FullName'];
            let memberName = d[0]['MemberName'];
            let orderDate = moment(d[0]['OrderDate']).format("DD-MM-YYYY HH:mm:ss");
            let note = d[0]['Note'];
            let status = d[0]['Status'];
            let discount = parseInt(d[0]['OrderDiscount']).toLocaleString('de-DE');
            let total = parseInt(d[0]['TotalAmount']).toLocaleString('de-DE');

            //Selected option tương ứng status
            $('#status option[value="' + status + '"]').prop('selected', true);

            // Hiển thị thông tin chung của đơn hàng
            $('.modal-title').text('Chi tiết đơn hàng #' + orderId);
            $('#details .modal-body .order-info').html(`
            <p><strong>Tên khách hàng:</strong> ${fullName}</p>
            <p><strong>Tên tài khoản:</strong> ${memberName}</p>
            <p><strong>Ghi chú:</strong> ${note}</p>
            <p><strong>Giảm giá:</strong> ${discount}₫</p>
            <p><strong>Tổng số tiền:</strong> ${total}₫</p>
            <p><strong>Ngày mua:</strong> ${orderDate}</p>
            `);
            for (let i in d) {
                var price = parseInt(d[i]['Price']).toLocaleString('de-DE');
                $(rs).append(`
                <tr>
                    <td><input type="hidden" name="pid" value="${d[i]['ProductId']}"></td>
                    <td>${d[i]['ProductName']}</td>
                    <td id="qty"><strong>${d[i]['Quantity']}</strong></td>
                    <td><img width="200px" class="img-thumbnail" src="/Web_HaiTrieu/public/images/product/${d[i]['ImageUrl']}" alt=""></td>
                    <td>${price}₫</td>
                </tr>
            `);
            }
            $('#details').modal('show');
            //console.log(activeStatus);
            activeStatus();
        });

        //Cập nhật trạng thái đơn hàng
        $('.updateStatus').click(function () {
            //Lấy giá trị secleted 
            let status = $('#status option:selected').val();
            $.post('/Web_HaiTrieu/order/updateStatus', {
                'status': status,
                'id': id
            }, (d) => {
                if (d['updateStatus']) {
                    let result = $('.rsUpdate');
                    result.text('Cập nhật trạng thái đơn hàng thành công!');
                    setTimeout(function () {
                        result.text('')
                    }, 4000);
                    activeStatus();
                }
            });
        });

        //Xóa đơn hàng
        $('.deleteOrders').click(function () {
            if (confirm('Bạn có chắc muốn hủy đơn hàng #' + id + ' không?')) {
                const pid = $('#rs').find('input[name="pid"]').map(function () {
                    return $(this).val();
                }).get();

                const qty = $('#rs').find('#qty strong').map(function () {
                    return $(this).text();
                }).get();

                $.post('/Web_HaiTrieu/order/deleteOrders', {
                    'id': id,
                    'qty': qty,
                    'pid': pid
                }, (d) => {
                    if (d['deleteOrders']) {
                        let result = $('.rsDelete');
                        result.text('Hủy đơn hàng #' + id + ' thành công!');
                        setTimeout(function () {
                            result.text('')
                        }, 4000);
                    }
                });
            }
        });
    });

    $('.close').click(function () {
        location.reload();
    });
});