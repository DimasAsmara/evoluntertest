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
<div class="text-center mb-9">
    <!--begin::Title-->
    <h1 class="mb-3">RELAWAN <span class="text-primary"><?= strtoupper($result->nama); ?></span></h1>
    <!--end::Title-->
    <!--begin::Description-->
    <div class="text-muted fw-semibold fs-5">Relawan yang di pilih akan menjadi PIC di dalam kelurahan terpilih.</div>
    <!--end::Description-->
    <!-- <div class="btn-group btn-outline-primary" role="group" aria-label="Klik untuk mencantumkan semua relawan" style="border : 1px solid #50cd89">
        <input type="checkbox" class="btn-check" id="pilih_semua" autocomplete="off">
        <label class="btn btn-outline-primary" for="pilih_semua">Cantumkan semua relawan</label>
    </div> -->
</div>
<!--end::Heading-->
<!--begin::Users-->
<!--begin::Users group-->
<div class="symbol-group symbol-hover flex-nowrap d-flex justify-content-center align-items-center mb-10">
    <div id="display_relawan" class="<?php if ($all_relawan) {
                                            echo 'showin';
                                        } else {
                                            echo 'hidin';
                                        } ?>">
        <?php if ($relawan) : ?>
            <?php $no = 1;
            foreach ($relawan as $row) : $num = $no++; ?>
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
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?= $row->relawan; ?>" style="z-index : 2;">
                    <?php if ($row->foto == '') : ?>
                        <span class="symbol-label <?= $color; ?> text-inverse-warning fw-bold"><?= initials($row->relawan, 2) ?></span>
                    <?php else : ?>
                        <img alt="<?= $row->relawan; ?>" src="<?= image_check($row->foto, 'user') ?>" />
                    <?php endif; ?>
                </div>
                <?php if ($num == 7) {
                    break;
                } ?>
            <?php endforeach; ?>
            <div class="symbol">
                <span onclick="switch_content_relawan('see')" class=" symbol-label bg-dark text-gray-300 fs-8 fw-bold" style="width : 120px;height : 35px;border-radius : 30px;"><?php if (count($relawan) > 7) {
                                                                                                                                                                                        echo
                                                                                                                                                                                        '+' . (count($relawan) - 7);
                                                                                                                                                                                    } ?> Lihat Semua</span>
            </div>
        <?php endif; ?>
    </div>

    <div id="display_add_relawan" class="<?php if ($all_relawan) {
                                                echo 'hidin';
                                            } else {
                                                echo 'showin';
                                            } ?>">
        <div class="symbol">
            <span onclick="switch_content_relawan('add')" class="symbol-label bg-dark text-gray-300 fs-8 fw-bold" style="width : 120px;height : 35px;border-radius : 30px;">Tambah Relawan</span>
        </div>
    </div>

