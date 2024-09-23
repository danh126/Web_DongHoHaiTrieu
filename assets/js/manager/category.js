$(document).ready(function () {
    //Xử lý th6m danh mục
    $('#add button').click(function () {

        $(modalAdd).find('.modal-body input').val('');
        $(modalAdd).find('.modal-body textarea').text('');

        $('#modalAdd').modal('show');
    });

    //Xử lý cập nhật danh mục
    $('#table .edit').off('click').on('click', function () {
        let id = $(this).closest('tr').attr('v');
        let name = $(this).closest('tr').children('td').eq(1).text();
        let desc = $(this).closest('tr').children('td').eq(2).text();
        let url = $(this).closest('tr').children('td').eq(3).text();

        $(modalEdit).find('.modal-body input').val('');
        $(modalEdit).find('.modal-body textarea').text('');

        $('#modalEdit').modal('show');
        $('.modal-body').find('input[name="id"]').val(id);
        $('.modal-body').find('input[name="name"]').val(name);
        $('.modal-body').find('#desc').text(desc);
        $('.modal-body').find('input[name="categoryUrl"]').val(url);
    });

    //CK Editor
    ClassicEditor
        .create(document.querySelector('#desc'))
        .catch(error => {
            console.error(error);
        });

    //Xử lý xóa danh mục
    $('#table .del').click(function () {
        var id = $(this).closest('tr').attr('v');
        var name = $(this).closest('tr').children('td').eq(1).text();

        $(modalDel).find('.modal-body input').val('');

        $('#modalDel').modal('show');
        $('.modal-body').find('input[name="id"]').val(id);
        $('.modal-body').find('input[name="name"]').val(name);

        $('#modalDel .modal-footer').on('click', '.confirmDel', function () {
            $.post('/Web_HaiTrieu/category/delete', {
                'id': id
            }, (d) => {
                if (d.del === false) {
                    var error = $('.error');
                    error.text('Không thể xóa danh mục này!');
                    setTimeout(function () {
                        error.text('');
                    }, 2000);
                } else {
                    window.location.href = '/Web_HaiTrieu/category/index';
                }
            });
        });
    });
});