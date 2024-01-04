 <script>
     var BASE_URL = '<?= base_url(); ?>';
     var hostUrl = "<?= base_url(); ?>assets/";
 </script>
 <!--begin::Global Javascript Bundle(mandatory for all pages)-->
 <script src="<?= base_url(); ?>assets/plugins/global/plugins.bundle.js"></script>
 <script src="<?= base_url(); ?>assets/js/scripts.bundle.js"></script>
 <!--end::Global Javascript Bundle-->

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