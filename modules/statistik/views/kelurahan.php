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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Statistik</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Data</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Per Kelurahan</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="d-flex align-items-center position-relative me-3" style="width : 100%;">
                            <!--begin::Input group-->
                            <div class="mb-10" style="margin-right : 10px;">
                                <label class="form-label fs-6 fw-semibold">Kelurahan</label>
                                <select name="id_kelurahan" onchange="get_kelurahan(this,'kelurahan')" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih kelurahan">

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
                                <label class="form-label fs-6 fw-semibold">Tanggal Akhir</label>
                                <input type="date" onchange="get_date(this,'kelurahan')" name="end_date" value="<?= $this->input->get('end_date'); ?>" class="form-control form-control-solid w-250px" aria-label="Tanggal Akhir" autocomplete="off">
                            </div>
                            <!--end::Input group-->
                        </div>

                    </div>
                    <!--end::Header-->
                    <div id="base">
                        <div class="d-flex justify-content-center align-items-center flex-column" id="reload">
                            <!--begin::Col-->
                            <div class="col-xl-11 mt-10">
                                <!--begin::Charts Widget 3-->
                                <div class="card card-xl-stretch mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <!--begin::Chart-->
                                        <div id="kt_charts_widget_3_chart" style="height: 350px"></div>
                                        <!--end::Chart-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Charts Widget 3-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-xl-11">
                                <!--begin::Chart widget 5-->
                                <div class="card card-xl-stretch mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body pt-5 ps-6">
                                        <div id="kt_charts_widget_5" class="min-h-auto"></div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Chart widget 5-->
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>



                </div>

            </div>
            <!--end::Row-->

        </div>
        <!--end::Content container-->


    </div>
    <!--end::Content-->
</div>