$(document).ready(function () {
    // Xử lý thêm thương hiệu
    $('#add button').on('click', function () {
        $(modalAdd).modal('show');
    });

    // Xử lý cập nhật thương hiệu
    $('#brand .update').off('click').on('click', function () {
        let parent = $(this).closest('tr');
        let brandId = parent.attr('v');
        let brandName = parent.children('td').eq(1).text();

        //Hình ảnh logo
        let logoImg = parent.children('td').eq(2).find('img').attr('src').split('/').pop();

        // Xóa nội dung cũ của modal
        $(modalEdit).find('.modal-body input').val('');
        $(modalEdit).find('.modal-body img').attr('src', '');

        // Hiển thị modal với dữ liệu mới
        $(modalEdit).find('input[name="id"]').val(brandId);
        $(modalEdit).find('input[name="name"]').val(brandName);
        $(modalEdit).find('input[name="logoUrl"]').val(logoImg);

        //Đường dẫn hỉnh ảnh
        let oldUrl = parent.children('td').eq(2).find('img').attr('src');

        //Tách lấy thư mục chứa hình ảnh
        let baseUrl = oldUrl.split('/').slice(0, -1).join('/');

        //Tạo url hình ảnh mới
        let newUrl = `${baseUrl}/${logoImg}`;

        $(modalEdit).find('img').attr('src', newUrl);

        $(modalEdit).modal('show');
    });

    // Xử lý xóa
    $('#brand .del').off('click').on('click', function () {
        let parent = $(this).closest('tr');
        let brandId = parent.attr('v');
        let brandName = parent.children('td').eq(1).text();

        // Xóa nội dung cũ của modal
        $(modalDelete).find('.modal-body input').val('');

        // Hiển thị modal với dữ liệu mới
        $(modalDelete).find('input[name="name"]').val(brandName);
        $(modalDelete).modal('show');

        $(modalDelete).find('.confirmDel').off('click').on('click', function () {
            $.post('/Web_HaiTrieu/brand/delete/', {
                'id': brandId
            }, (d) => {
                if (d.delete === false) {
                    var error = $(modalDelete).find('.error');
                    error.text('Không thể xóa thương hiệu này!');
                    setTimeout(function () {
                        error.text('');
                    }, 2000);
                } else {
                    location.reload();
                }
                console.log(d);
            });
        });
    });
});