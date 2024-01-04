
<?php include_once("header.php"); ?>
<?php

echo alert_show($this->session->flashdata('judul'), $this->session->flashdata('message'), $this->session->flashdata('icon'), $this->session->flashdata('image'));

?>

<?php echo $content; ?>
<?php include_once("footer.php"); ?>
