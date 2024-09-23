function getFilter(baseURL, filterParams, confirmSelector, minPriceProduct, maxPriceProduct, filterSelector) {
    let params = new URL(window.location.toString()).searchParams;
    let dict = {};

    function dictToURL() {
        let brr = [];
        for (let k in dict) {
            brr.push(`${k}=${encodeURIComponent(dict[k].join(','))}`);
        }
        NProgress.start();
        window.location.href = baseURL + brr.join('&');
        NProgress.done();
    }

    $(confirmSelector).click(function () {
        let priece = $('input[name="price-filter"]');
        let minPrice = $(priece[0]).val();
        let maxPrice = $(priece[1]).val();
        let errorr = $(this).parent().parent().find('.errorr');

        if (minPrice == '' && maxPrice == '') {
            errorr.text('Vui lòng điền khoảng giá phù hợp!');
            setTimeout(function () { errorr.text('') }, 2000);
        } else if (minPrice < minPriceProduct || maxPrice > maxPriceProduct || maxPrice < minPriceProduct || maxPrice < minPrice) {
            errorr.text('Khoảng giá không tồn tại!');
            setTimeout(function () { errorr.text('') }, 2000);
        }
        else {
            dict['price'] = [minPrice, maxPrice];
            dictToURL();
        }
    });

    for (let i in filterParams) {
        let v = params.get(filterParams[i]);
        if (v != null) {
            dict[filterParams[i]] = v.split(',');
        }
    }

    for (let k in dict) {
        for (let i in dict[k]) {
            $(`input[name="${k}"][value="${dict[k][i]}"]`).prop('checked', true);
        }
    }

    $(filterSelector).click(function () {
        let k = $(this).attr('name');
        let v = $(this).val();

        if ($(this).prop('checked')) {
            if (dict[k] == undefined) {
                dict[k] = [v];
            } else {
                dict[k].push(v);
            }
        } else {
            if (dict[k].length == 1) {
                delete dict[k];
            } else {
                dict[k] = dict[k].filter((val) => val != v);
            }
        }
        dictToURL();
    });
}

