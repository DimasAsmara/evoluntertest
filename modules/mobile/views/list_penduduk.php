<div style="display : flex; justify-content : flex-start;align-items:center;width : 100%;min-height : 100vh;flex-direction : column;padding : 0px;margin : 0px">

    <?php if ($result) : ?>
        <?php foreach ($result as $row) : ?>
            <?php if ($row->status == 2) : ?>
                <div style="border-radius : 10px;" class="card card-large content-search disabled">
                <?php else : ?>
                    <a onclick="addPendukung(<?= $row->id_penduduk ?>,'<?= $row->nama ?>','<?= $row->nik; ?>','<?= $row->gender; ?>')" style="border-radius : 10px;" class="card card-large content-search">
                    <?php endif; ?>
                    <?php if ($row->status == 2) : ?>
                        <span class="label disabled">Sudah Diinput</span>
                    <?php endif; ?>
                    <span class="nama"><?= $row->nama; ?></span>
                    <span class="alamat"><?= $row->kelurahan; ?>, <?= $row->tps; ?>, RT <?= ifnull($row->rt, '(-)') ?>/ RW <?= ifnull($row->rw, '(-)') ?></span>
                    <?php if ($row->status == 2) : ?>
                </div>
            <?php else : ?>
                </a>
            <?php endif; ?>

        <?php endforeach; ?>
    <?php else : ?>
        <img src="<?= base_url('data/default/notfound.svg') ?>" alt="" width="250px">
        <span class="vector_title">Penduduk Tidak Ditemukan</span>
        <p class="vector_desk">Penduduk yang anda cari tidak ditemukan! Silahkan cari menggunakan kata kunci lainya atau hubungi admin.</p>
    <?php endif; ?>


</div>