<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <div class="card mb-5 mb-xl-8">
                    <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column align-items-start">
                            <!--begin::Title-->
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Relawan</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Relawan</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="d-flex align-items-center position-relative me-3 search_mekanik w-300px">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="search" name="search" value="<?= $search; ?>" class="form-control form-control-solid w-250px ps-13" aria-label="Cari Relawan" aria-describedby="button-cari-relawan" placeholder="Cari Relawan" autocomplete="off">
                            <button type="button" onclick="search()" class="btn btn-primary d-none" type="button" id="button-cari-relawan">
                                <i class="ki-duotone ki-magnifier fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-none justify-content-end" id="sistem_drag">
                                <button type="button" id="btn_hapus" onclick="submit_form(this,'#reload_table',0,'/deleted',true,true)" data-message="Apakah anda yakin akan menghapus data relawan? data yang di hapus tidak akan bisa di kembalikan" class="btn btn-sm btn-light-danger me-3">Hapus</button>
                                <button type="button" id="btn_block" onclick="submit_form(this,'#reload_table',0,'/block',true)" class="btn btn-sm btn-light-warning me-3">Block</button>
                                <button type="button" id="btn_unblock" onclick="submit_form(this,'#reload_table',0,'/unblock',true)" class="btn btn-sm btn-light-primary me-3">Buka Blockir</button>
                            </div>
                            <div class="d-flex justify-content-end" id="sistem_filter">

                                <!--begin::Filter-->
                                <button type="button" class="btn btn-sm btn-light me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Penyaringan</button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px filter_mekanik" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Pilihan Penyaringan</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Wilayah Penugasan</label>
                                            <select name="penugasan" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih kelurahan">

                                                <?php if ($wilayah) : ?>
                                                    <option value="all">Semua</option>
                                                    <?php foreach ($wilayah as $row) : ?>
                                                        <option value="<?= $row->id_kelurahan; ?>" <?php if ($this->input->get('penugasan') == $row->id_kelurahan) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= $row->nama; ?></option>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="0">Tidak ada wilayah penugasan</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Status</label>
                                            <select name="status" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih opsi status">
                                                <option value="all">Semua</option>
                                                <option value="N" <?php if ($this->input->get('status') == 'N') {
                                                                        echo 'selected';
                                                                    } ?>>Aktif</option>
                                                <option value="Y" <?php if ($this->input->get('status') == 'Y') {
                                                                        echo 'selected';
                                                                    } ?>>Tidak Aktif</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" onclick="filter(['penugasan','status'])" class="btn btn-primary fw-semibold px-6">Terapkan</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                                <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                    <!--begin::Export-->
                                    <a id="cetak_excel" onclick="confirm_alert(this,event,'Anda akan mencetak data dengan format excel sesuai dengan data filter')" target="_blank" href="<?= $cetak ?>" class="btn btn-sm btn-primary me-3">
                                        <i class="ki-duotone ki-exit-up fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Cetak Excel
                                    </a>
                                    <!--end::Export-->
                                <?php endif; ?>

                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Add user-->
                            <button type="button" class="btn btn-sm btn-light" onclick="tambah_relawan()" data-bs-toggle="modal" data-bs-target="#kt_modal_relawan">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Relawan</button>
                            <!--end::Add user-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3" id="base_table">
                        <!--begin::Table container-->
                        <form action="<?= base_url('master_function/drag_relawan') ?>" method="POST" class="table-responsive" id="reload_table">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="w-25px">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input cursor-pointer" type="checkbox" onchange="checked_action(this)" <?php if (!$result) {
                                                                                                                                                    echo 'disabled';
                                                                                                                                                } ?>>
                                            </div>
                                        </th>
                                        <th class="min-w-200px">Relawan</th>
                                        <th class="min-w-150px">Nomor Telepon</th>
                                        <th class="min-w-150px">Penugasan</th>
                                        <th class="min-w-50px">Block</th>
                                        <th class="min-w-100px text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>

                                    <?php if ($result) : ?>
                                        <?php foreach ($result as $row) : ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input widget-9-check cursor-pointer child_checkbox" name="id_batch[]" onchange="child_checked()" type="checkbox" value="<?= $row['id_user'] ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <img src="<?= image_check($row['foto'], 'user') ?>" alt="">
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a class="text-dark fw-bold text-hover-primary fs-6"><?= ifnull($row['nama'], 'Dalam proses...') ?></a>
                                                            <span class="text-muted fw-semibold text-muted d-block fs-7"><?= $row['email'] ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= ifnull($row['notelp'], ' - '); ?> </span>
                                                </td>
                                                <td>
                                                    <?php if (count($row['penugasan']) > 0) : ?>
                                                        <?php foreach ($row['penugasan'] as $p) : ?>
                                                            <span class="text-dark fw-bold text-muted d-block fs-6"><?= '- ' . $p['kelurahan']; ?></span>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <span class="fw-bold text-danger d-block fs-6">Belum ditugaskan</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <?php
                                                        if ($row['block'] == 'Y') {
                                                            $alert = 'Anda yakin akan membuka block pada relawan ' . $row['nama'] . '? Relawan akan kembali dapat mengakses sistem';
                                                            $val = 'N';
                                                        } else {
                                                            $alert = 'Anda yakin akan melakukan block pada relawan ' . $row['nama'] . '? Relawan tidak akan bisa melakukan akses pada sistem';
                                                            $val = 'Y';
                                                        }

                                                        $url = 'master_function/block_user';
                                                        ?>
                                                        <input class="form-check-input cursor-pointer focus-red" type="checkbox" role="switch" onchange="switch_block(this,event,<?= $row['id_user'] ?>)" id="switch-<?= $row['id_user'] ?>" <?php if ($row['block'] == 'Y') {
                                                                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                                                                } ?>>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Ubah data relawan" onclick="edit_relawan(this,<?= $row['id_user']; ?>)" data-image="<?= image_check($row['foto'], 'user') ?>" data-bs-toggle="modal" data-bs-target="#kt_modal_relawan">
                                                            <i class="ki-outline ki-pencil fs-2"></i>
                                                        </button>
                                                        <button type="button" onclick="hapus_data(event,<?= $row['id_user']; ?>,'master_function/hapus_relawan','relawan')" title="Hapus data relawan" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                            <i class="ki-outline ki-trash fs-2"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6">
                                                <center>Data relawan tidak ditemukan</center>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                            <?= $this->pagination->create_links(); ?>
                        </form>
                        <!--end::Table container-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

