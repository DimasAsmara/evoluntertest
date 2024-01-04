function page(page) {
    window.history.pushState('', '', BASE_URL + 'import?page=' + page);
    $('#bread_title').text(page.charAt(0).toUpperCase() + page.slice(1))
}


function get_tps(element, place) {
    var id_kelurahan = $(element).val();
    if (id_kelurahan != 'all' && id_kelurahan != '') {
        $.ajax({
            url: BASE_URL + 'master/get_tps/n',
            method: 'POST',
            data: { id_kelurahan: id_kelurahan },
            cache: false,
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $(place).data('placeholder', 'Pilih TPS')
                $(place).html(data.option);
            }
        });
    } else {
        $(place).data('placeholder', 'Pilih Kelurahan Dahulu')
    }

}