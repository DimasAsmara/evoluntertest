<?php

function alert_show($msg, $type)
{

  $str = "";
  if ($msg != "") {

    $str = '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert" style="        position:fixed; top: 0px; left: 0px; width: 100%; z-index:9999;border-radius:0px;">
    ' . $msg . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  return $str;
}

function sweet_alert($judul = NULL, $text = NULL, $icon = NULL, $image = NULL)
{



  // - success

  // - error

  // - warning

  // - info

  // - Question



  $data = '';

  if ($text != NULL) {

    $data .= '<div class="flash-data" ';

    $data .= 'data-icon="' . $icon . '"';

    $data .= 'data-judul="' . $judul . '"';

    $data .= 'data-message="' . $text . '"';

    $data .= 'data-image="' . $image . '">';

    $data .= '</div>';
  }

  return $data;
}

function alert_question($judul, $text = NULL, $icon = NULL, $image = NULL)
{

  $data = '';

  if ($judul != NULL) {

    $data .= 'data-judul="' . $judul . '"';

    $data .= 'data-message="' . $text . '"';

    $data .= 'data-icon="' . $icon . '"';

    $data .= 'data-image="' . $image . '"';
  }

  return $data;
}
