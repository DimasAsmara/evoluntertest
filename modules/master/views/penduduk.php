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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Penduduk</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Penduduk</li>
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
                            <input type="search" name="search" value="<?= $search; ?>" class="form-control form-control-solid w-250px ps-13" aria-label="Cari Penduduk" aria-describedby="button-cari-penduduk" placeholder="Cari Penduduk" autocomplete="off">
                            <button type="button" onclick="search()" class="btn btn-primary d-none" type="button" id="button-cari-penduduk">
                                <i class="ki-duotone ki-magnifier fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </div>
                        <div class="card-toolbar">
                            <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                <!--begin::Toolbar-->
                                <div class="d-none justify-content-end" id="sistem_drag">
                                    <button type="button" id="btn_hapus" onclick="submit_form(this,'#reload_table',0,'/deleted',true,true)" data-message="Apakah anda yakin akan menghapus data penduduk? penduduk yang di hapus tidak akan bisa di kembalikan" class="btn btn-sm btn-light-danger me-3">Hapus</button>
                                </div>
                            <?php endif; ?>
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
                                    <div class="px-7 py-5" style="overflow-y: scroll;height : 250px">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Kelurahan</label>
                                            <select name="id_kelurahan" onchange="get_tps(this,'#id_tps')" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih kelurahan">

                                                <?php if ($kelurahan) : ?>
                                                    <option value="all">Semua</option>
                                                    <?php foreach ($kelurahan as $row) : ?>
                                                        <option value="<?= $row->id_kelurahan; ?>" <?= ($row->id_kelurahan == $this->input->get('id_kelurahan')) ? 'selected' : ''; ?>><?= $row->nama; ?></option>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="0">Tidak ada data kelurahan</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">TPS</label>
                                            <select name="id_tps" id="id_tps" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih kelurahan terlebih dahulu">
                                                <option value="">Pilih kelurahan terlebih dulu</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">RT</label>
                                            <select name="rt" id="rt" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih RT">
                                                <option value="all">Semua</option>
                                                <?php for ($i = 1; $i <= 20; $i++) { ?>
                                                    <option value="<?= $i; ?>">RT <?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">RW</label>
                                            <select name="rw" id="rw" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih RW">
                                                <option value="all">Semua</option>
                                                <?php for ($i = 1; $i <= 20; $i++) { ?>
                                                    <option value="<?= $i; ?>">RW <?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Status</label>
                                            <select name="status" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih opsi status">
                                                <option value="all">Semua</option>
                                                <option value="2" <?php if ($this->input->get('status') == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Telah Ditemui</option>
                                                <option value="1" <?php if ($this->input->get('status') == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Belum Ditemui</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Data</label>
                                            <select name="data" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih opsi data">
                                                <option value="all">Semua</option>
                                                <option value="Y" <?php if ($this->input->get('data') == 'Y') {
                                                                        echo 'selected';
                                                                    } ?>>Data external</option>
                                                <option value="N" <?php if ($this->input->get('data') == 'N') {
                                                                        echo 'selected';
                                                                    } ?>>Data Internal</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Range Umur</label>
                                            <div class="range-old wrapper">
                                                <div class="price-input">
                                                    <div class="field">
                                                        <span>Min</span>
                                                        <input type="number" name="umur_minimal" class="input-min filter-input" value="18">
                                                    </div>
                                                    <div class="separator">-</div>
                                                    <div class="field">
                                                        <span>Max</span>
                                                        <input type="number" name="umur_maximal" class="input-max filter-input" value="70">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-center">
                                            <button type="button" onclick="filter(['id_kelurahan','id_tps','status','data','umur_minimal','rt','rw','umur_maximal'])" class="btn btn-primary fw-semibold px-6">Terapkan</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                    <!--begin::Export-->
                                    <a id="cetak_excel" target="_blank" href="<?= $cetak; ?>" onclick="confirm_alert(this,event,'Anda akan mencetak data dengan format excel sesuai dengan data filter')" class="btn btn-sm btn-primary me-3">
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
                            <button type="button" class="btn btn-sm btn-light" onclick="tambah_penduduk()" data-bs-toggle="modal" data-bs-target="#kt_modal_penduduk">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Penduduk</button>
                            <!--end::Add user-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3" id="base_table">
                        <!--begin::Table container-->
                        <form action="<?= base_url('master_function/drag_penduduk') ?>" method="POST" class="table-responsive" id="reload_table">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="w-25px">
                                            <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input cursor-pointer" type="checkbox" onchange="checked_action(this)" <?php if (!$result) {
                                                                                                                                                        echo 'disabled';
                                                                                                                                                    } ?>>
                                                </div>
                                            <?php else : ?>
                                                NO
                                            <?php endif; ?>
                                        </th>
                                        <th class="min-w-200px">Penduduk</th>
                                        <th class="min-w-250px">Kontak</th>
                                        <th class="min-w-100px">Kelurahan</th>
                                        <th class="min-w-100px">RT</th>
                                        <th class="min-w-100px">RW</th>
                                        <th class="min-w-100px">TPS</th>
                                        <th class="min-w-50px">Status</th>
                                        <th class="min-w-100px text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>

                                    <?php if ($result) : ?>
                                        <?php $no = $offset;;
                                        foreach ($result as $row) : ?>
                                            <tr>
                                                <td>
                                                    <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input widget-9-check cursor-pointer child_checkbox" name="id_batch[]" onchange="child_checked()" type="checkbox" value="<?= $row->id_penduduk; ?>">
                                                        </div>
                                                    <?php else : ?>
                                                        <?= $no++; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <img src="<?= image_check($row->foto_pendukung, 'penduduk') ?>" alt="">
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <?= ($row->new_data == 'Y') ? '<span class="badge badge-success">Data External</span>' : ''; ?>
                                                            <a class="text-dark fw-bold text-hover-primary fs-6"><?= short_text(ifnull($row->nama, 'Dalam proses...'), 18); ?></a>
                                                            <span class="text-muted fw-semibold text-muted d-block fs-7"><?= $row->nik; ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if ($row->email || $row->notelp) : ?>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <?php if ($row->email) : ?>

                                                                <span class="text-dark fw-bold text-hover-primary d-block fs-6"><i class="fa-solid fa-envelope" style="margin-right : 10px;"></i><?= $row->email; ?> </span>
                                                            <?php endif; ?>
                                                            <?php if ($row->notelp) : ?>

                                                                <span class="text-dark fw-bold text-hover-primary d-block fs-6"><i class="fa-solid fa-phone" style="margin-right : 10px;"></i><?= $row->notelp; ?> </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php else : ?>
                                                        <span class="text-dark fw-bold text-hover-primary d-block fs-6"> - </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= ifnull($row->kelurahan, ' - '); ?> </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= ifnull($row->rt, ' - '); ?> </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= ifnull($row->rw, ' - '); ?> </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= ifnull($row->tps, ' - '); ?> </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                                        <?php if ($row->status == 1) : ?>
                                                            <span class="text-dark fw-bold badge badge-warning d-block fs-6">Untaken</span>
                                                        <?php else : ?>
                                                            <!-- <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?= $row->relawan; ?>" style="z-index : 2;">
                                                                <?php if ($row->foto_relawan == '') : ?>
                                                                    <span class="symbol-label bg-primary text-inverse-warning fw-bold"><?= initials($row->relawan, 2) ?></span>
                                                                <?php else : ?>
                                                                    <img alt="<?= $row->relawan; ?>" src="<?= image_check($row->foto_relawan, 'user') ?>" />
                                                                <?php endif; ?>
                                                            </div> -->
                                                            <span class="text-dark fw-bold badge badge-primary d-block fs-6">Taken</span>
                                                        <?php endif; ?>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <?php if ($row->status == 1) : ?>
                                                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" onclick="add_pendukung(this,<?= $row->id_penduduk ?>)" title="Tambahkan sebagai pendukung" data-foto_ktp="<?= image_check($row->foto_ktp, 'penduduk', 'env') ?>" data-foto_pendukung="<?= image_check($row->foto_pendukung, 'penduduk') ?>" data-bs-toggle="modal" data-bs-target="#kt_modal_add_pendukung">
                                                                <i class="ki-outline ki-plus fs-2"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                        <?php if ($this->session->userdata('vol_id_role') == 2 || $row->create_by == $this->session->userdata('vol_id_user') || $row->taken_by == $this->session->userdata('vol_id_user') || $row->taken_by == '') : ?>
                                                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" onclick="detail_penduduk(this,<?= $row->id_penduduk ?>)" title="Detail penduduk" data-foto_ktp="<?= image_check($row->foto_ktp, 'penduduk', 'env') ?>" data-foto_pendukung="<?= image_check($row->foto_pendukung, 'penduduk') ?>" data-bs-toggle="modal" data-bs-target="#kt_modal_detail">
                                                                <i class="ki-outline ki-note fs-2"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                        <?php if ($this->session->userdata('vol_id_role') == 2 || $row->create_by == $this->session->userdata('vol_id_user')) : ?>
                                                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="edit_penduduk(this,<?= $row->id_penduduk ?>)" title="Ubah data penduduk" data-foto_ktp="<?= image_check($row->foto_ktp, 'penduduk', 'env') ?>" data-foto_pendukung="<?= image_check($row->foto_pendukung, 'penduduk') ?>" data-bs-toggle="modal" data-bs-target="#kt_modal_penduduk">
                                                                <i class="ki-outline ki-pencil fs-2"></i>
                                                            </button>
                                                        <?php endif; ?>

                                                        <?php if ($this->session->userdata('vol_id_role') == 2 || $row->create_by == $this->session->userdata('vol_id_user')) : ?>
                                                            <button type="button" onclick="hapus_data(event,<?= $row->id_penduduk; ?>,'master_function/hapus_penduduk','penduduk')" title="Hapus penduduk" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                                <i class="ki-outline ki-trash fs-2"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7">
                                                <?php if ($this->session->userdata('vol_id_role') != 1) : ?>
                                                    <center>Data penduduk tidak ditemukan</center>
                                                <?php else : ?>
                                                    <?php if ($text_false) : ?>
                                                        <center><?= $text_false; ?></center>
                                                    <?php else : ?>
                                                        <center>Data penduduk tidak ditemukan</center>
                                                    <?php endif; ?>
                                                <?php endif; ?>
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

<!-- Modal Tambah Penduduk -->
<div class="modal fade" id="kt_modal_penduduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal">Tambah Penduduk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_penduduk" class="form" action="<?= base_url('master_function/tambah_penduduk') ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="#" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_penduduk_header" data-kt-scroll-wrappers="#kt_modal_penduduk_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_nama">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Warga</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama warga" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_nik">
                            <!--begin::Label-->
                            <label class="<?= ($this->session->userdata('vol_id_role') == 1) ? 'required' : '' ?> fw-semibold fs-6 mb-2">NIK</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nik" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan NIK" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <input type="hidden" name="id_penduduk">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_id_kelurahan">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Kelurahan</label>
                            <!--end::Label-->
                            <div>
                                <select name="id_kelurahan" onchange="get_tps(this,'#id_tps_2')" class="form-select form-select-solid cekcek" data-control="select2" data-placeholder="Pilih kelurahan">
                                    <?php if ($kelurahan) : ?>
                                        <option value="">Pilih kelurahan</option>
                                        <?php foreach ($kelurahan as $row) : ?>
                                            <option value="<?= $row->id_kelurahan; ?>"><?= $row->nama; ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Tidak ada kelurahan penugasan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_id_tps">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">TPS</label>
                            <!--end::Label-->
                            <div>
                                <select name="id_tps" id="id_tps_2" class="form-select form-select-solid cekcek" data-control="select2" data-placeholder="Pilih kelurahan terlebih dulu">
                                </select>
                            </div>
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
                        <div class="fv-row mb-7" id="req_email">
                            <!--begin::Label-->
                            <label class="<?= ($this->session->userdata('vol_id_role') == 1) ? 'required' : '' ?> fw-semibold fs-6 mb-2">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan alamat email" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_umur">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Umur</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" name="umur" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan umur" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_gender">
                            <!--begin::Label-->
                            <label class="<?= ($this->session->userdata('vol_id_role') == 1) ? 'required' : '' ?> fw-semibold fs-6 mb-2">Jenis Kelamin</label>
                            <!--end::Label-->
                            <div>
                                <select name="gender" class="form-select form-select-solid cekcek" data-control="select2" data-placeholder="Pilih jenis kelamin">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->

                        <div class="fv-row mb-7" id="req_rt_rw">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">RT / RW</label>
                            <!--end::Label-->
                            <div class="input-group mb-3">
                                <input type="number" name="rt" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukan RT" min="1" max="100">
                                <span class="input-group-text" style="background-color : #FFFFFF;border : none;"> - </span>
                                <input type=" number" name="rw" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukan RW" min="1" max="100">
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_alamat">
                            <!--begin::Label-->
                            <label class="<?= ($this->session->userdata('vol_id_role') == 1) ? 'required' : '' ?> fw-semibold fs-6 mb-2">Alamat</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan alamat lengkap" name="alamat" cols="30" rows="5"></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <div class="col-12 d-flex justify-content-around">
                            <!--begin::Input group-->
                            <div class="col-6 fv-row mb-7 d-flex justify-content-center align-items-center flex-column" id="req_foto_pendukung">
                                <!--begin::Label-->
                                <label class="<?= ($this->session->userdata('vol_id_role') == 1) ? 'required' : '' ?> d-block fw-semibold fs-6 mb-5">Foto Pendukung</label>
                                <!--end::Label-->
                                <!--begin::Image input-->
                                <div class="image-input" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg')">
                                    <!--begin::Image preview wrapper-->
                                    <div id="display_foto_pendukung" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg')"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Ubah Foto">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="foto_pendukung" accept=".png, .jpg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_foto_pendukung" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Batalkan Foto">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_foto_pendukung" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus Foto">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Tipe: png, jpg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-6 fv-row mb-7 d-flex justify-content-center align-items-center flex-column" id="req_foto_ktp">
                                <!--begin::Label-->
                                <label class="<?= ($this->session->userdata('vol_id_role') == 1) ? 'required' : '' ?> d-block fw-semibold fs-6 mb-5">Foto KTP</label>
                                <!--end::Label-->
                                <!--begin::Image input-->
                                <div class="image-input" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>data/default/env.jpg')">
                                    <!--begin::Image preview wrapper-->
                                    <div id="display_foto_ktp" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= base_url(); ?>data/default/env.jpg')"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Ubah Foto">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="foto_ktp" accept=".png, .jpg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_foto_ktp" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Batalkan Foto">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_foto_ktp" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus Foto">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                                <input type="hidden" name="nama_foto_pendukung">
                                <input type="hidden" name="nama_foto_ktp">
                                <!--begin::Hint-->
                                <div class="form-text">Tipe: png, jpg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->
                        </div>


                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_penduduk" onclick="submit_form(this,'#form_penduduk',1)" class="btn btn-primary">
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

<div class="modal fade" id="kt_modal_add_pendukung" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Tambah Pendukung</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_pendukung" class="form" action="<?= base_url('master_function/tambah_pendukung') ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_pendukung_header" data-kt-scroll-wrappers="#kt_modal_pendukung_scroll" data-kt-scroll-offset="300px">
                        <input type="hidden" name="id_penduduk">
                        <!--end::Input group-->
                        <div class="col-12 d-flex justify-content-around">
                            <!--begin::Input group-->
                            <div class="col-6 fv-row mb-7 d-flex justify-content-center align-items-center flex-column" id="req_2_foto_pendukung">
                                <!--begin::Label-->
                                <label class="required d-block fw-semibold fs-6 mb-5">Bukti Pertemuan (Foto Pendukung)</label>
                                <!--end::Label-->
                                <!--begin::Image input-->
                                <div class="image-input" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg')">
                                    <!--begin::Image preview wrapper-->
                                    <div id="display_foto_pendukung_2" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg')"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Ubah Foto">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="foto_pendukung" accept=".png, .jpg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Batalkan Foto">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus Foto">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Tipe: png, jpg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-6 fv-row mb-7 d-flex justify-content-center align-items-center flex-column" id="req_2_foto_ktp">
                                <!--begin::Label-->
                                <label class="required d-block fw-semibold fs-6 mb-5">Foto KTP</label>
                                <!--end::Label-->
                                <!--begin::Image input-->
                                <div class="image-input" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>data/default/env.jpg')">
                                    <!--begin::Image preview wrapper-->
                                    <div id="display_foto_ktp_2" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= base_url(); ?>data/default/env.jpg')"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Ubah Foto">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="foto_ktp" accept=".png, .jpg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Batalkan Foto">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus Foto">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Tipe: png, jpg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <input type="hidden" name="nama_foto_pendukung">
                        <input type="hidden" name="nama_foto_ktp">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_2_nama">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama pendukung" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_2_nik">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">NIK</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nik" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan NIK" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_2_notelp">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nomor Telepon</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="hidden" name="new_data" value="N">
                            <input type="text" name="notelp" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nomor telepon" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_2_gender">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Jenis Kelamin</label>
                            <!--end::Label-->
                            <div>
                                <select name="gender" class="form-select form-select-solid cekcek" data-control="select2" data-placeholder="Pilih jenis kelamin">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_pendukung" onclick="submit_form(this,'#form_pendukung',2)" class="btn btn-primary">
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

<div class="modal fade" id="kt_modal_detail" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Detail Penduduk</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15 mt-7">
                <h4 class="text-center"><span data-value="nama"> Tunggu sebentar...</span></h4>
                <h5 class="text-primary text-center">Penduduk</h5>

                <!--begin::Input group-->
                <div class="fv-row mb-7 d-flex justify-content-around align-items-center">
                    <!--begin::Image input-->
                    <div class="image-input">
                        <!--begin::Image preview wrapper-->
                        <div id="detail_foto_pendukung" class="image-input-wrapper w-200px h-200px" style="background-image: url('<?= base_url(); ?>data/default/user.jpg')"></div>
                        <!--end::Image preview wrapper-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Image input-->
                    <div class="image-input" id="base_foto_ktp">
                        <!--begin::Image preview wrapper-->
                        <div id="detail_foto_ktp" class="image-input-wrapper w-200px h-200px" style="background-image: url('<?= base_url(); ?>data/default/env.jpg')"></div>
                        <!--end::Image preview wrapper-->
                    </div>
                    <!--end::Input group-->
                </div>
                <div class="row mt-7">
                    <div class="col-xl-4 col-md-12">
                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-success">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fa-duotone fa-id-card-clip" style="font-size: 1.5rem; color: #009ef7;"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">NIK</span>
                                    <span data-value="nik" class="fs-7 text-muted">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>

                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-danger">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fa-duotone fa-envelope" style="font-size: 1.5rem; color: #ec3528;"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">Email</span>
                                    <span data-value="email" class="fs-7 text-muted">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>

                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="symbol-label bg-light-primary">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <i class="fa-duotone fa-phone" style="font-size: 1.5rem; color: #B0DC00;"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">Nomor Telepon</span>
                                    <span data-value="notelp" class="fs-7 text-muted">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>
                    </div>

                    <div class="col-xl-4 col-md-12">
                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fa-duotone fa-venus-mars" style="font-size: 1.5rem; color: #B0DC00;"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">Jenis Kelamin</span>
                                    <span data-value="gender" class="fs-7 text-muted">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>

                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-info">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fa-duotone fa-cake-candles" style="font-size: 1.5rem; color: #7239ea;"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">Umur</span>
                                    <span data-value="umur" class="fs-7 text-muted">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>


                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-success">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="symbol-label bg-light-warning">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <i class="fa-duotone fa-house" style="font-size: 1.5rem; color: #ffc700;"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">RT / RW</span>
                                    <span data-value="rt_rw" class="fs-7 text-muted">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>
                    </div>

                    <div class="col-xl-4 col-md-12">
                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-success">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fa-duotone fa-city" style="font-size: 1.5rem; color: #009ef7;"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">Kelurahan</span>
                                    <span data-value="id_kelurahan" class="fs-7 text-muted">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>


                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-warning">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fa-duotone fa-star" style="font-size: 1.5rem; color: #ffc700;"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">Status</span>
                                    <span data-value="status" class="badge badge-success">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>


                        <label class="d-flex flex-stack mb-5 cursor-pointer">
                            <!--begin:Label-->
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-6">
                                    <span class="symbol-label bg-light-danger">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fa-duotone fa-database" style="font-size: 1.5rem; color: #ec3528;"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-bolder fs-6">Keterangan</span>
                                    <span data-value="new_data" class="badge badge-success">Tunggu sebentar...</span>
                                </span>
                                <!--end:Info-->
                            </span>
                            <!--end:Label-->
                        </label>


                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="card border border-success">

                            <div class="card-body">
                                <h5>Alamat</h5>
                                <span data-value="alamat">Tunggu sebentar...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal content-->
</div>
<!--end::Modal dialog-->
</div>