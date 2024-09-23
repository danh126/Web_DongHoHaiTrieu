function pagination(active, numPage, pages) {
    $($('ul.pagination #page')[active]).addClass('active');
    let page = numPage;
    let $totalPage = pages;
    if (page == 1) {
        $('#Previous').remove();
    }
    if (page == $totalPage) {
        $('#Next').remove();
    }
}