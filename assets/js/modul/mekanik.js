$(function () {
    if ($('.search_mekanik input[type="search"]')) {
        var i = document.querySelector('.search_mekanik i');
        var button = document.querySelector('.search_mekanik button');
        var input = document.querySelector('.search_mekanik input');
        $('.search_mekanik input[type="search"]').on('keyup', function () {
            var value = $(this).val();
            if (value != '') {
                i.classList.add('d-none');
                input.classList.remove('ps-13');
                button.classList.remove('d-none');
                $('.search_mekanik button').attr('disabled', false);
            } else {
                i.classList.remove('d-none');
                input.classList.add('ps-13');
                button.classList.add('d-none');
                $('.search_mekanik button').attr('disabled', true);
            }
        })
    }


});

function checked_action(element, child = 'child_checkbox') {
    var drag = document.getElementById('sistem_drag');
    var filter = document.getElementById('sistem_filter');
    if ($(element).is(':checked')) {
        drag.classList.remove('d-none');
        filter.classList.add('d-none');
        $('.' + child).prop('checked', true);
    } else {
        drag.classList.add('d-none');
        filter.classList.remove('d-none');
        $('.' + child).prop('checked', false);
    }


}

function child_checked() {
    var drag = document.getElementById('sistem_drag');
    var filter = document.getElementById('sistem_filter');

    var total = $('.child_checkbox').length;
    var total_checked = $('input.child_checkbox:checked').length;
    if (total_checked == total) {
        $('thead input[type=checkbox]').prop('checked', true);
    } else {
        $('thead input[type=checkbox]').prop('checked', false);
    }
    if ($(this).is(':checked')) {
        if (total_checked > 0) {
            drag.classList.remove('d-none');
            filter.classList.add('d-none');
        } else {
            drag.classList.add('d-none');
            filter.classList.remove('d-none');

        }

    } else {
        if (total_checked > 0) {
            drag.classList.remove('d-none');
            filter.classList.add('d-none');
        } else {
            drag.classList.add('d-none');
            filter.classList.remove('d-none');
        }
    }
}
function search() {
    var src = $('.search_mekanik input[name=search]').val();
    src = src.split(" ");
    var value = '';
    var no = 0;
    src.forEach(val => {
        if (no++ > 0) {
            value += '--';
        }
        value += val
    });
    var get = url_get();
    var params = '';
    if (get.length > 0) {
        if (get[0].split('=')[0] != 'search') {
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'search') {
                    if (i == 0) {
                        params += '?' + get[i];
                    } else {
                        params += '&' + get[i];
                    }
                }

            }
            params += '&search=' + value;
        } else {
            params += '?search=' + value;
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'search') {
                    params += '&' + get[i];
                }
            }
        }
    } else {

        params = '?search=' + value;
    }

    var uri = BASE_URL + page + params;
    var cetak = BASE_URL + PRINT + params;
    $('#cetak_excel').attr('href', cetak);
    window.history.pushState('', '', uri);
    $('#base_table').load(uri + ' #reload_table');

}

function filter(name = []) {
    var get = url_get();
    var params = '';
    if (name.length > 0) {

        if (get.length > 0) {
            params += '?';
            // fruits.includes("Mango");
            for (var i = 0; i < get.length; i++) {
                if (!name.includes(get[i].split('=')[0])) {
                    params += get[i] + '&';
                }
            }
            for (var i = 0; i < name.length; i++) {
                params += name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val() + '&';
            }
        } else {
            for (var i = 0; i < name.length; i++) {
                if (i == 0) {
                    params += '?' + name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val();
                } else {
                    params += '&' + name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val();
                }

            }
        }
        var uri = BASE_URL + page + params;
        var cetak = BASE_URL + PRINT + params;
        $('#cetak_excel').attr('href', cetak);
        window.history.pushState('', '', uri);
        $('.filter_mekanik').hide();
        $('#base_table').load(uri + ' #reload_table');
    }
}
function url_get() {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    var data = [];
    for (var i = 0; i < sURLVariables.length; i++) {
        if (sURLVariables[i] != '') {
            data[i] = sURLVariables[i]
        }

    }
    return data;
}

function pagination(element, e, non = 1) {
    if (non == 1) {
        var drag = document.getElementById('sistem_drag');
        var filter = document.getElementById('sistem_filter');
    }

    var uri = window.location.search;
    e.preventDefault();
    var child = $(element).children("a");
    var href = child.attr("href");
    if (uri) {
        var url = href + uri;
    } else {
        var url = href;
    }
    // console.log(url);
    $('#base_table').load(url + ' #reload_table');
    window.history.pushState('', '', url);
    if (non == 1) {
        drag.classList.add('d-none');
        filter.classList.remove('d-none');
    }

}