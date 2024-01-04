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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Kelurahan</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Kelurahan</li>
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
                            <input type="search" name="search" value="<?= $search; ?>" class="form-control form-control-solid w-250px ps-13" aria-label="Cari Kelurahan" aria-describedby="button-cari-wilayah" placeholder="Cari Kelurahan" autocomplete="off">
                            <button type="button" onclick="search()" class="btn btn-primary d-none" type="button" id="button-cari-wilayah">
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
                                    <button type="button" id="btn_hapus" onclick="submit_form(this,'#reload_table',0,'/deleted',true,true)" data-message="Apakah anda yakin akan menghapus data kelurahan? kelurahan yang di hapus tidak akan bisa di kembalikan" class="btn btn-sm btn-light-danger me-3">Hapus</button>
                                </div>
                            <?php endif; ?>
                            <div class="d-flex justify-content-end" id="sistem_filter">
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
                            <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                <!--begin::Add user-->
                                <button type="button" class="btn btn-sm btn-light" onclick="tambah_wilayah()" data-bs-toggle="modal" data-bs-target="#kt_modal_wilayah">
                                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Kelurahan</button>
                                <!--end::Add user-->
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3" id="base_table">
                        <!--begin::Table container-->
                        <form action="<?= base_url('master_function/drag_wilayah') ?>" method="POST" class="table-responsive" id="reload_table">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                            <th class="w-25px">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input cursor-pointer" type="checkbox" onchange="checked_action(this)" <?php if (!$result) {
                                                                                                                                                        echo 'disabled';
                                                                                                                                                    } ?>>
                                                </div>
                                            </th>
                                        <?php else : ?>
                                            <th class="w-25px">NO</th>
                                        <?php endif; ?>
                                        <th class="min-w-200px">Kelurahan</th>
                                        <th class="min-w-100px">TPS</th>
                                        <th class="min-w-100px">Penduduk</th>
                                        <th class="min-w-200px">Relawan</th>
                                        <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                            <th class="min-w-100px text-end">Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php if ($result) : ?>
                                        <?php $no = $offset;
                                        foreach ($result as $row) : ?>
                                            <tr>
                                                <td>
                                                    <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input widget-9-check cursor-pointer child_checkbox" name="id_batch[]" onchange="child_checked()" type="checkbox" value="<?= $row['id_kelurahan'] ?>">
                                                        </div>
                                                    <?php else : ?>
                                                        <?= $no++; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= $row['nama']; ?> </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= $row['jumlah_tps']; ?> </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= $row['jumlah_penduduk']; ?> </span>
                                                </td>
                                                <td>
                                                    <?php if (count($row['relawan']) > 0) : ?>
                                                        <?php foreach ($row['relawan'] as $p) : ?>
                                                            <span class="text-dark fw-bold text-muted d-block fs-6"><?= '- ' . $p['relawan']; ?></span>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <span class="fw-bold text-danger d-block fs-6">Belum ada PIC</span>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                                    <td>
                                                        <div class="d-flex justify-content-end flex-shrink-0">

                                                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" title="Tambah data relawan" onclick="modal_relawan(this,<?= $row['id_kelurahan']; ?>)" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah_pic">
                                                                <i class="ki-outline ki-user fs-2"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Ubah data kelurahan" onclick="edit_wilayah(this,<?= $row['id_kelurahan']; ?>)" data-bs-toggle="modal" data-bs-target="#kt_modal_wilayah">
                                                                <i class="ki-outline ki-pencil fs-2"></i>
                                                            </button>

                                                            <button type="button" onclick="hapus_data(event,<?= $row['id_kelurahan']; ?>,'master_function/hapus_wilayah','wilayah')" title="Hapus data kelurahan" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                                <i class="ki-outline ki-trash fs-2"></i>
                                                            </button>

                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7">
                                                <center>Data kelurahan tidak ditemukan</center>
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

<!-- Modal Tambah Wilayah -->
<div class="modal fade" id="kt_modal_wilayah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal">Tambah Kelurahan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_wilayah" class="form" action="<?= base_url('master_function/tambah_wilayah') ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="#" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_wilayah_header" data-kt-scroll-wrappers="#kt_modal_wilayah_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_nama">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Kelurahan</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama kelurahan" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <input type="hidden" name="id_kelurahan">

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_jumlah_tps">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Jumlah TPS</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" name="jumlah_tps" min="1" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan Jumlah TPS" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_wilayah" onclick="submit_form(this,'#form_wilayah',1)" class="btn btn-primary">
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

<!--begin::Modal - View Users-->
<div class="modal fade" id="kt_modal_tambah_pic" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15" id="display_content">

            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - View Users-->