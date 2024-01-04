function edit_wilayah(element, id) {
    $('.fadedin').remove();
    var form = document.getElementById('form_wilayah');
    $('#title_modal').text('Ubah Data Kelurahan');
    form.setAttribute('action', BASE_URL + 'master_function/ubah_wilayah');
    $.ajax({
        url: BASE_URL + 'master/get_single_wilayah',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            $('input[name="id_kelurahan"]').val(data.id_kelurahan);
            $('input[name="nama"]').val(data.nama);
            $('input[name="jumlah_tps"]').val(data.jumlah_tps);
        }
    })
}

function modal_relawan(element, id) {
    $.ajax({
        url: BASE_URL + 'master/get_relawan_wilayah',
        method: 'POST',
        data: { id: id },
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (msg) {
            $('#display_content').html(msg);
        }
    })
}

function tambah_wilayah() {
    $('.fadedin').remove();
    var form = document.getElementById('form_wilayah');
    form.setAttribute('action', BASE_URL + 'master_function/tambah_wilayah');
    $('#title_modal').text('Tambah Kelurahan');
    $('#form_wilayah input').val('');
    $('#form_wilayah select').val('');
    $('#form_wilayah select').trigger('change');
}

function choose_relawan(element, id, two = false) {
    if ($(element).is(':checked')) {
        if (two == false) {
            $('label[for=check-' + id + ']').addClass('bg-light-primary border-primary');
        } else {
            $('label[for=check-2-' + id + ']').addClass('bg-light-danger border-danger');
        }

    } else {
        if (two == false) {
            $('label[for=check-' + id + ']').removeClass('bg-light-primary border-primary');
        } else {
            $('label[for=check-2-' + id + ']').removeClass('bg-light-danger border-danger');
        }
    }
}

function filter_relawan(element) {
    var unfree = document.querySelectorAll('#list_relawan div[data-free=false]');
    var free = document.querySelectorAll('#list_relawan div[data-free=true]');

    if ($(element).is(':checked')) {
        if (unfree.length > 0) {
            unfree.forEach((div) => {
                div.classList.add("hidin");
                div.classList.remove("showin");
            });
        }
        if (free.length > 0) {
            $('#display_vector').addClass('hidin');
            $('#display_vector').removeClass('showin d-flex justify-content-center align-items-center flex-column');
        } else {
            $('#display_vector').addClass('showin d-flex justify-content-center align-items-center flex-column');
            $('#display_vector').removeClass('hidin');
        }
    } else {
        if (unfree.length > 0) {
            unfree.forEach((div) => {
                div.classList.remove("hidin");
                div.classList.add("showin");
            });
            $('#display_vector').addClass('hidin');
            $('#display_vector').removeClass('showin d-flex justify-content-center align-items-center flex-column');
        } else {
            if (free.length > 0) {
                $('#display_vector').addClass('hidin');
                $('#display_vector').removeClass('showin d-flex justify-content-center align-items-center flex-column');
            } else {
                $('#display_vector').addClass('showin d-flex justify-content-center align-items-center flex-column');
                $('#display_vector').removeClass('hidin');
            }
        }
    }


}


function switch_content_relawan(action = 'add') {

    var jmlh_shooter = $('#relawan_shooter').children("div").length;
    var jmlh_other = $('#relawan_other').children("div").length;

    if (action == 'see') {
        if (jmlh_shooter <= 0) {
            $('#display_vector').removeClass('hidin');
            $('#display_vector').addClass('showin d-flex justify-content-center align-items-center flex-column');
        } else {
            $('#display_vector').addClass('hidin');
            $('#display_vector').removeClass('showin d-flex justify-content-center align-items-center flex-column');
        }
        $('#display_relawan').addClass('hidin');
        $('#display_relawan').removeClass('showin');
        $('#display_add_relawan').addClass('showin');
        $('#display_add_relawan').removeClass('hidin');

        $('#relawan_shooter').addClass('showin');
        $('#relawan_shooter').removeClass('hidin');
        $('#relawan_other').addClass('hidin');
        $('#relawan_other').removeClass('showin');
    }

    if (action == 'add') {
        if (jmlh_other <= 0) {
            $('#display_vector').removeClass('hidin');
            $('#display_vector').addClass('showin d-flex justify-content-center align-items-center flex-column');
        } else {
            $('#display_vector').addClass('hidin');
            $('#display_vector').removeClass('showin d-flex justify-content-center align-items-center flex-column');
        }

        $('#display_relawan').removeClass('hidin');
        $('#display_relawan').addClass('showin');
        $('#display_add_relawan').removeClass('showin');
        $('#display_add_relawan').addClass('hidin');

        $('#relawan_shooter').removeClass('showin');
        $('#relawan_shooter').addClass('hidin');
        $('#relawan_other').removeClass('hidin');
        $('#relawan_other').addClass('showin');
    }
}
