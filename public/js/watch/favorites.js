$('.deleteFavorite').on('click', function () {
    let id = $(this).parent().parent().find('input[name="id"]').val();

    NProgress.start();
    $.post('/Web_HaiTrieu/home/deleteFavorite/', {
        'id': id
    }, (d) => {
        if (d === 1) {
            location.reload();
        }
    })
    NProgress.done();
});