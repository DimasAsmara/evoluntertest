<style>
    input[type="checkbox"].meanwhile {
        position: absolute;
        opacity: 0;
    }

    label {
        cursor: pointer;
    }
</style>
<!--begin::Heading-->
<div class="text-center mb-9 showin" id="terdaftar">
    <!--begin::Title-->
    <h1 class="mb-3">PENDUDUK <span class="text-primary"><?= strtoupper($result->nama); ?></span></h1>
    <!--end::Title-->
    <!--begin::Description-->
    <div class="text-muted fw-semibold fs-5">Berikut adalah list warga yang terdaftar pada <?= $result->nama; ?></div>
    <!--end::Description-->
</div>

<div class="text-center mb-9 hidin" id="nondaftar">
    <!--begin::Title-->
    <h1 class="mb-3">PENDUDUK BELUM TERDAFTAR TPS</span></h1>
    <!--end::Title-->
    <!--begin::Description-->
    <div class="text-muted fw-semibold fs-5">Berikut adalah list warga yang belum terdaftar pada TPS manapun</div>
    <!--end::Description-->
</div>
<!--end::Heading-->
<!--begin::Users-->
<!--begin::Users group-->
<div class="symbol-group symbol-hover flex-nowrap d-flex justify-content-center align-items-center mb-10">

    <div class="symbol showin" id="btn_tambah">
        <span onclick="switch_content_warga('add')" class="symbol-label bg-dark text-gray-300 fs-8 fw-bold" style="width : 120px;height : 35px;border-radius : 30px;">Tambah Warga</span>
    </div>
    <div class="symbol hidin" id="btn_kembali">
        <span onclick="switch_content_warga('see')" class="symbol-label bg-dark text-gray-300 fs-8 fw-bold" style="width : 120px;height : 35px;border-radius : 30px;">Kembali</span>
    </div>

</div>
<!--end::Users group-->
<div class="mb-15">
    <form method="POST" action="<?= base_url('master_function/set_warga') ?>" id="form_warga">

        <input type="hidden" name="id_tps" value="<?= $result->id_tps; ?>">
        <div id="warga_tps" class="showin">
            <!--begin::List-->
            <?php if ($warga_tps) : ?>
                <div class="mh-375px scroll-y me-n7 pe-7" id="list_warga">

                    <?php $no = 0;
                    foreach ($warga_tps as $row) : $num = $no++; ?>
                        <div class="filter showin">
                            <input onchange="choose_warga(this,<?= $row->id_penduduk; ?>)" type="checkbox" value="<?= $row->id_penduduk; ?>" name="id_penduduk_1[]" class="meanwhile hps_row" id="check-<?= $row->id_penduduk; ?>">
                            <!--begin::User-->
                            <label for="check-<?= $row->id_penduduk; ?>" class="card rounded border border-dashed mb-5">
                                <div class="card-body d-flex flex-stack">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <?php
                                            $color = '';
                                            if ($num % 3 == 0) {
                                                $color = 'bg-primary';
                                            } elseif ($num % 2 == 0) {
                                                $color = 'bg-warning';
                                            } else {
                                                $color = 'bg-success';
                                            }
                                            ?>
                                            <span class="symbol-label <?= $color; ?> text-inverse-warning fw-bold"><?= initials($row->nama, 2) ?></span>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center fs-5 fw-bold text-dark"><?= $row->nama; ?></div>
                                            <!--end::Name-->
                                            <!--begin::Email-->
                                            <div class="fw-semibold text-muted"><?= ifnull($row->email, ' - '); ?></div>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Details-->
                                </div>

                            </label>
                            <!--end::User-->
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!--end::List-->
        </div>
        <div id="warga_non_tps" class="hidin">
            <!--begin::List-->
            <?php if ($warga_non_tps) : ?>
                <div class="mh-375px scroll-y me-n7 pe-7" id="list_warga_non">
                    <?php $no = 0;
                    foreach ($warga_non_tps as $row) : $num = $no++; ?>
                        <?php
                        $color = '';
                        if ($num % 3 == 0) {
                            $color = 'bg-primary';
                        } elseif ($num % 2 == 0) {
                            $color = 'bg-warning';
                        } else {
                            $color = 'bg-success';
                        }
                        ?>

                        <div class="filter showin">
                            <input onchange="choose_warga(this,<?= $row->id_penduduk; ?>,true)" type="checkbox" value="<?= $row->id_penduduk; ?>" name="id_penduduk_2[]" class="meanwhile tbh_row" id="check-2-<?= $row->id_penduduk; ?>">
                            <!--begin::User-->
                            <label for="check-2-<?= $row->id_penduduk; ?>" class="card rounded border border-dashed mb-5">
                                <div class="card-body d-flex flex-stack">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label <?= $color; ?> text-inverse-warning fw-bold"><?= initials($row->nama, 2) ?></span>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center fs-5 fw-bold text-dark"><?= $row->nama; ?></div>
                                            <!--end::Name-->
                                            <!--begin::Email-->
                                            <div class="fw-semibold text-muted"><?= ifnull($row->email, ' - '); ?></div>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Details-->
                                </div>

                            </label>
                            <!--end::User-->
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!--end::List-->
        </div>

    </form>

    <div id="display_vector" class="<?php if (!$warga_tps) {
                                        if (!$relawan) {
                                            echo 'd-flex justify-content-center align-items-center flex-column';
                                        } else {
                                            echo 'hidin';
                                        }
                                    } else {
                                        echo 'hidin';
                                    } ?>">
        <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
        <p width="100px" class="text-center">
            Data penduduk pada wilayah ini tidak tersedia. Hubungi admin jika terdapat kesalahan!
        </p>
    </div>
</div>
<!--end::Users-->
<!--begin::Notice-->
<div class=" <?= ($warga_tps) ? 'd-flex justify-content-between showin' : 'hidin'; ?>" id="action_hapus">
    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid">
        <input class="form-check-input" onchange="filter_warga(this,'hps_row')" type="checkbox" />
        <span class="form-check-label fw-semibold text-muted">Pilih semua warga</span>
    </label>
    <!--end::Switch-->
    <button type="button" onclick="submit_form(this,'#form_warga',2)" id="hapus_warga" class="btn btn-danger">Hapus<span></span></button>
</div>

<div class="hidin" id="action_tambah">
    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid">
        <input class="form-check-input" onchange="filter_warga(this,'tbh_row')" type="checkbox" />
        <span class="form-check-label fw-semibold text-muted">Pilih semua warga</span>
    </label>
    <!--end::Switch-->
    <button type="button" onclick="submit_form(this,'#form_warga',2)" id="tambah_warga" class="btn btn-primary">Simpan<span></span></button>
</div>
<!--end::Notice-->