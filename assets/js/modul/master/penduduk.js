
$(function () {

    $('.hps_foto_pendukung').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_foto_pendukung]').val("");
    });

    $('.hps_foto_ktp').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_foto_ktp]').val("");
    });

});


function edit_penduduk(element, id) {
    $('.fadedin').remove();
    var foto_pendukung = document.getElementById('display_foto_pendukung');
    var foto_ktp = document.getElementById('display_foto_ktp');
    var form = document.getElementById('form_penduduk');
    $('#title_modal').text('Ubah Data Penduduk');
    form.setAttribute('action', BASE_URL + 'master_function/ubah_penduduk');
    var ajx_fp = $(element).data('foto_pendukung');
    var ajx_fk = $(element).data('foto_ktp');
    $.ajax({
        url: BASE_URL + 'master/get_single_penduduk',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            foto_pendukung.style.backgroundImage = "url('" + ajx_fp + "')";
            foto_ktp.style.backgroundImage = "url('" + ajx_fk + "')";
            $('input[name="id_penduduk"]').val(data.id_penduduk);
            $('input[name="nama"]').val(data.nama);
            $('input[name="nik"]').val(data.nik);
            $('input[name="nama_foto_pendukung"]').val(data.foto_pendukung);
            $('input[name="nama_foto_ktp"]').val(data.foto_ktp);
            $('input[name="email"]').val(data.email);
            $('input[name="notelp"]').val(data.notelp);
            $('input[name="umur"]').val(data.umur);
            $('select[name="gender"]').val(data.gender);
            $('select[name="gender"]').trigger('change');
            $('input[name="rt"]').val(data.rt);
            $('input[name="rw"]').val(data.rw);
            $('textarea[name="alamat"]').val(data.alamat);
            $('select[name="id_kelurahan"]').val(data.id_kelurahan);
            $('select[name="id_kelurahan"]').trigger('change');
        }
    })
}

function tambah_penduduk() {
    $('.fadedin').remove();
    var foto_pendukung = document.getElementById('display_foto_pendukung');
    var foto_ktp = document.getElementById('display_foto_ktp');
    var base_foto = BASE_URL + 'data/default/';
    var form = document.getElementById('form_penduduk');
    form.setAttribute('action', BASE_URL + 'master_function/tambah_penduduk');
    $('#title_modal').text('Tambah Penduduk');
    foto_pendukung.style.backgroundImage = "url('" + base_foto + "user.jpg')";
    foto_ktp.style.backgroundImage = "url('" + base_foto + "env.jpg')";
    $('#form_penduduk input').val('');
    $('#form_penduduk textarea').val('');
    $('#form_penduduk select').val('');
    $('#form_penduduk select').trigger('change');

}

function detail_penduduk(element, id) {
    var gender = '';
    var ajx_fp = $(element).data('foto_pendukung');
    var ajx_fk = $(element).data('foto_ktp');
    var foto_pendukung = document.getElementById('detail_foto_pendukung');
    var foto_ktp = document.getElementById('detail_foto_ktp');
    $.ajax({
        url: BASE_URL + 'master/get_single_penduduk',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            foto_pendukung.style.backgroundImage = "url('" + ajx_fp + "')";
            if (data.foto_ktp != null) {
                $('#base_foto_ktp').removeClass('d-none');
                foto_ktp.style.backgroundImage = "url('" + ajx_fk + "')";
            } else {
                $('#base_foto_ktp').addClass('d-none');
            }

            $('span[data-value=id_penduduk]').text(data.id_penduduk);
            $('span[data-value=nama]').text(data.nama);
            $('span[data-value=nik]').text(data.nik);
            $('span[data-value=nama_foto_pendukung]').text(data.foto_pendukung);
            $('span[data-value=nama_foto_ktp]').text(data.foto_ktp);
            $('span[data-value=email]').text(data.email);
            $('span[data-value=notelp]').text(data.notelp);
            $('span[data-value=umur]').text(data.umur);
            if (data.gender == 'P') {
                gender = 'Perempuan';
            } else if (data.gender == 'L') {
                gender = 'Laki-laki';
            }
            $('span[data-value=gender]').text(gender);
            $('span[data-value=rt_rw]').text(data.rt + '/' + data.rw);
            $('span[data-value=alamat]').text(data.alamat);
            $('span[data-value=id_kelurahan]').text(data.kelurahan);
            if (data.status == 1) {
                $('span[data-value=status]').addClass('badge-danger');
                $('span[data-value=status]').removeClass('badge-success');
                $('span[data-value=status]').text('Belum Didatangi');
            } else {
                $('span[data-value=status]').removeClass('badge-danger');
                $('span[data-value=status]').addClass('badge-success');
                $('span[data-value=status]').text('Sudah Didatangi oleh ' + data.taken);
            }
            if (data.new_data == 'Y') {
                $('span[data-value=new_data]').removeClass('badge-warning');
                $('span[data-value=new_data]').addClass('badge-success');
                $('span[data-value=new_data]').html('Data External </br>by ' + data.created);
            } else {
                $('span[data-value=new_data]').addClass('badge-warning');
                $('span[data-value=new_data]').removeClass('badge-success');
                $('span[data-value=new_data]').text('Data Internal');
            }
        }
    });

}

function add_pendukung(element, id) {
    var foto_pendukung = document.getElementById('display_foto_pendukung_2');
    var foto_ktp = document.getElementById('display_foto_ktp_2');
    var ajx_fp = $(element).data('foto_pendukung');
    var ajx_fk = $(element).data('foto_ktp');
    $.ajax({
        url: BASE_URL + 'master/get_single_penduduk',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            foto_pendukung.style.backgroundImage = "url('" + ajx_fp + "')";
            foto_ktp.style.backgroundImage = "url('" + ajx_fk + "')";
            $('#form_pendukung input[name="id_penduduk"]').val(data.id_penduduk);
            $('#form_pendukung input[name="nama"]').val(data.nama);
            $('#form_pendukung input[name="nik"]').val(data.nik);
            $('#form_pendukung input[name="nama_foto_pendukung"]').val(data.foto_pendukung);
            $('#form_pendukung input[name="nama_foto_ktp"]').val(data.foto_ktp);
            $('#form_pendukung input[name="notelp"]').val(data.notelp);
            $('#form_pendukung select[name="gender"]').val(data.gender);
            $('#form_pendukung select[name="gender"]').trigger('change');
        }
    })
}

function get_tps(element, place) {
    var id_kelurahan = $(element).val();
    if (id_kelurahan != 'all' && id_kelurahan != '') {
        $.ajax({
            url: BASE_URL + 'master/get_tps',
            method: 'POST',
            data: { id_kelurahan: id_kelurahan },
            cache: false,
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $(place).html(data.option);
            }
        });
    } else {
        $(place).html('<option value="all">Pilih kelurahan lebih dulu</option>');
    }

}