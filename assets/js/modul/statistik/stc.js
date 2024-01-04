function get_kelurahan(element) {
    var value = $(element).val();
    var get = url_get();
    var params = '';
    if (get.length > 0) {
        if (get[0].split('=')[0] != 'id_kelurahan') {
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'id_kelurahan') {
                    if (i == 0) {
                        params += '?' + get[i];
                    } else {
                        params += '&' + get[i];
                    }
                }

            }
            params += '&id_kelurahan=' + value;
        } else {
            params += '?id_kelurahan=' + value;
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'id_kelurahan') {
                    $('#cetak_excel').attr('data-' + get[i].split('=')[0], get[i].split('=')[1]);
                    params += '&' + get[i];
                }
            }
        }
    } else {
        params = '?id_kelurahan=' + value;
    }

    var uri = BASE_URL + page + params;
    window.location.href = uri;
}


function get_date(element) {
    var value = $(element).val();
    var get = url_get();
    var params = '';
    if (get.length > 0) {
        if (get[0].split('=')[0] != 'end_date') {
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'end_date') {
                    if (i == 0) {
                        params += '?' + get[i];
                    } else {
                        params += '&' + get[i];
                    }
                }

            }
            params += '&end_date=' + value;
        } else {
            params += '?end_date=' + value;
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'end_date') {
                    $('#cetak_excel').attr('data-' + get[i].split('=')[0], get[i].split('=')[1]);
                    params += '&' + get[i];
                }
            }
        }
    } else {
        params = '?end_date=' + value;
    }

    var uri = BASE_URL + page + params;
    window.location.href = uri;
}

function get_relawan(element) {
    var value = $(element).val();
    var get = url_get();
    var params = '';
    if (get.length > 0) {
        if (get[0].split('=')[0] != 'id_relawan') {
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'id_relawan') {
                    if (i == 0) {
                        params += '?' + get[i];
                    } else {
                        params += '&' + get[i];
                    }
                }

            }
            params += '&id_relawan=' + value;
        } else {
            params += '?id_relawan=' + value;
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'id_relawan') {
                    $('#cetak_excel').attr('data-' + get[i].split('=')[0], get[i].split('=')[1]);
                    params += '&' + get[i];
                }
            }
        }
    } else {
        params = '?id_relawan=' + value;
    }

    var uri = BASE_URL + page + params;
    window.location.href = uri;
}
