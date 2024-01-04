<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Beranda</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Portal halaman utama</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::Card widget 19-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Heading-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold text-gray-800 m-0">Jumlah Penduduk</h4>
                                    <!--end::Title-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Chart-->
                                <div class="d-flex flex-center w-100 flex-column" style="height : 170px;">
                                    <span class="text-primary " style="font-size : 60px;"><?= simple_number($penduduk) ?></span>
                                    <span class="text-muted"><?= number_format($penduduk, 0, ',', '.'); ?> Orang</span>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Content-->
                                <div class="text-center w-100 z-index-1">

                                    <!--begin::Action-->
                                    <div class="mb-9 mb-xxl-1">
                                        <a href='<?= base_url('master/penduduk') ?>' class="btn btn-danger fw-semibold">Lihat Detail</a>
                                    </div>
                                    <!--ed::Action-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card widget 19-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::Card widget 19-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Heading-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold text-gray-800 m-0">Persentase Pendukung</h4>
                                    <!--end::Title-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Chart-->
                                <div class="d-flex flex-center w-100">
                                    <div class="mixed-widget-17-chart" data-kt-chart-color="primary" style="height: 300px"></div>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Content-->
                                <div class="text-center w-100 position-relative z-index-1" style="margin-top: -130px">

                                    <!--begin::Action-->
                                    <div class="mb-9 mb-xxl-1">
                                        <a href='<?= base_url('master/pendukung') ?>' class="btn btn-danger fw-semibold">Lihat Detail</a>
                                    </div>
                                    <!--ed::Action-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card widget 19-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::Card widget 19-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Heading-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold text-gray-800 m-0">Jumlah Relawan</h4>
                                    <!--end::Title-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Chart-->
                                <div class="d-flex flex-center w-100 flex-column" style="height : 170px;">
                                    <span class="text-primary " style="font-size : 60px;"><?= simple_number($relawan) ?></span>
                                    <span class="text-muted"><?= number_format($relawan, 0, ',', '.'); ?> Orang</span>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Content-->
                                <div class="text-center w-100 z-index-1">
                                    <!--begin::Action-->
                                    <div class="mb-9 mb-xxl-1">
                                        <a href='<?= base_url('master/relawan') ?>' class="btn btn-danger fw-semibold" <?= ($this->session->userdata('vol_id_role') == 1) ? 'disabled' : ''; ?>>Lihat Detail</a>
                                    </div>
                                    <!--ed::Action-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card widget 19-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Charts Widget 3-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header flex-nowrap pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">Data pendukung</span>
                                    <span class="text-gray-400 pt-2 fw-semibold fs-6"><?= date('F Y') ?></span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
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
                    <div class="col-xl-6">
                        <!--begin::Chart widget 5-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header flex-nowrap pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">Data pendukung tiap kelurahan</span>
                                    <span class="text-gray-400 pt-2 fw-semibold fs-6"><?= date('F Y') ?></span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5 ps-6">
                                <div id="kt_charts_widget_5" class="min-h-auto"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-12 col-xl-12 col-xl-6 mb-5 mb-xl-0" id="base_table">
                        <!--begin::Chart widget 3-->
                        <div class="card card-flush overflow-hidden h-md-100" id="reload_table">
                            <!--begin::Header-->
                            <div class="card-header flex-nowrap pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">RANK VOLUNTEER</span>
                                    <span class="text-gray-400 pt-2 fw-semibold fs-6">Daftar pencapaian relawan</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-2">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center min-w-50px">RANK</th>
                                            <th class="min-w-200px">RELAWAN</th>
                                            <th class="text-center min-w-100px">JUMLAH PENDUKUNG</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <?php if ($poin) : ?>
                                            <?php $no = $offset;
                                            foreach ($poin as $row) : $num = $no++; ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php if ($num == 1) : ?>
                                                            <i class="fa-solid fa-medal" style="color : #FFD700;font-size : 20px;"></i>
                                                        <?php elseif ($num == 2) : ?>
                                                            <i class="fa-solid fa-medal" style="color : #C0C0C0;font-size : 20px;"></i>
                                                        <?php elseif ($num == 3) : ?>
                                                            <i class="fa-solid fa-medal" style="color : #945D41;font-size : 20px;"></i>
                                                        <?php else : ?>
                                                            <?= $num; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-45px me-5">
                                                                <img src="<?= image_check($row->foto, 'user') ?>" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a class="text-dark fw-bold text-hover-primary fs-6"><?= $row->nama; ?></a>
                                                                <span class="text-muted fw-semibold text-muted d-block fs-7"><?= $row->email; ?></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= number_format($row->pendukung, 0, ',', '.'); ?> Orang
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr colspan="3">
                                                <td>TIDAK ADA DATA RELAWAN TERSEDIA</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                                <?= $this->pagination->create_links(); ?>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Chart widget 3-->
                    </div>
                    <!--end::Col-->
                </div>


            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->
    <div id="kt_app_footer" class="app-footer">
        <!--begin::Footer container-->
        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted fw-semibold me-1">2023&copy;</span>
                <a href="https://alphatechin.id/" target="_blank" class="text-gray-800 text-hover-primary">PT. Alpha Tech Indonesiana</a>
            </div>
            <!--end::Copyright-->
        </div>
        <!--end::Footer container-->
    </div>
    <!--end::Footer-->
</div>
<!--end:::Main-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::App-->