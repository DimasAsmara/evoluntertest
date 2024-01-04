<div class="base-content" id="base_load">
    <div class="slide-layout" id="base_reload">
        <div page="home" class="sliding <?= $active['home']; ?>">
            <div class="device">
                <div class="header">
                    <div class="left-side">
                        <h1>Hello, <?= short_text($this->session->userdata('vol_nama'), 11); ?> 👋</h1>
                        <span><?= $this->session->userdata('vol_role') ?></span>
                    </div>
                    <div class="avatar" style="background-image : url(<?= image_check($this->session->userdata('vol_foto'), 'user') ?>)"></div>
                </div>
                <div class="content">
                    <div class="stc">
                        <div class="clow">
                            <div class="card count">
                                <span class="title"><?= simple_number($penduduk) ?></span>
                                <span class="text"><?= number_format($penduduk, 0, ',', '.'); ?> Penduduk</span>
                            </div>

                            <div class="card count">
                                <span class="title"><?= simple_number($relawan) ?></span>
                                <span class="text"><?= number_format($relawan, 0, ',', '.'); ?> Relawan</span>
                            </div>
                        </div>

                        <!-- PERSENTASE PENDUKUNG GLOBAL-->
                        <div class="clow">
                            <div class="card card-large" style="height : 200px;">
                                <div class="mixed-widget-17-chart" data-kt-chart-color="primary" style="height: 300px;margin-top : 100px;"></div>

                            </div>
                        </div>

                        <!-- PROGRESS PENDUKUNG  -->
                        <div class="clow">

                            <div class="card card-large">
                                <div id="kt_charts_widget_3_chart" style="height: 350px"></div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div page="input" class="sliding <?= $active['input']; ?>">
            <form class="form_input" id="form_cari_penduduk" action="<?= base_url('mobile/cari_penduduk') ?>" method="POST" enctype="multipart/form-data">
                <h2>PENDAFTARAN PENDUKUNG</h2>
                <div class="form-group fluete" id="req_kelurahan">
                    <label for="kelurahan" class="required">Kelurahan</label>
                    <select name="kelurahan" onchange="get_tps(this,'#id_tps')">
                        <option value="" selected disabled>Pilih kelurahan</option>
                        <?php if ($list_kelurahan) : ?>
                            <?php foreach ($list_kelurahan as $row) : ?>
                                <option value="<?= $row->id_kelurahan; ?>"><?= $row->nama; ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">Tidak ada kelurahan tersedia</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group fluete" id="req_tps">
                    <label for="tps">TPS</label>
                    <select name="tps" id="id_tps">
                        <option value="all" selected>Semua</option>
                    </select>
                </div>
                <div class="bagi-2 fluete">
                    <div class="form-group" id="req_rt">
                        <label for="rt">RT</label>
                        <select name="rt">
                            <option value="all" selected>Semua</option>
                            <?php for ($i = 1; $i <= 20; $i++) { ?>
                                <option value="<?= $i ?>"><?= 'RT ' . $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" id="req_rw">
                        <label for="rw">RW</label>
                        <select name="rw">
                            <option value="all" selected>Semua</option>
                            <?php for ($i = 1; $i <= 20; $i++) { ?>
                                <option value="<?= $i ?>"><?= 'RW ' . $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group fluete" id="req_nama">
                    <label for="nama" class="required">Nama Penduduk</label>
                    <input type="text" name="nama" placeholder="Masukan nama penduduk" autocomplete="off">
                </div>

                <div class="form-group submit-btn" id="cari_btn">
                    <button type="button" id="cari_penduduk" onclick="set_penduduk(this,'#form_cari_penduduk',0)">Cari</button>

                </div>

                <div class="form-group reset-btn hiding" id="reset_btn">
                    <button type="button" id="reset_penduduk" onclick="rst_penduduk('#form_cari_penduduk')">Cari Lainya</button>

                </div>

                <div id="form_add_penduduk" class="card card-large form_input hiding" style="border-radius : 10px;">
                    <div class="image-manage" style="margin-bottom : 20px">
                        <div class="manager-split-50">
                            <!--begin::Image input-->
                            <div class="image-input v2" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg');margin-bottom : 4px;width:100%;">
                                <!--begin::Image preview wrapper-->
                                <div id="display_foto_1" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg')"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn_input_foto" data-kt-image-input-action="change" style="display : flex;" data-bs-dismiss="click" title="Ubah Foto">
                                    <i class="fa fa-pencil fs-6"></i>

                                    <!--begin::Inputs-->
                                    <input type="file" name="foto_pendukung" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn_input_foto" data-kt-image-input-action="cancel" data-bs-dismiss="click" title="Batalkan Foto">
                                    <i class="fa fa-trash fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn_input_foto hps" data-kt-image-input-action="remove" data-bs-dismiss="click" title="Hapus Foto">
                                    <i class="fa fa-trash fs-3"></i>
                                </span>
                                <!--end::Remove button-->
                            </div>
                            <!--end::Image input-->
                            <span class="text_image required">Foto Pendukung</span>
                        </div>
                        <div class="manager-split-50">
                            <!--begin::Image input-->
                            <div class="image-input v2" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>data/default/env.jpg');margin-bottom : 4px;width:100%;">
                                <!--begin::Image preview wrapper-->
                                <div id="display_foto_2" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= base_url(); ?>data/default/env.jpg');"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn_input_foto" data-kt-image-input-action="change" style="display : flex;" data-bs-dismiss="click" title="Ubah Foto">
                                    <i class="fa fa-pencil fs-6"></i>

                                    <!--begin::Inputs-->
                                    <input type="file" name="foto_ktp" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn_input_foto" data-kt-image-input-action="cancel" data-bs-dismiss="click" title="Batalkan Foto">
                                    <i class="fa fa-trash fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn_input_foto hps" data-kt-image-input-action="remove" data-bs-dismiss="click" title="Hapus Foto">
                                    <i class="fa fa-trash fs-3"></i>
                                </span>
                                <!--end::Remove button-->
                            </div>
                            <!--end::Image input-->
                            <span class="text_image required">Foto KTP</span>
                        </div>


                    </div>

                    <div class="form-group" style="width : 100%;" id="req_nama2">
                        <label for="nama2" class="required">Nama Penduduk</label>
                        <input type="hidden" name="id_penduduk">
                        <input type="text" name="nama2" placeholder="Masukan nama penduduk" autocomplete="off">
                    </div>
                    <div class="form-group" style="width : 100%;" id="req_nik">
                        <label for="nik" class="required">NIK</label>
                        <input type="text" name="nik" placeholder="Masukan NIK" autocomplete="off">
                    </div>
                    <div class="form-group" style="width : 100%;" id="req_gender">
                        <label for="gender" class="required">Gender</label>
                        <select name="gender">
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div style="width : 100%;" class="form-group sukses-btn">
                        <button type="button" id="button_tambah_pendukung" onclick="submit_form(this,'#form_cari_penduduk',0,'',false,false,`<?= base_url('mobile/tambah_pendukung') ?>`)">Tambahkan Pendukung</button>

                    </div>
                    <div style="width : 100%;" class="form-group danger-btn">
                        <button type="button" onclick="batalkan_form()">Batal</button>

                    </div>
                </div>
                <div id="display_value" class="showing">
                </div>
            </form>



        </div>
        <div page="profil" class="sliding <?= $active['profil']; ?>">

            <div class="container-2">
                <div class="container-head">
                </div>
                <div id="dtl_prf" class="container-body showing">
                    <div class="profile-picture">
                        <!--begin::Image input-->
                        <form id="change_foto" action="<?= base_url('mobile/edit_foto') ?>" method="post" enctype="multipart/form-data">
                            <div class="image-input pendek image-input-circle" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>/data/default/user.jpg')">
                                <!--begin::Image preview wrapper-->
                                <div id="display_foto" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= image_check($this->session->userdata('vol_foto'), 'user') ?>')"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn_input_foto" data-kt-image-input-action="change" data-bs-dismiss="click" title="Ubah Foto">
                                    <i class="fa fa-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                    <!--begin::Inputs-->
                                    <input type="file" onchange="edit_foto('<?= image_check($this->session->userdata('vol_foto'), 'user') ?>')" name="foto_profil" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn_input_foto" data-kt-image-input-action="cancel" data-bs-dismiss="click" title="Batalkan Foto">
                                    <i class="fa fa-trash fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                            </div>
                        </form>

                        <!--end::Image input-->
                    </div>
                    <div class="name">
                        <p><?= $this->session->userdata('vol_nama'); ?></p>
                        <span><?= $this->session->userdata('vol_role'); ?></span>
                    </div>
                    <div class="stc_prf">
                        <div class="card_prf">
                            <i class="fa-solid fa-medal" style="color : #FFD700;"></i>
                            <span>Peringkat 1</span>
                        </div>
                        <div class="card_prf">
                            <i class="fa-solid fa-handshake" style="color : #74A059;"></i>
                            <span><?= $jumlah_pendukung; ?></span>
                        </div>
                        <div class="card_prf">
                            <i class="fa-solid fa-house" style="color : #5ca2e9;"></i>
                            <span><?= $jumlah_kelurahan ?> Kelurahan</span>
                        </div>
                    </div>
                    <div class="menu-list">
                        <a onclick="to_kata_sandi()" class="prf-menu">
                            <i class="fa-regular fa-lock"></i>
                            <span>Ubah Kata Sandi</span>
                        </a>
                        <a onclick="to_list_pendukung()" class="prf-menu">
                            <i class="fa-regular fa-list"></i>
                            <span>Data Pendukung</span>
                        </a>
                        <a href="<?= base_url('auth/logout?mobile=true') ?>" onclick="confirm_alert(this,event,'Apakah anda yakin akan meninggalkan sistem?')" class="prf-menu">
                            <i class="fa-regular fa-right-from-bracket"></i>
                            <span>Keluar</span>
                        </a>
                    </div>

                </div>
                <form class="hiding" id="form_ubah_sandi" action="<?= base_url('mobile/ubah_kata_sandi') ?>" method="POST" style="margin-top: -130px">
                    <h2>Ubah Kata Sandi</h2>

                    <div class="form-group" style="display : flex;justify-content : center;align-items : flex-start;flex-direction : column;" id="req_password">
                        <label for="password" class="required" style="text-align: left;">Kata Sandi Lama</label>
                        <input type="password" name="password" placeholder="Masukan kata sandi lama" autocomplete="off">
                    </div>
                    <div class="form-group" style="display : flex;justify-content : center;align-items : flex-start;flex-direction : column;" id="req_new_password">
                        <label for="new_password" class="required" style="text-align: left;">Kata Sandi Baru</label>
                        <input type="password" name="new_password" placeholder="Masukan kata sandi baru" autocomplete="off">
                    </div>
                    <div class="form-group" style="display : flex;justify-content : center;align-items : flex-start;flex-direction : column;" id="req_re_password">
                        <label for="re_password" class="required" style="text-align: left;">Konfirmasi Kata Sandi</label>
                        <input type="password" name="re_password" placeholder="Konfirmasi kata sandi" autocomplete="off">
                    </div>
                    <div style="width : 100%;" class="form-group sukses-btn">
                        <button type="button" id="button_ubah_sandi" onclick="submit_form(this,'#form_ubah_sandi',2)">Ubah Kata Sandi</button>

                    </div>
                    <div style="width : 100%;" class="form-group danger-btn">
                        <button type="button" onclick="batalkan_kata_sandi()">Batal</button>

                    </div>
                </form>

                <div id="pendukung_list" class="hiding">
                    <div class="form-group back-btn">
                        <button type="button" onclick="batalkan_pendukung()">
                            <i class="fa-regular fa-backward"></i>
                        </button>

                    </div>
                    <h2 style="color: #FFFFFF;margin-bottom: 20px;">List Pendukung</h2>
                    <div class="form-group back-btn">
                        <button type="button" onclick="batalkan_pendukung()">
                            <i class="fa-regular fa-backward"></i>
                        </button>

                    </div>
                    <?php if ($result) : ?>
                        <?php foreach ($result as $row) : ?>
                            <div style="border-radius : 10px;" class="card card-large content-search">
                                <span class="nama"><?= $row->nama; ?></span>
                                <span class="alamat"><?= $row->kelurahan; ?>, <?= $row->tps; ?>, RT <?= ifnull($row->rt, '(-)') ?>/ RW <?= ifnull($row->rw, '(-)') ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <img src="<?= base_url('data/default/notfound.svg') ?>" alt="" width="250px">
                        <span class="vector_title">Pendukung Tidak Ditemukan</span>
                        <p class="vector_desk">Penduduk yang anda cari tidak ditemukan! Silahkan cari menggunakan kata kunci lainya atau hubungi admin.</p>
                    <?php endif; ?>


                </div>


                <div style="width:100%;height : 60px;">

                </div>
            </div>
        </div>
    </div>
</div>