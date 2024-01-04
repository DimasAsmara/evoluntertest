const list = document.querySelectorAll('.list-button');
const slide = document.querySelectorAll('.sliding');

function rst_penduduk(id_form) {
    $('#display_value').html('');
    $('#cari_btn').removeClass('hiding');
    $('#reset_btn').addClass('hiding');
    $('#form_add_penduduk').addClass('hiding');
    $('#form_add_penduduk').removeClass('showing');
    $('#form_add_penduduk').removeClass('content-search');
    $(id_form).removeClass('transisi-top');
    $(".slide-layout .sliding").animate({ scrollTop: 0 }, "slow");
    $('#form_add_penduduk input').val('');
    $('#form_add_penduduk select').val('');
    $('.hps').click();
}

function batalkan_form() {
    $('#display_value').removeClass('hiding');
    $('#display_value').addClass('showing');
    $('#form_add_penduduk').addClass('hiding');
    $('#form_add_penduduk').removeClass('showing');
    $('#form_add_penduduk').removeClass('content-search');
    $('#form_add_penduduk input').val('');
    $('#form_add_penduduk select').val('');
    $(".slide-layout .sliding").animate({ scrollTop: 0 }, "slow");
    $('.hps').click();
}
function to_kata_sandi() {
    $('#form_ubah_sandi').removeClass('hiding');
    $('#form_ubah_sandi').addClass('showing');
    $('#form_ubah_sandi').addClass('form_input');
    $('#form_ubah_sandi input').val('');
    $('#dtl_prf').addClass('hiding');
    $('#dtl_prf').removeClass('showing');
    $(".slide-layout .sliding").animate({ scrollTop: 0 }, "slow");
}

function to_list_pendukung() {
    $('#pendukung_list').removeClass('hiding');
    $('#pendukung_list').addClass('showing');
    $('#pendukung_list').addClass('listpend');
    $('#dtl_prf').addClass('hiding');
    $('#dtl_prf').removeClass('showing');
    $(".slide-layout .sliding").animate({ scrollTop: 0 }, "slow");
}
function batalkan_kata_sandi() {
    $('#form_ubah_sandi').addClass('hiding');
    $('#form_ubah_sandi').removeClass('showing');
    $('#form_ubah_sandi').removeClass('form_input');
    $('#form_ubah_sandi input').val('');
    $('#dtl_prf').removeClass('hiding');
    $('#dtl_prf').addClass('showing');
    $(".slide-layout .sliding").animate({ scrollTop: 0 }, "slow");
}
function batalkan_pendukung() {
    $('#pendukung_list').addClass('hiding');
    $('#pendukung_list').removeClass('showing');
    $('#pendukung_list').removeClass('listpend');
    $('#dtl_prf').removeClass('hiding');
    $('#dtl_prf').addClass('showing');
    $(".slide-layout .sliding").animate({ scrollTop: 0 }, "slow");
}

function addPendukung(id_penduduk = '', nama = '', nik = '', gender = '') {
    $('#display_value').addClass('hiding');
    $('#display_value').removeClass('showing');
    $('#form_add_penduduk').removeClass('hiding');
    $('#form_add_penduduk').addClass('showing');
    $('#form_add_penduduk').addClass('content-search');
    $('input[name="id_penduduk"]').val(id_penduduk);
    $('input[name="nama2"]').val(nama);
    $('input[name="nik"]').val(nik);
    $('select[name="gender"]').val(gender);
    $(".slide-layout .sliding").animate({ scrollTop: 0 }, "slow");
}


function edit_foto(last_foto) {
    var image = document.getElementById('display_foto');
    var form = $('form')[1];
    var form_data = new FormData(form);
    var url = $('#change_foto').attr('action');
    var method = $('#change_foto').attr('method');
    console.log(url);

    $.ajax({
        url: url,
        method: method,
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if (data.status == 200 || data.status == true) {
                Swal.fire({
                    html: data.alert.message,
                    icon: 'success',
                    buttonsStyling: !1,
                    confirmButtonText: 'Ok',
                    customClass: { confirmButton: css_btn_confirm }
                });
            } else {
                Swal.fire({
                    html: data.alert.message,
                    icon: 'warning',
                    buttonsStyling: !1,
                    confirmButtonText: 'Ok',
                    customClass: { confirmButton: css_btn_confirm }
                });
                image.style.backgroundImage = "url('" + last_foto + "')";
            }
        }
    });
}

