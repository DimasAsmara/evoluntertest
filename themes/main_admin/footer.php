<!--begin::Javascript-->
<script>
    var BASE_URL = '<?= base_url(); ?>';
    var hostUrl = "<?= base_url(); ?>assets/";
    var css_btn_confirm = 'btn btn-primary';
    var css_btn_cancel = 'btn btn-danger';
    addEventListener('keypress', function(e) {
        if (e.keyCode === 13 || e.which === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= base_url(); ?>assets/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url(); ?>assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="<?= base_url(); ?>assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="<?= base_url(); ?>assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<!-- <script src="<?= base_url(); ?>assets/js/custom/widgets.js"></script> -->
<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-campaign.js"></script>
<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/users-search.js"></script>
<script src="<?= base_url(); ?>assets/js/modul/function.js?v=<?= date('YmdHis') ?>"></script>
<script src="<?= base_url(); ?>assets/js/modul/mekanik.js?v=<?= date('YmdHis') ?>"></script>
<!--end::Custom Javascript-->
<?php

if (isset($js_add) && is_array($js_add)) {
    foreach ($js_add as $js) {
        echo $js;
    }
} else {
    echo (isset($js_add) && ($js_add != "") ? $js_add : "");
}

?>
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>