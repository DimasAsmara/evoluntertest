<html>

<head>
    <meta charset="utf-8">
    <title>Mobile Valen <?= (isset($title) && $title != '') ? ' | ' . $title : ''; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/logo/short.png" />
    <!--begin::Fonts(mandatory for all pages)-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <link rel="stylesheet" href="<?= base_url('assets/css/mobile.css') ?>">
    <link href="<?= base_url(); ?>assets/css/image_input.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://kit.fontawesome.com/483cf52003.css" crossorigin="anonymous">
    <?php
    if (isset($css_add) && is_array($css_add)) {
        foreach ($css_add as $css) {
            echo $css;
        }
    } else {
        echo (isset($css_add) && ($css_add != "") ? $css_add : "");
    }
    ?>
</head>

<body>