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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">TPS</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">TPS</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="d-flex align-items-center position-relative me-3 search_mekanik w-300px">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-semibold">Kelurahan</label>
                                <select name="id_kelurahan" onchange="get_kelurahan(this)" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih kelurahan">

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
                        </div>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3" id="base_table">
                        <!--begin::Table container-->
                        <form action="<?= base_url('master_function/drag_wilayah') ?>" method="POST" class="table-responsive" id="reload_table">
                            <!--begin::Table-->
                            <table class="table table-bordered table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="w-50px text-center">NO</th>
                                        <th class="min-w-200px">Kelurahan</th>
                                        <th class="min-w-50px text-center">TPS</th>
                                        <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                            <th class="min-w-100px text-center">Penduduk</th>
                                            <th class="min-w-50px text-center">Pengaturan</th>
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
                                                <td class="text-center" <?php if ($row['jumlah_tps'] > 0) : ?>rowspan="<?= $row['jumlah_tps']; ?>" <?php endif; ?>>
                                                    <?= $no++; ?>
                                                </td>
                                                <td <?php if ($row['jumlah_tps'] > 0) : ?>rowspan="<?= $row['jumlah_tps']; ?>" <?php endif; ?>>
                                                    <span class="text-dark fw-bold text-hover-primary d-block fs-6"><?= $row['nama']; ?> </span>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($row['jumlah_tps'] > 0) : ?>
                                                        <span class="text-dark fw-bold text-muted d-block fs-6 m-0"><?= $row['tps'][0]['nama']; ?></span>
                                                    <?php else : ?>
                                                        <span class="fw-bold text-danger d-block fs-6">Belum ada TPS</span>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                                    <td>
                                                        <?php if ($row['jumlah_tps'] > 0) : ?>
                                                            <div class="d-flex justify-content-center flex-shrink-0">


                                                                <button type="button" title="Tambah data penduduk" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm text-muted" onclick="modal_warga(this,<?= $row['tps'][0]['id_tps']; ?>,<?= $row['id_kelurahan'] ?>)" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah_warga" style="width : auto;padding : 10px 5px;">
                                                                    <i class="ki-outline ki-user fs-2"></i><?= ifnull($row['tps'][0]['jumlah_penduduk'], 0); ?>
                                                                </button>

                                                            </div>
                                                        <?php else : ?>
                                                            <div class="d-flex justify-content-center flex-shrink-0">


                                                                <button type="button" title="Tambah data penduduk" class="btn btn-icon btn-bg-light btn-active-color-secondary btn-sm" disabled>
                                                                    <i class="ki-outline ki-user fs-2"></i>
                                                                </button>

                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td <?php if ($row['jumlah_tps'] > 0) : ?>rowspan="<?= $row['jumlah_tps']; ?>" <?php endif; ?>>
                                                        <div class="d-flex justify-content-center flex-shrink-0">
                                                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1" title="Pengaturan TPS" onclick="pengaturan_tps(<?= $row['id_kelurahan']; ?>,<?= $row['jumlah_tps']; ?>)" data-bs-toggle="modal" data-bs-target="#kt_modal_tps">
                                                                <i class="ki-outline ki-setting fs-2"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                <?php endif; ?>

                                            </tr>
                                            <?php if ($row['jumlah_tps'] > 1) : ?>
                                                <?php for ($i = 1; $i < $row['jumlah_tps']; $i++) { ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <span class="text-dark fw-bold text-muted d-block fs-6"><?= $row['tps'][$i]['nama']; ?></span>
                                                        </td>
                                                        <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                                            <td>
                                                                <div class="d-flex justify-content-center flex-shrink-0">


                                                                    <button type="button" title="Tambah data penduduk" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm text-muted" onclick="modal_warga(this,<?= $row['tps'][$i]['id_tps']; ?>,<?= $row['id_kelurahan'] ?>)" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah_warga" style="width : auto;padding : 10px 5px;">
                                                                        <i class="ki-outline ki-user fs-2"></i> <?= ifnull($row['tps'][$i]['jumlah_penduduk'], 0); ?>
                                                                    </button>

                                                                </div>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php } ?>
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                                <td colspan="5">
                                                    <center>Data TPS tidak ditemukan</center>
                                                </td>
                                            <?php else : ?>
                                                <td colspan="3">
                                                    <center>Data TPS tidak ditemukan</center>
                                                </td>
                                            <?php endif; ?>
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
<div class="modal fade" id="kt_modal_tps" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal">Pengaturan TPS</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_tps" class="form" action="<?= base_url('master_function/tambah_tps') ?>" method="POST">
                    <!--begin::Scroll-->
                    <input type="hidden" name="id_kelurahan">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="#" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_tps_header" data-kt-scroll-wrappers="#kt_modal_tps_scroll" data-kt-scroll-offset="300px">
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
                    <span class="text-danger">Jika anda memasukan jumlah TPS kurang dari jumlah yang ada. Maka pembagian TPS akan disesuaikan</span>
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_wilayah" onclick="submit_form(this,'#form_tps',1)" class="btn btn-primary">
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
<div class="modal fade" id="kt_modal_tambah_warga" tabindex="-1" aria-hidden="true">
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