</div>
<!--end::Users group-->
<div class="mb-15">
    <form method="POST" action="<?= base_url('master_function/set_relawan') ?>" id="form_relawan">

        <input type="hidden" name="id_kelurahan" value="<?= $id_kelurahan; ?>">
        <div id="relawan_other" class="<?php if ($all_relawan) {
                                            echo 'showin';
                                        } else {
                                            echo 'hidin';
                                        } ?>">
            <!--begin::List-->
            <?php if ($all_relawan) : ?>
                <div class="mh-375px scroll-y me-n7 pe-7" id="list_relawan">
                    <?php foreach ($all_relawan as $row) : ?>
                        <div class="filter showin" <?php if (!in_array($row->id_user, $id_penugasan)) :  ?> data-free="true" <?php else : ?> data-free="false" <?php endif; ?>>
                            <input onchange="choose_relawan(this,<?= $row->id_user; ?>)" type="checkbox" value="<?= $row->id_user; ?>" name=" id_user[]" class="meanwhile" id="check-<?= $row->id_user; ?>">
                            <!--begin::User-->
                            <label for="check-<?= $row->id_user; ?>" class="card rounded border border-dashed mb-5">
                                <div class="card-body d-flex flex-stack">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="<?= $row->relawan; ?>" src="<?= image_check($row->foto, 'user') ?>" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center fs-5 fw-bold text-dark"><?= $row->relawan; ?></div>
                                            <!--end::Name-->
                                            <!--begin::Email-->
                                            <div class="fw-semibold text-muted"><?= $row->email; ?></div>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Stats-->
                                    <div class="d-flex">
                                        <?php if (in_array($row->id_user, $id_penugasan)) : ?>
                                            <!--begin::Sales-->
                                            <div class="text-end badge text-success">
                                                <div class="fw-bold fs-8">Sudah Ditempatkan (<?= array_count_values($id_penugasan)[$row->id_user]; ?>)</div>
                                            </div>
                                            <!--end::Sales-->
                                        <?php else : ?>
                                            <!--begin::Sales-->
                                            <div class="text-end badge text-danger">
                                                <div class="fw-bold fs-8">Belum Ditempatkan</div>
                                            </div>
                                            <!--end::Sales-->
                                        <?php endif; ?>
                                    </div>
                                    <!--end::Stats-->
                                </div>

                            </label>
                            <!--end::User-->
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!--end::List-->
        </div>
        <div id="relawan_shooter" class="<?php if ($all_relawan) {
                                                echo 'hidin';
                                            } else {
                                                echo 'showin';
                                            } ?>">
            <!--begin::List-->
            <?php if ($relawan) : ?>
                <div class="mh-375px scroll-y me-n7 pe-7" id="list_relawan_register">
                    <?php foreach ($relawan as $row) : ?>
                        <div class="filter showin" <?php if (!in_array($row->id_user, $id_penugasan)) :  ?> data-free="true" <?php else : ?> data-free="false" <?php endif; ?>>
                            <input onchange="choose_relawan(this,<?= $row->id_user; ?>,true)" type="checkbox" value="<?= $row->id_user; ?>" name="id_relawan[]" class="meanwhile" id="check-2-<?= $row->id_user; ?>">
                            <!--begin::User-->
                            <label for="check-2-<?= $row->id_user; ?>" class="card rounded border border-dashed mb-5">
                                <div class="card-body d-flex flex-stack">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="<?= $row->relawan; ?>" src="<?= image_check($row->foto, 'user') ?>" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center fs-5 fw-bold text-dark"><?= $row->relawan; ?></div>
                                            <!--end::Name-->
                                            <!--begin::Email-->
                                            <div class="fw-semibold text-muted"><?= $row->email; ?></div>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Stats-->
                                    <div class="d-flex">
                                        <!--begin::Sales-->
                                        <div class="text-end badge text-success">
                                            <div class="fw-bold fs-8">Sudah Ditempatkan (<?= array_count_values($id_penugasan)[$row->id_user]; ?>)</div>
                                        </div>
                                    </div>
                                    <!--end::Stats-->
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

    <div id="display_vector" class="<?php if (!$all_relawan) {
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
            Data relawan tidak di temukan! Relawan yang di cari telah tergabung dalam wilayah ini atau tidak terdapat data relawan. Hubungi admin jika terjadi kesalahan
        </p>
    </div>
</div>
<!--end::Users-->
<!--begin::Notice-->
<div class="d-flex <?php if ($all_relawan) {
                        echo 'justify-content-between';
                    } else {
                        echo 'justify-content-center';
                    } ?>">
    <!--begin::Switch-->
    <label class=" form-check form-switch form-check-custom form-check-solid <?php if ($all_relawan) {
                                                                                    echo 'showin';
                                                                                } else {
                                                                                    echo 'hidin';
                                                                                } ?>">
        <input class="form-check-input" onchange="filter_relawan(this)" type="checkbox" />
        <span class="form-check-label fw-semibold text-muted">Tampilkan relawan yang belum </br>menerima penugasan</span>
    </label>
    <!--end::Switch-->
    <button type="button" onclick="submit_form(this,'#form_relawan',2)" id="simpan_relawan" class="btn btn-primary">Simpan<span></span></button>
</div>
<!--end::Notice-->