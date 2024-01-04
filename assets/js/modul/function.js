
function submit_form(element, id_form, num = 0, urlplus = '', draging = false, confirm = false, url_pengganti = null) {

    if (confirm == true) {
        var message = $(element).data('message');
        if (!message) {
            $message = 'Yakin akan melanjutkan aksi?';
        }

        Swal.fire({
            text: message,
            icon: 'question',
            showCancelButton: true,
            buttonsStyling: !1,
            confirmButtonText: "Lanjutkan",
            customClass: {
                confirmButton: css_btn_confirm,
                cancelButton: css_btn_cancel
            },
            reverseButtons: true
        }).then((function (t) {
            if (t.isConfirmed) {
                proses_form(element, id_form, num, urlplus, draging, url_pengganti);
            }
        }));
    } else {
        proses_form(element, id_form, num, urlplus, draging, url_pengganti);
    }
}

function proses_form(element, id_form, num, urlplus = '', draging = false, url_pengganti = null) {
    if (draging == true) {
        var drag = document.getElementById('sistem_drag');
        var filter = document.getElementById('sistem_filter');
    }
    // console.log('ok');
    var text_button = document.getElementById(element.id).innerHTML;
    if (url_pengganti == null) {
        var url = $(id_form).attr('action') + urlplus;
    } else {
        var url = url_pengganti + urlplus;
    }

    var method = $(id_form).attr('method');
    // console.log(url);
    var form = $('form')[num];
    var form_data = new FormData(form);

    // console.log(url, method, form, form_data);
    $.ajax({
        url: url,
        method: method,
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            $('#' + element.id).prop('disabled', true);
            $('#' + element.id).html('Tunggu Sebentar...');


        },
        success: function (data) {
            // console.log(data);
            $('.fadedin').remove();
            if (data.etc != null) {
                for (var a = 0; a < data.etc.length; a++) {
                    data.etc[a]
                }
            }
            if (data.load != null) {
                for (var a = 0; a < data.load.length; a++) {
                    $(data.load[a].parent).load(data.load[a].reload);
                }
                // window.history.pushState('', '', BASE_URL + page);
            }
            $('#' + element.id).prop('disabled', false);
            $('#' + element.id).html(text_button);

            if (data.status == 200 || data.status == true) {
                if (draging == true) {
                    drag.classList.add('d-none');
                    filter.classList.remove('d-none');
                }
                if (data.input) {
                    if (data.input.password) {
                        $(id_form).find("input[type=password]").val("");
                    }
                    if (data.input.text) {
                        $(id_form).find("input[type=text]").val("");
                    }
                    if (data.input.number) {
                        $(id_form).find("input[type=number]").val("");
                    }
                    if (data.input.textarea) {
                        $(id_form).find("textarea").val("");
                    }

                    if (data.input.all) {
                        // var sel = $(id_form + ' select option[value=all]');
                        $(id_form + ' input[type=text]').val("");
                        $(id_form + ' input[type=password]').val("");
                        $(id_form + ' input[type=number]').val("");
                        $(id_form + ' select').val("");
                        $(id_form + ' textarea').val("");
                    }

                }
                if (data.ubah_sandi) {
                    if (data.ubah_sandi == 1) {
                        batalkan_kata_sandi();
                    }
                }


                var icon = 'success';
            } else {
                var icon = 'warning';
            }
            if (data.alert) {
                Swal.fire({
                    html: data.alert.message,
                    icon: icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: css_btn_confirm
                    }
                }).then(function () {
                    if (data.redirect) {
                        location.href = data.redirect;
                    }
                    if (data.reload == true) {
                        location.reload();
                    }
                    if (data.modal != null) {
                        $(data.modal.id).modal(data.modal.action);
                    }
                    if (data.element != null) {
                        const row = data.element.length;
                        for (var i = 0; i < row; i++) {
                            $(data.element[i].row).html(data.element[i].value);
                        }
                    }

                    if (data.page_input == true) {
                        rst_penduduk('#form_cari_penduduk');
                    }
                });
            } else {
                if (data.required) {
                    // console.log(data.required);
                    const array = data.required.length;
                    for (var i = 0; i < array; i++) {
                        $('#' + data.required[i][0]).append('<span class="text-danger size-12 fadedin">' + data.required[i][1] + '</span>');
                        // console.log(data.required[i][0]);
                    }

                }

                if (data.redirect) {
                    location.href = data.redirect;
                }
                if (data.modal != null) {
                    $(data.modal.id).modal(data.modal.action);
                }

                if (data.reload == true) {
                    location.reload();
                }
            }
        }
    });
}