<!-- Modal Tambah Relawan -->
<div class="modal fade" id="kt_modal_relawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal">Tambah Relawan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_relawan" class="form" action="<?= base_url('master_function/tambah_relawan') ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="#" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_relawan_header" data-kt-scroll-wrappers="#kt_modal_relawan_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7 d-flex justify-content-center align-items-center flex-column">
                            <!--begin::Label-->
                            <label class="d-block fw-semibold fs-6 mb-5">Foto Profil</label>
                            <!--end::Label-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-circle" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg')">
                                <!--begin::Image preview wrapper-->
                                <div id="display_foto" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg')"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Ubah Foto">
                                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                    <!--begin::Inputs-->
                                    <input type="file" name="foto" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_foto" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Batalkan Foto">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_foto" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus Foto">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Remove button-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Tipe: png, jpg, jpeg.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->
                        <div id="lead"></div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_nama">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Lengkap</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama lengkap" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <input type="hidden" name="nama_foto">
                        <input type="hidden" name="id_user">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_email">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Alamat Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan alamat email" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_notelp">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nomor Telepon</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="notelp" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nomor telepon" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Penugasan</label>
                            <!--end::Label-->
                            <div>
                                <select name="penugasan[]" class="form-select form-select-solid cekcek" data-control="select2" data-placeholder="Pilih lokasi penugasan" multiple="multiple">
                                    <?php if ($wilayah) : ?>
                                        <?php foreach ($wilayah as $row) : ?>
                                            <option value="<?= $row->id_kelurahan; ?>"><?= $row->nama; ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="0">Tidak ada wilayah penugasan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_password">
                            <!--begin::Label-->
                            <label id="label_password" class="required fw-semibold fs-6 mb-2">Kata Sandi</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan kata sandi" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_repassword">
                            <!--begin::Label-->
                            <label id="label_repassword" class="required fw-semibold fs-6 mb-2">Konfirmasi Kata Sandi</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="password" name="repassword" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Konfirmasi kata sandi" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_relawan" onclick="submit_form(this,'#form_relawan',1)" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>