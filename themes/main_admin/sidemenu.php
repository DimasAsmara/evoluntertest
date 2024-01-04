<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        <div id="kt_app_header" class="app-header">
            <!--begin::Header container-->
            <div class="app-container container-fluid d-flex align-items-stretch flex-stack" id="kt_app_header_container">
                <!--begin::Sidebar toggle-->
                <div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2" id="kt_app_sidebar_mobile_toggle">
                        <i class="ki-outline ki-abstract-14 fs-2"></i>
                    </div>
                    <!--begin::Logo image-->
                    <a href="<?= base_url('dashboard') ?>">
                        <img alt="Logo" src="<?= base_url(); ?>assets/img/logo/long.png" class="h-30px" />
                    </a>
                    <!--end::Logo image-->
                </div>
                <!--end::Sidebar toggle-->
                <!--begin::Navbar-->
                <div class="app-navbar flex-lg-grow-1" id="kt_app_header_navbar">
                    <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
                        <!-- <h1>Selamat Pagi!!</h1> -->
                    </div>
                    <!--begin::User menu-->
                    <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-circle symbol-35px symbol-md-45px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img src="<?= image_check($this->session->userdata('vol_foto'), 'user') ?>" alt="user" />
                        </div>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo" src="<?= image_check($this->session->userdata('vol_foto'), 'user') ?>" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bold d-flex align-items-center fs-5"><?= $this->session->userdata('vol_nama') ?>
                                            <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"><?= $this->session->userdata('vol_role') ?></span>
                                        </div>
                                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?= $this->session->userdata('vol_email') ?></a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <!-- <div class="menu-item px-5">
                                <a href="<?= base_url('profil') ?>" class="menu-link px-5">Profil</a>
                            </div> -->
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="<?= base_url('auth/logout') ?>" onclick="confirm_alert(this,event,'Apakah anda yakin akan meninggalkan sistem?')" class="menu-link px-5">Keluar</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::User account menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::User menu-->
                </div>
                <!--end::Navbar-->
                <!--begin::Separator-->
                <div class="app-navbar-separator separator d-none d-lg-flex"></div>
                <!--end::Separator-->
            </div>
            <!--end::Header container-->
        </div>
        <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Sidebar-->
            <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                <div class="app-sidebar-header d-flex flex-stack d-none d-lg-flex pt-8 pb-2" id="kt_app_sidebar_header">
                    <!--begin::Logo-->
                    <a href="<?= base_url('dashboard') ?>" class="app-sidebar-logo">
                        <img alt="Logo" src="<?= base_url(); ?>assets/img/logo/long.png" class="h-45px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Sidebar toggle-->
                    <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-light btn-color-gray-700 btn-active-color-primary d-none d-lg-flex rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                        <i class="ki-outline ki-text-align-right rotate-180 fs-1"></i>
                    </div>
                    <!--end::Sidebar toggle-->
                </div>
                <!--begin::Navs-->
                <div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
                    <div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header" data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">

                        <!--begin::Sidebar menu-->
                        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                            <!--begin::Heading-->
                            <div class="menu-item mb-2">
                                <div class="menu-heading text-uppercase fs-7 fw-bold">Menu</div>
                                <!--begin::Separator-->
                                <div class="app-sidebar-separator separator"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Heading-->
                            <?php if ($this->session->userdata('vol_id_role') != 1) : ?>
                                <!--begin:Menu item-->
                                <a href="<?= base_url('dashboard'); ?>" class="menu-item here show menu-accordion">
                                    <!--begin:Menu link-->
                                    <span class="menu-link <?= set_menu_active($this->uri->segment(1), ['dashboard']) ?>">
                                        <span class="menu-icon">
                                            <i class="fa-light fa-home fs-2"></i>
                                        </span>
                                        <span class="menu-title">Beranda</span>
                                    </span>
                                    <!--end:Menu link-->
                                </a>
                                <!--end:Menu item-->
                            <?php endif; ?>
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show">
                                <!--begin:Menu link-->
                                <span class="menu-link <?= set_menu_active($this->uri->segment(1), ['master']) ?>">
                                    <span class="menu-icon">
                                        <i class="fa-light fa-brain fs-2"></i>
                                    </span>
                                    <span class="menu-title">Master</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                        <!--begin:Menu item-->
                                        <a href="<?= base_url('master/relawan') ?>" class="menu-item menu-accordion <?= set_submenu_active($this->uri->segment(1), ['master'], $this->uri->segment(2), ['relawan']) ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Data Relawan</span>
                                            </span>
                                            <!--end:Menu link-->
                                        </a>
                                        <!--end:Menu item-->
                                    <?php endif; ?>
                                    <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                        <!--begin:Menu item-->
                                        <a href="<?= base_url('master/wilayah') ?>" class="menu-item menu-accordion <?= set_submenu_active($this->uri->segment(1), ['master'], $this->uri->segment(2), ['wilayah']) ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Data Kelurahan</span>
                                            </span>
                                            <!--end:Menu link-->
                                        </a>
                                        <!--end:Menu item-->
                                    <?php endif; ?>
                                    <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                        <!--begin:Menu item-->
                                        <a href="<?= base_url('master/tps') ?>" class="menu-item menu-accordion <?= set_submenu_active($this->uri->segment(1), ['master'], $this->uri->segment(2), ['tps']) ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Data TPS</span>
                                            </span>
                                            <!--end:Menu link-->
                                        </a>
                                        <!--end:Menu item-->
                                    <?php endif; ?>
                                    <!--begin:Menu item-->
                                    <a href="<?= base_url('master/penduduk') ?>" class="menu-item menu-accordion <?= set_submenu_active($this->uri->segment(1), ['master'], $this->uri->segment(2), ['penduduk']) ?>">
                                        <!--begin:Menu link-->
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Data penduduk</span>
                                        </span>
                                        <!--end:Menu link-->
                                    </a>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <a href="<?= base_url('master/pendukung') ?>" class="menu-item menu-accordion <?= set_submenu_active($this->uri->segment(1), ['master'], $this->uri->segment(2), ['pendukung']) ?>">
                                        <!--begin:Menu link-->
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Data Pendukung</span>
                                        </span>
                                        <!--end:Menu link-->
                                    </a>
                                    <!--end:Menu item-->

                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                <!--begin:Menu item-->
                                <a href="<?= base_url('import'); ?>" class="menu-item here show menu-accordion">
                                    <!--begin:Menu link-->
                                    <span class="menu-link <?= set_menu_active($this->uri->segment(1), ['import']) ?>">
                                        <span class="menu-icon">
                                            <i class="fa-light fa-files fs-2"></i>
                                        </span>
                                        <span class="menu-title">Import</span>
                                    </span>
                                    <!--end:Menu link-->
                                </a>
                                <!--end:Menu item-->
                            <?php endif; ?>
                            <?php if ($this->session->userdata('vol_id_role') == 2) : ?>
                                <!--begin:Menu item-->
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show">
                                    <!--begin:Menu link-->
                                    <span class="menu-link <?= set_menu_active($this->uri->segment(1), ['statistik']) ?>">
                                        <span class="menu-icon">
                                            <i class="fa-light fa-chart-simple fs-2"></i>
                                        </span>
                                        <span class="menu-title">Statistik</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->
                                    <div class="menu-sub menu-sub-accordion">
                                        <!--begin:Menu item-->
                                        <a href="<?= base_url('statistik/kelurahan') ?>" class="menu-item menu-accordion <?= set_submenu_active($this->uri->segment(1), ['statistik'], $this->uri->segment(2), ['kelurahan']) ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Data per Kelurahan</span>
                                            </span>
                                            <!--end:Menu link-->
                                        </a>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <a href="<?= base_url('statistik/relawan') ?>" class="menu-item menu-accordion <?= set_submenu_active($this->uri->segment(1), ['statistik'], $this->uri->segment(2), ['relawan']) ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Data per Relawan</span>
                                            </span>
                                            <!--end:Menu link-->
                                        </a>
                                        <!--end:Menu item-->

                                    </div>
                                    <!--end:Menu sub-->
                                </div>
                                <!--end:Menu item-->
                            <?php endif; ?>

                        </div>
                        <!--end::Sidebar menu-->
                    </div>
                </div>
                <!--end::Navs-->
            </div>