function hapus_data(e, id, url = '', text = '') {
    e.preventDefault();
    var message = 'Anda yakin akan menghapus data ' + text + '? Data yang dihapus tidak akan bisa dipulihkan';
    const icon = 'question';
    Swal.fire({
        text: message,
        icon: icon,
        showCancelButton: true,
        buttonsStyling: !1,
        confirmButtonText: "Lanjutkan",
        customClass: {
            confirmButton: css_btn_confirm,
            cancelButton: css_btn_cancel
        },
        reverseButtons: true
    }).then((function (t) {
        if (t.isConfirmed) {
            $.ajax({
                url: BASE_URL + url,
                method: 'POST',
                data: { id: id },
                cache: false,
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    if (data.status == 200 || data.status == true) {
                        if (data.alert) {
                            Swal.fire({
                                html: data.alert.message,
                                icon: data.alert.icon,
                                buttonsStyling: !1,
                                confirmButtonText: 'Ok',
                                customClass: { confirmButton: css_btn_confirm }
                            });
                        }
                        var uri = window.location.search;
                        $('#base_table').load(BASE_URL + page + uri + ' #reload_table');
                        window.history.pushState('', '', BASE_URL + page + uri);
                    } else {
                        Swal.fire({
                            html: data.alert.message,
                            icon: 'warning',
                            buttonsStyling: !1,
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            })
        }
    }))
}

function preview_image(img) {
    // console.log(img);
    $('#preview_preview_image').attr('src', img);
    $('#modal_preview_all').modal('show');
}



function switch_modal(id, id2) {
    // var scrollBarWidth = window.innerWidth - document.body.offsetWidth;
    // $('body').css({
    //     marginRight: scrollBarWidth,
    //     overflow: 'hidden'
    // });

    $('#' + id).modal('hide');
    $('#' + id2).modal('show');

    document.getElementById("main_body").style.paddingRight = "0px";
}


function confirm_alert(element, e, message = 'Konfirmasi', url = null, method = 'POST', data, checkbox = false) {
    var data_param = $(element).data();
    console.log(data_param);
    var href = $(element).attr('href');
    e.preventDefault();
    const icon = 'question';
    Swal.fire({
        text: message,
        icon: icon,
        showCancelButton: true,
        buttonsStyling: !1,
        confirmButtonText: "Lanjutkan",
        customClass: {
            confirmButton: css_btn_confirm,
            cancelButton: css_btn_cancel
        },
        reverseButtons: true
    }).then((function (t) {
        if (t.isConfirmed) {
            if (url != null) {
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        if (data.status == 200 || data.status == true) {
                            if (checkbox == true) {
                                $(this).prop('checked', true);
                            }
                            if (data.alert) {
                                Swal.fire({
                                    html: data.alert.message,
                                    icon: data.alert.icon,
                                    buttonsStyling: !1,
                                    confirmButtonText: 'Ok',
                                    customClass: { confirmButton: css_btn_confirm }
                                });
                            }
                            if (data.reload) {
                                location.reload();
                            }
                            if (data.redirect) {
                                location.href = data.redirect;
                            }
                        } else {
                            Swal.fire({
                                html: data.alert.message,
                                icon: 'warning',
                                buttonsStyling: !1,
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                })
            } else {
                var param = '';
                if (data_param) {
                    var i = 0;
                    Object.keys(data_param).forEach(key => {
                        i++;
                        if (i == 1) {
                            param += '?' + key + '=' + data_param[key];
                        } else {
                            param += '&' + key + '=' + data_param[key];
                        }
                    });
                }
                document.location.href = href + param;

                console.log(href + param);
            }
        }
    }))
}

function redirect(halaman) {
    location.href = BASE_URL + halaman;
}

