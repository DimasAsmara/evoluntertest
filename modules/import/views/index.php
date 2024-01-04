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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Import</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Import</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Data</li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600" id="bread_title"><?= ($this->input->get('page')) ? ucfirst($this->input->get('page')) : 'Relawan'; ?></li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>

                    <div class="card-body">

                        <ul class="nav nav-pills nav-pills-custom mb-3 mx-9 justify-content-center">
                            <!--begin::Item-->
                            <li class="nav-item mb-3 me-3 me-lg-12 fadein-bottom anim-5">
                                <!--begin::Link-->
                                <a class="nav-link row justify-content-center btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden w-150px h-125px <?= (!$this->input->get('page') || $this->input->get('page') == 'relawan') ? 'active' : ''; ?>" onclick="page('relawan')" data-bs-toggle="pill" id="kt_charts_widget_10_tab_2" href="#kt_charts_widget_10_tab_content_2">
                                    <!--begin::Icon-->
                                    <div class="nav-icon mb-5">
                                        <i class="fa-duotone fa-chalkboard-user" style="font-size: 1.8rem;"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <span class="nav-text text-gray-800 fw-bolder fs-6 lh-1">Data Relawan</span>
                                    <!--end::Title-->
                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                    <!--end::Bullet-->
                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="nav-item mb-3 me-3 me-lg-12 fadein-top anim-5">
                                <!--begin::Link-->
                                <a class="nav-link row justify-content-center btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden w-150px h-125px  <?= ($this->input->get('page') == 'penduduk') ? 'active' : ''; ?>" onclick="page('penduduk')" data-bs-toggle="pill" id="kt_charts_widget_10_tab_3" href="#kt_charts_widget_10_tab_content_3">
                                    <!--begin::Icon-->
                                    <div class="nav-icon mb-5">
                                        <i class="fa-duotone fa-screen-users" style="font-size: 1.8rem;"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <span class="nav-text text-gray-800 fw-bolder fs-6 lh-1">Data Penduduk</span>
                                    <!--end::Title-->
                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                    <!--end::Bullet-->
                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="nav-item mb-3 me-3 me-lg-12 fadein-bottom anim-5">
                                <!--begin::Link-->
                                <a class="nav-link row justify-content-center btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden w-150px h-125px  <?= ($this->input->get('page') == 'kelurahan') ? 'active' : ''; ?>" onclick="page('kelurahan')" data-bs-toggle="pill" id="kt_charts_widget_10_tab_4" href="#kt_charts_widget_10_tab_content_4">
                                    <!--begin::Icon-->
                                    <div class="nav-icon mb-5">
                                        <i class="fa-duotone fa-building-user" style="font-size: 1.8rem;"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <span class="nav-text text-gray-800 fw-bolder fs-6 lh-1">Data Kelurahan</span>
                                    <!--end::Title-->
                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                    <!--end::Bullet-->
                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->
                        </ul>

                        <div class="tab-content mt-10">
                            <!--begin::Tap pane-->
                            <div class="tab-pane px-md-6 px-lg-20 pb-10 <?= (!$this->input->get('page') || $this->input->get('page') == 'relawan') ? 'active' : ''; ?>" id="kt_charts_widget_10_tab_content_2">
                                <form id="import_relawan" class="form-horizontal" method="post" action="<?= base_url('import_function/relawan') ?>" accept-charset="utf-8" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="contoh" class="col-sm-4 col-12 col-form-label">Contoh Format Excel</label>
                                        <div class="col-sm-8 col-12">
                                            <a href="<?= base_url('data/example/relawan.xlsx') ?>" class="btn btn-primary w-auto  text-start ps-8">
                                                <i class="fa-sharp fa-solid fa-file-excel"></i> Download Excel
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label">Penugasan</label>
                                        <div class="col-sm-8 col-12">
                                            <select name="penugasan[]" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Lokasi Penugasan" multiple="multiple">
                                                <option></option>
                                                <?php if ($kelurahan) : ?>
                                                    <?php foreach ($kelurahan as $row) : ?>
                                                        <option value="<?= $row->id_kelurahan; ?>"><?= $row->nama; ?></option>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="">Tidak ada data kelurahan</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-10" id="req_relawan_data">
                                        <label for="dropzone-staf" class="col-sm-4 col-12 col-form-label required">File</label>
                                        <!--end::Label-->
                                        <div class="col-sm-8 col-12">
                                            <input class="form-control" name="data" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" id="submit_import_relawan" onclick="submit_form(this,'#import_relawan',0,'',false,true)" data-message="Apakah data import sudah sesuai ?" class="btn btn-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="fa-duotone fa-floppy-disk" style="font-size: 1.3rem;"></i>
                                                </span>
                                                <!--end::Svg Icon-->Simpan
                                            </button>
                                            <!--end::Add user-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Tap pane-->
                            <div class="tab-pane px-md-6 px-lg-20 pb-10  <?= ($this->input->get('page') == 'penduduk') ? 'active' : ''; ?>" id="kt_charts_widget_10_tab_content_3">
                                <form action="<?= base_url('import_function/penduduk') ?>" id="import_penduduk" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                    <div class="row mb-3">
                                        <label for="contoh" class="col-sm-4 col-12 col-form-label">Contoh Format Excel</label>
                                        <div class="col-sm-8 col-12">
                                            <a href="<?= base_url('data/example/penduduk.xlsx') ?>" class="btn btn-primary w-auto  text-start ps-8">
                                                <i class="fa-sharp fa-solid fa-file-excel"></i> Download Excel
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="req_penduduk_kelurahan">
                                        <label class="col-sm-4 col-form-label required">Kelurahan</label>
                                        <div class="col-sm-8 col-12">
                                            <select name="kelurahan" onchange="get_tps(this,'#id_tps_1')" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Kelurahan">
                                                <option></option>
                                                <?php if ($kelurahan) : ?>
                                                    <?php foreach ($kelurahan as $row) : ?>
                                                        <option value="<?= $row->id_kelurahan; ?>"><?= $row->nama; ?></option>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="">Tidak ada data kelurahan</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="req_penduduk_tps">
                                        <label class="col-sm-4 col-form-label required">TPS</label>
                                        <div class="col-sm-8 col-12">
                                            <select id="id_tps_1" name="tps" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih TPS">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-10" id="req_penduduk_data">
                                        <label for="dropzone-kelas" class="col-sm-4 col-12 col-form-label required">File</label>
                                        <!--end::Label-->
                                        <div class="col-sm-8 col-12">
                                            <input class="form-control" name="data" type="file" id="import_penduduk" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" id="submit_import_penduduk" onclick="submit_form(this,'#import_penduduk',1,'',false,true)" data-message="Apakah data import sudah sesuai ?" class="btn btn-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="fa-duotone fa-floppy-disk" style="font-size: 1.3rem;"></i>
                                                </span>
                                                <!--end::Svg Icon-->Simpan
                                            </button>
                                            <!--end::Add user-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Tap pane-->
                            <div class="tab-pane px-md-6 px-lg-20 pb-10  <?= ($this->input->get('page') == 'kelurahan') ? 'active' : ''; ?>" id="kt_charts_widget_10_tab_content_4">
                                <form action="<?= base_url('import_function/kelurahan') ?>" id="import_kelurahan" class="form-horizontal" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="contoh" class="col-sm-4 col-12 col-form-label">Contoh Format Excel</label>
                                        <div class="col-sm-8 col-12">
                                            <a href="<?= base_url('data/example/kelurahan.xlsx') ?>" class="btn btn-primary w-auto  text-start ps-8">
                                                <i class="fa-sharp fa-solid fa-file-excel"></i> Download Excel
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-10" id="req_kelurahan_data">
                                        <label for="dropzone-siswa" class="col-sm-4 col-12 col-form-label required">File</label>
                                        <!--end::Label-->
                                        <div class="col-sm-8 col-12">
                                            <input class="form-control" name="data" type="file" id="formFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" id="submit_import_kelurahan" onclick="submit_form(this,'#import_kelurahan',2,'',false,true)" data-message="Apakah data import sudah sesuai ?" class="btn btn-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="fa-duotone fa-floppy-disk" style="font-size: 1.3rem;"></i>
                                                </span>
                                                <!--end::Svg Icon-->Simpan
                                            </button>
                                            <!--end::Add user-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Tap pane-->
                        </div>
                    </div>
                    <!--end::Content-->

                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>