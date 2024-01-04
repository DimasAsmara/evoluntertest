<div class="navigation">
    <ul>
        <li onclick="activeLink(this,'home')" data-page="home" class="list list-button <?= (!$active['home']) ? (!$active['input'] && !$active['profil']) ? 'active' : '' : 'active'; ?>">
            <a>
                <span class="icon">
                    <i class="fa-regular fa-house"></i>
                </span>
                <span class="text">Home</span>
                <span class="circle"></span>
            </a>
        </li>
        <li class="list">
        </li>
        <li onclick="activeLink(this,'input')" data-page="input" class="list list-button <?= $active['input']; ?>">
            <a>
                <span class="icon">
                    <i class="fa-solid fa-cloud-plus"></i>
                </span>
                <span class="text">Data</span>
                <span class="circle"></span>
            </a>
        </li>
        <li class="list">
        </li>
        <li onclick="activeLink(this,'profil')" data-page="profil" class="list list-button <?= $active['profil']; ?>">
            <a>
                <span class="icon">
                    <i class="fa-regular fa-user"></i>
                </span>
                <span class="text">Profil</span>
                <span class="circle"></span>
            </a>
        </li>
        <div class="indicator"></div>
    </ul>
</div>
<script>
    var BASE_URL = '<?= base_url(); ?>';
    var hostUrl = "<?= base_url(); ?>assets/";
    var css_btn_confirm = 'btn btn-primary';
    var css_btn_cancel = 'btn btn-danger';
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= base_url(); ?>assets/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url(); ?>assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<script src="<?= base_url('assets/js/modul/mobile/script.js') ?>"></script>
<script src="<?= base_url(); ?>assets/js/modul/function.js?v=<?= date('YmdHis') ?>"></script>
<script src="<?= base_url('assets/js/alert/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/js/alert/scriptalert.js') ?>"></script>
<?php

if (isset($js_add) && is_array($js_add)) {
    foreach ($js_add as $js) {
        echo $js;
    }
} else {
    echo (isset($js_add) && ($js_add != "") ? $js_add : "");
}

?>
</body>

</html>