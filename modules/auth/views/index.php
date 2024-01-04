<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div id="display_vector" class="d-flex flex-lg-row-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <!--begin::Image-->
                <img id="vector_login" class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 <?php if (!$tab || $tab == 'login') {
                                                                                                            echo 'showin';
                                                                                                        } else {
                                                                                                            echo 'hidin';
                                                                                                        } ?>" src="<?= base_url(); ?>assets/img/vector/login_vector.svg" alt="" />
                <img id="vector_regis" class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 <?php if ($tab == 'regis') {
                                                                                                            echo 'showin';
                                                                                                        } else {
                                                                                                            echo 'hidin';
                                                                                                        } ?>" src="<?= base_url(); ?>assets/img/vector/regis_vector.svg" alt="" />
                <img id="vector_forgot" class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 <?php if ($tab == 'forgot') {
                                                                                                            echo 'showin';
                                                                                                        } else {
                                                                                                            echo 'hidin';
                                                                                                        } ?>" src="<?= base_url(); ?>assets/img/vector/forgot_vector.svg" alt="" />
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7 showin">Sistem Manajemen Relawan</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="text-gray-600 fs-base text-center fw-semibold showin">
                    <p style="width : 400px">
                        Manajemen kegiatan dan log pekerjaan relawan. Semua laporan dapat anda organisir hanya dengan menggunakan device anda.
                    </p>

                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div id="bg_vector" style="background-image : url('<?= base_url('assets/img/vector/bg_login_vector.svg') ?>')"></div>
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 showin">
            <!--begin::Wrapper-->
            <div id="form_wrapper" class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <!--begin::Content Login-->
                <div id="login_page" class="h-lg-100 w-md-400px <?php if (!$tab || $tab == 'login') {
                                                                    echo 'showing';
                                                                } else {
                                                                    echo 'hiding';
                                                                } ?>">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-5">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="<?= base_url('auth/login_proses') ?><?= ($this->input->get('fcm_key')) ? '?fcm_key=' . $this->input->get('fcm_key') : ''; ?>">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Masuk</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Masukan email dan kata sandi terdaftar untuk dapat melanjutkan akses.</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" style="text-transform:lowercase;" />
                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="Kata Sandi" name="password" autocomplete="off" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="ki-outline ki-eye-slash fs-2"></i>
                                            <i class="ki-outline ki-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <!--begin::Link-->
                                <button type="button" class="link-primary btn-verb to_forgot">Lupa kata sandi ?</button>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Masuk</span>
                                    <!--end::Indicator label-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Ingin menjadi relawan?
                                <button type="button" class="link-primary btn-verb to_regis">Daftar Sekarang</button>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content Login-->

                <!--begin::Content Regis-->
                <div id="regis_page" class="h-lg-100 w-md-400px <?php if ($tab == 'regis') {
                                                                    echo 'showing';
                                                                } else {
                                                                    echo 'hiding';
                                                                } ?>">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-5">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST" action="<?= base_url('auth/regis_proses'); ?><?= ($this->input->get('fcm_key')) ? '?fcm_key=' . $this->input->get('fcm_key') : ''; ?>">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Daftar</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Masukan data diri valid untuk dapat mendaftar</div>
                                <!--end::Subtitle=-->
                            </div>

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Kode-->
                                <input type="text" placeholder="-- Kode Relawan --" name="kode" autocomplete="off" class="form-control bg-transparent" style='text-transform:uppercase;text-align : center;' />
                                <!--end::Kode-->
                            </div>
                            <!--begin::Input group-->


                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" style="text-transform:lowercase;" />
                                <!--end::Email-->
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="Kata Sandi" name="password" autocomplete="off" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="ki-outline ki-eye-slash fs-2"></i>
                                            <i class="ki-outline ki-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">Sandi harus terdiri dari minimal 8 campuran huruf kecil, kapital, angka dan simbol</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->
                            <!--end::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Repeat Password-->
                                <input placeholder="Konfirmasi kata sandi" name="repassword" type="password" autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Repeat Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Daftar</span>
                                    <!--end::Indicator label-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Sudah menjadi relawan?
                                <button type="button" class="link-primary btn-verb to_login">Masuk Sekarang</button>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content Regis-->

                <!--begin::Content Forgot-->
                <div id="forgot_page" class="h-lg-100 w-md-400px <?php if ($tab == 'forgot') {
                                                                        echo 'showing';
                                                                    } else {
                                                                        echo 'hiding';
                                                                    } ?>">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-5">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_forgot_form" method="POST" action="<?= base_url('auth/forgot_proses') ?>">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Lupa Kata Sandi</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Masukan email terdaftar untuk memproses perubahan kata sandi</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" style="text-transform:lowercase;" />
                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_forgot_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Kirim</span>
                                    <!--end::Indicator label-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                <button type="button" class="link-primary btn-verb to_regis">Daftar</button> atau
                                <button type="button" class="link-primary btn-verb to_login">masuk</button>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content Forgot-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->