function set_penduduk(element, id_form, num = 0) {
    $('.fadedin').remove();
    $id_kelurahan = $(id_form + ' select[name="kelurahan"]').val();
    $nama = $(id_form + ' input[name="nama"]').val();
    var arr = [];
    if (!$id_kelurahan || $id_kelurahan == '') {
        $('#req_kelurahan').append('<span class="text-required fadedin">Kelurahan tidak boleh kosong!</span>');
        arr[0] = false;
    } else {
        arr[0] = true;
    }
    if (!$nama || $nama == '') {
        $('#req_nama').append('<span class="text-required fadedin">Nama tidak boleh kosong!</span>');
        arr[1] = false;
    } else {
        arr[1] = true;
    }
    // console.log('ok');
    var text_button = document.getElementById(element.id).innerHTML;
    var url = $(id_form).attr('action');
    var method = $(id_form).attr('method');
    // console.log(url);
    var form = $('form')[num];
    var form_data = new FormData(form);
    if (!inArray(false, arr)) {
        $.ajax({
            url: url,
            method: method,
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#' + element.id).prop('disabled', true);
                $('#' + element.id).html('Tunggu Sebentar...');
            },
            success: function (msg) {
                $('#' + element.id).prop('disabled', false);
                $('#' + element.id).html(text_button);
                $(id_form).addClass('transisi-top');
                $('#cari_btn').addClass('hiding');
                $('#reset_btn').removeClass('hiding');
                $('#display_value').removeClass('hiding');
                $('#display_value').addClass('showing');
                $('#display_value').html(msg);
                $('#form_add_penduduk input').val('');
                $('#form_add_penduduk select').val('');
                $('.hps').click();
            }
        });
    }


}




function activeLink(el, pge = '') {
    if (pge == '') {
        var page = $(el).data('page');
    } else {
        var page = pge;
    }

    slide.forEach((item) => item.classList.remove('active'));
    slide.forEach((item2) => item2.classList.remove('left'));
    slide.forEach((item3) => item3.classList.remove('right'));
    list.forEach((item4) => item4.classList.remove('active'));
    el.classList.add('active');


    $('div[page="' + page + '"]').addClass('active');
    if (page == 'input') {
        $('div[page="home"]').addClass('left');
        $('div[page="profil"]').addClass('right');
    } else if (page == 'profil') {
        $('div[page="home"]').addClass('left');
        $('div[page="input"]').addClass('left');
    } else {
        $('div[page="input"]').addClass('right');
        $('div[page="profil"]').addClass('right');
    }
    batalkan_kata_sandi();
    batalkan_pendukung();
    window.history.pushState('', '', BASE_URL + 'mobile?page=' + page);


    return false;

}


function inArray(needle, haystack) {
    var length = haystack.length;
    for (var i = 0; i < length; i++) {
        if (haystack[i] == needle) return true;
    }
    return false;
}

// list.forEach((item) =>
//     item.addEventListener('click', activeLink));




function get_tps(element, place) {
    var id_kelurahan = $(element).val();
    // console.log(id_kelurahan);
    if (id_kelurahan != 'all' && id_kelurahan != '') {
        $.ajax({
            url: BASE_URL + 'mobile/get_tps',
            method: 'POST',
            data: { id_kelurahan: id_kelurahan },
            cache: false,
            dataType: 'json',
            beforeSend() {
                $(place).html('<option value="">Tunggu sebentar...</option>');
            },
            success: function (data) {

                $(place).html(data.option);
            }
        });
    } else {
        $(place).html('<option value="all">Pilih kelurahan lebih dulu</option>');
    }

}




