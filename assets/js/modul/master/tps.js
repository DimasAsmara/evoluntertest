function pengaturan_tps(id, jmlh) {
    $('.fadedin').remove();
    $('#title_modal').text('Pengaturan TPS');
    $('input[name="id_kelurahan"]').val(id);
    $('input[name="jumlah_tps"]').val(jmlh);
}
function get_kelurahan(element) {
    var value = $(element).val();
    var get = url_get();
    var params = '';
    if (get.length > 0) {
        if (get[0].split('=')[0] != 'id_kelurahan') {
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'id_kelurahan') {
                    $('#cetak_excel').attr('data-' + get[i].split('=')[0], get[i].split('=')[1]);
                    if (i == 0) {
                        params += '?' + get[i];
                    } else {
                        params += '&' + get[i];
                    }
                }

            }
            $('#cetak_excel').attr('data-id_kelurahan', value);
            params += '&id_kelurahan=' + value;
        } else {
            $('#cetak_excel').attr('data-id_kelurahan', value);
            params += '?id_kelurahan=' + value;
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'id_kelurahan') {
                    $('#cetak_excel').attr('data-' + get[i].split('=')[0], get[i].split('=')[1]);
                    params += '&' + get[i];
                }
            }
        }
    } else {
        $('#cetak_excel').attr('data-id_kelurahan', value);
        params = '?id_kelurahan=' + value;
    }

    var uri = BASE_URL + page + params;
    window.history.pushState('', '', uri);
    $('#base_table').load(uri + ' #reload_table');
}

function modal_warga(element, id, id_kelurahan) {
    $.ajax({
        url: BASE_URL + 'master/get_warga_tps',
        method: 'POST',
        data: { id: id, id_kelurahan: id_kelurahan },
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (msg) {
            $('#display_content').html(msg);
        }
    })
}

function choose_warga(element, id, two = false) {
    if ($(element).is(':checked')) {
        if (two == false) {
            $('label[for=check-' + id + ']').addClass('bg-light-danger border-danger');
        } else {
            $('label[for=check-2-' + id + ']').addClass('bg-light-primary border-primary');
        }

    } else {
        if (two == false) {
            $('label[for=check-' + id + ']').removeClass('bg-light-danger border-danger');
        } else {
            $('label[for=check-2-' + id + ']').removeClass('bg-light-primary border-primary');
        }
    }
}

function switch_content_warga(action = 'add') {

    var warga_tps = $('#warga_tps').children("div").length;
    var warga_non = $('#warga_non_tps').children("div").length;

    if (action == 'see') {
        if (warga_tps <= 0) {
            $('#display_vector').removeClass('hidin');
            $('#display_vector').addClass('showin d-flex justify-content-center align-items-center flex-column');

            //  ACTION
            $('#action_hapus').addClass('hidin');
            $('#action_hapus').removeClass('d-flex justify-content-between showin');

            $('#action_tambah').addClass('hidin');
            $('#action_tambah').removeClass('d-flex justify-content-between showin');
        } else {
            $('#display_vector').addClass('hidin');
            $('#display_vector').removeClass('showin d-flex justify-content-center align-items-center flex-column');

            //  ACTION
            $('#action_hapus').removeClass('hidin');
            $('#action_hapus').addClass('d-flex justify-content-between showin');

            $('#action_tambah').addClass('hidin');
            $('#action_tambah').removeClass('d-flex justify-content-between showin');
        }



        // BUTTON
        $('#btn_kembali').addClass('hidin');
        $('#btn_kembali').removeClass('showin');


        $('#btn_tambah').addClass('showin');
        $('#btn_tambah').removeClass('hidin');

        // HEADLINE
        $('#terdaftar').addClass('showin');
        $('#terdaftar').removeClass('hidin');


        $('#nondaftar').addClass('hidin');
        $('#nondaftar').removeClass('showin');

        // CONTENT
        $('#warga_tps').addClass('showin');
        $('#warga_tps').removeClass('hidin');


        $('#warga_non_tps').addClass('hidin');
        $('#warga_non_tps').removeClass('showin');
    }

    if (action == 'add') {
        if (warga_non <= 0) {
            $('#display_vector').removeClass('hidin');
            $('#display_vector').addClass('showin d-flex justify-content-center align-items-center flex-column');

            //  ACTION
            $('#action_hapus').addClass('hidin');
            $('#action_hapus').removeClass('d-flex justify-content-between showin');

            $('#action_tambah').addClass('hidin');
            $('#action_tambah').removeClass('d-flex justify-content-between showin');

        } else {
            $('#display_vector').addClass('hidin');
            $('#display_vector').removeClass('showin d-flex justify-content-center align-items-center flex-column');

            // ACTION
            $('#action_hapus').addClass('hidin');
            $('#action_hapus').removeClass('d-flex justify-content-between showin');

            $('#action_tambah').removeClass('hidin');
            $('#action_tambah').addClass('d-flex justify-content-between showin');
        }





        // BUTTON
        $('#btn_kembali').removeClass('hidin');
        $('#btn_kembali').addClass('showin');


        $('#btn_tambah').removeClass('showin');
        $('#btn_tambah').addClass('hidin');

        // HEADLINE
        $('#terdaftar').addClass('hidin');
        $('#terdaftar').removeClass('showin');


        $('#nondaftar').addClass('showin');
        $('#nondaftar').removeClass('hidin');

        // CONTENT
        $('#warga_tps').addClass('hidin');
        $('#warga_tps').removeClass('showin');


        $('#warga_non_tps').addClass('showin');
        $('#warga_non_tps').removeClass('hidin');
    }
}

function filter_warga(element, child = 'hps_row') {
    if ($(element).is(':checked')) {
        // console.log('checked');
        $('.' + child).prop('checked', true);
        $('.' + child).trigger('change');
    } else {
        $('.' + child).prop('checked', false);
        $('.' + child).trigger('change');
        // console.log('uncheck')
    }


}