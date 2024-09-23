$(document).ready(function () {

    //Xử lý yêu thích
    favorites();

    var pagesMen = $('input[name="men"]').val();
    var pagesWomen = $('input[name="women"]').val();
    var pagesCouple = $('input[name="couple"]').val();

    loadData(btnMen, 1, rsM, pagesMen);
    loadData(btnWomen, 2, rsWM, pagesWomen);
    loadData(btnCouple, 3, rsC, pagesCouple);

    function loadData(btnClick, categoryId, resualt, page) {
        let p = 1;
        let c = categoryId;
        $(btnClick).click(function () {
            p++;
            NProgress.start();
            $.post('/Web_HaiTrieu/home/getData', {
                'p': p,
                'c': c
            }, (d) => {
                //console.log(d);
                for (let i in d) {
                    var price = parseInt(d[i]['Price']).toLocaleString('de-DE');
                    $(resualt).append(`
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <input type="hidden" name="id" value="${d[i]['ProductId']}">
                        <img class="img-fluid w-100" src="/Web_HaiTrieu/public/images/product/${d[i]['ImageUrl']}" alt="${d[i]['ProductName']}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="/Web_HaiTrieu/cart/add/${d[i]['ProductId']}"><i class="fa fa-shopping-cart"></i></a>
                            <a class="favorite btn btn-outline-dark btn-square"><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate d-block" href="/Web_HaiTrieu/home/detail/${d[i]['ProductId']}">${d[i]['ProductName']}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>${price} ₫</h5>
                            <!--<h6 class="text-muted ml-2"><del>$123.00</del></h6>-->
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div> 
                `)
                    favorites(); //gọi hàm xử lý yêu thích
                }
            });
            if (p >= page) {
                $(btnClick).hide();
            }
            NProgress.done();
        });
    }

    function favorites() {
        $('.product-action .favorite').on('click', function () {
            let id = $(this).parent().parent().find('input[name="id"]').val();

            NProgress.start();
            $.post('/Web_HaiTrieu/home/doFavorite/', { 'id': id }, (d) => {
                if (d === 1) {
                    location.reload();
                } else if (d['favorites'] === false) {
                    window.location.href = '/Web_HaiTrieu/auth';
                }
            });
            NProgress.done();
        });
    }
});