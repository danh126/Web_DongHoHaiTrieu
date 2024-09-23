function pagination(active, numPage, pages) {
    $($('ul.pagination li.page')[active]).addClass('active');
    let page = numPage;
    let totalPage = pages;
    if (page == 1) {
        $($('ul.pagination li.page-prev')).remove();
    }
    if (page == totalPage) {
        $($('ul.pagination li.page-next')).remove();
    }
}
