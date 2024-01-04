<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function parse_raw_http_request(array &$a_data)
{
  // read incoming data
  $input = file_get_contents('php://input');

  // grab multipart boundary from content type header
  preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
  $boundary = $matches[1];

  // split content by boundary and get rid of last -- element
  $a_blocks = preg_split("/-+$boundary/", $input);
  array_pop($a_blocks);

  // loop data blocks
  foreach ($a_blocks as $id => $block) {
    if (empty($block))
      continue;

    // you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char

    // parse uploaded files
    if (strpos($block, 'application/octet-stream') !== FALSE) {
      // match "name", then everything after "stream" (optional) except for prepending newlines 
      preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
    }
    // parse all other fields
    else {
      // match "name" and optional value in between newline sequences
      preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
    }
    $a_data[$matches[1]] = $matches[2];
  }
}

function http_parse_headers($header)
{
  $retVal = array();
  $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));
  foreach ($fields as $field) {
    if (preg_match('/([^:]+): (.+)/m', $field, $match)) {
      $match[1] = preg_replace('/(?<=^|[\x09\x20\x2D])./e', 'strtoupper("\0")', strtolower(trim($match[1])));
      if (isset($retVal[$match[1]])) {
        $retVal[$match[1]] = array($retVal[$match[1]], $match[2]);
      } else {
        $retVal[$match[1]] = trim($match[2]);
      }
    }
  }
  return $retVal;
}

function arrWeekDay($key = "")
{
  $arr = array(
    0 => 'Min',
    1 => 'Sen',
    2 => 'Sel',
    3 => 'Rab',
    4 => 'Kam',
    5 => 'Jum',
    6 => 'Sab'
  );

  if ($key) {
    return $arr[$key];
  } else {
    return $arr;
  }
}

function reformatDate($date, $from_format = 'd/m/Y', $to_format = 'Y-m-d')
{
  $date_aux = date_create_from_format($from_format, $date);
  return date_format($date_aux, $to_format);
}


function short_text($text, $batas = 5, $pengganti = '...', $link = '')
{
  if (strlen($text) > $batas) {
    $data = substr($text, 0, $batas) . $pengganti;
  } else {
    $data = $text;
  }

  return $data;
}

function search_encode($text, $encode = '--')
{
  if (preg_match("/$encode/i", $text)) {
    $data = str_replace($encode, " ", $text);
  } else {
    $data = $text;
  }

  return $data;
}

function gender_encode($gender = '')
{
  $data['L'] = 'Laki-laki';
  $data['P'] = 'Perempuan';
  if (isset($data[$gender])) {
    return $data[$gender];
  } else {
    return '';
  }
}
function setmenuactive($current_url, $class)
{
  if ($current_url == $class) {
    return "active";
  } else {
    if ($current_url == $class . "/index") {
      return "active";
    }
    return "";
  }
}

function set_menu_active($controller, $arrtarget = array(), $class = 'active', $exc = '')
{
  if ($controller) {
    if (in_array($controller, $arrtarget)) {
      return $class;
    } else {
      return $exc;
    }
  } else {
    return $exc;
  }
}
function initials($nama, $jmlh = 1)
{
  $words = explode(" ", $nama);
  $initials = null;
  $no = 1;
  foreach ($words as $w) {
    $num = $no++;
    $initials .= $w[0];
    if ($num == $jmlh) {
      break;
    }
  }
  return strtoupper($initials);
}
function set_submenu_active($controller, $arrtarget = array(), $c2, $arrtarget2 = array(), $class = 'active', $exc = '')
{
  if ($controller) {
    if (in_array($controller, $arrtarget)) {
      if ($c2) {
        if (in_array($c2, $arrtarget2)) {
          return $class;
        } else {
          return $exc;
        }
      } else {
        return $exc;
      }
    } else {
      return $exc;
    }
  } else {
    return $exc;
  }
}


function encrypt_path($filename)
{

  /**
   * Make sure the downloads are *not* in a publically accessible path, otherwise, people
   * are still able to download the files directly.
   */
  //$filename = '/the/path/to/your/files/' . basename( $_GET['filename'] );

  /**
   * You can do a check here, to see if the user is logged in, for example, or if 
   * the current IP address has already downloaded it, the possibilities are endless.
   */


  if (file_exists($filename)) {
    /** 
     * Send some headers indicating the filetype, and it's size. This works for PHP >= 5.3.
     * If you're using PHP < 5.3, you might want to consider installing the Fileinfo PECL
     * extension.
     */
    $finfo = finfo_open(FILEINFO_MIME);
    header('Content-Disposition: attachment; filename= ' . basename($filename));
    header('Content-Type: ' . finfo_file($finfo, $filename));
    header('Content-Length: ' . filesize($filename));
    header('Expires: 0');
    finfo_close($finfo);

    /**
     * Now clear the buffer, read the file and output it to the browser.
     */
    ob_clean();
    flush();
    readfile($filename);
    exit;
  }

  header('HTTP/1.1 404 Not Found');

  echo "<h1>File not found</h1>";
  exit;
}

function setencrypt($string)
{
  $stringenc = base64_encode($string);
  $stringenc = str_replace("=", "", $stringenc);
  return $stringenc;
}
function base64url_encode($data)
{
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
function base64url_decode($data)
{
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}


function get_range_date($date1, $date2)
{

  $arr = array();
  $date2 = date('Y-m-d', strtotime($date2 . "+1 DAYS"));
  $begin = new DateTime($date1);
  $end = new DateTime($date2);

  if ($date1 == $date2) {
    $arr[] = $date1;
  } else {
    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);
    foreach ($period as $dt) {
      $arr[] = $dt->format('Y-m-d');
    }
  }
  return $arr;
}

function cek_email($email = '')
{
  $dicari = '@';
  if ($email != '') {
    if (preg_match("/$dicari/i", $email)) {
      $s = explode('@', $email);
      if ($s[1] == 'gmail.com') {
        $result = true;
      } else {
        $result = false;
      }
    } else {
      $result = false;
    }
  } else {
    $result = false;
  }

  return $result;
}

function bytes($bytes, $force_unit = NULL, $format = NULL, $si = TRUE)
{
  // Format string
  $format = ($format === NULL) ? '%01.2f %s' : (string) $format;

  // IEC prefixes (binary)
  if ($si == FALSE or strpos($force_unit, 'i') !== FALSE) {
    $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
    $mod   = 1024;
  }
  // SI prefixes (decimal)
  else {
    $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB');
    $mod   = 1000;
  }

  // Determine unit to use
  if (($power = array_search((string) $force_unit, $units)) === FALSE) {
    $power = ($bytes > 0) ? floor(log($bytes, $mod)) : 0;
  }

  return sprintf($format, $bytes / pow($mod, $power), $units[$power]);
}

function reverse_date($date)
{
  list($y, $m, $d) = explode("-", $date);
  $newdate = $d . "-" . $m . "-" . $y;
  return $newdate;
}

function reverse_fulldate($date)
{
  list($date, $time) = explode(" ", $date);
  $newdate = reverse_date($date);
  return $newdate . " " . $time;
}

function getNamaHari($number)
{
  $arrHari = array('0' => 'Minggu', '1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu');
  return $arrHari[$number];
}

function rupiah($angka, $format = "Rp. ")
{
  $hasil_rupiah = "$format" . number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}
function ifnull($value = NULL, $ganti = NULL)
{
  if (isset($value) == NULL) {
    if ($ganti != NULL) {
      $data = $ganti;
    } else {
      $data = 0;
    }
  } else {
    $data = $value;
  }

  return $data;
}


function obj_to_array($d)
{
  if (is_object($d)) {
    // Gets the properties of the given object
    // with get_object_vars function
    $d = get_object_vars($d);
  }
  if (is_array($d)) {
    /*
      * Return array converted to object
      * Using __FUNCTION__ (Magic constant)
      * for recursive call
      */
    return array_map(__FUNCTION__, $d);
  } else {
    // Return array
    return $d;
  }
}


function mydate($date, $format)
{
  if ($format == 1) {
    $dt = date_create($date);
    $tanggal = date('Y-m-d', $dt);
    $jam = date('H:i:s', $dt);
    $date_format = $tanggal . 'T' . $jam;
  } else {
    $dt = date_create($date);
    $date_format = date_format($dt, $format);
  }
  return $date_format;
}


function hash_my_password($pass)
{
  $data = hash('sha256', $pass);
  return $data;
}

function validasi_email($email)
{
  $r = true;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $r = false;
  }

  return $r;
}


function get_role($role = 0)
{
  $arr[0] = 'role tidak di ketahui';
  $arr[1] = 'relawan';
  $arr[2] = 'admin';
  $arr[3] = 'superadmin';

  return $arr[$role];
}
function price_format($harga, $format = 1)
{
  if ($format == 1) {
    $data = 'Rp. ' . number_format($harga, 0, ",", ".");
  } else {
    $data = '';
  }

  return $data;
}
function image_check($image = null, $path = null, $rename = NULL)
{
  if ($path == null) {
    $path = 'error';
  }
  if ($rename != NULL) {
    $pt = $rename;
  } else {
    $pt = $path;
  }
  if ($image == null) {
    $file = 'gaada';

    $file = 'default/' . $pt . '.jpg';
  } else {
    if (file_exists(base_data() . $path . '/' . $image)) {
      $file = $path . '/' . $image;
    } else {
      $file = 'default/' . $pt . '.jpg';
      // $file = 'gaada';
    }
  }

  return base_url('data/' . $file);
}

function base_data($path = null)
{
  $p = APPPATH . '../data/';
  if ($path == null) {
    return $p;
  } else {
    return $p . $path;
  }
}


function simple_number($number = '100')
{
  $jmlh = strlen($number);
  $ext = '';
  $value = $number;
  if ($jmlh >= 4 && $jmlh <= 6) {
    if ($jmlh == 4) {
      $value = substr($number, 0, 1);
    } elseif ($jmlh == 5) {
      $value = substr($number, 0, 2);
    } else {
      $value = substr($number, 0, 3);
    }
    $ext = 'K';
  } elseif ($jmlh > 6 && $jmlh <= 9) {
    if ($jmlh == 7) {
      $value = substr($number, 0, 1);
    } elseif ($jmlh == 8) {
      $value = substr($number, 0, 2);
    } else {
      $value = substr($number, 0, 3);
    }
    $ext = 'JT';
  } elseif ($jmlh > 9 && $jmlh <= 12) {
    if ($jmlh == 10) {
      $value = substr($number, 0, 1);
    } elseif ($jmlh == 11) {
      $value = substr($number, 0, 2);
    } else {
      $value = substr($number, 0, 3);
    }
  } elseif ($jmlh > 12) {
    if ($jmlh == 13) {
      $value = substr($number, 0, 1);
    } elseif ($jmlh == 14) {
      $value = substr($number, 0, 2);
    } else {
      $value = substr($number, 0, 3);
    }
    $ext = 'T';
  }

  return $value . $ext;
}


function selisih_tanggal($tgl1 = '2023-03-13', $tgl2 = '2023-03-20')
{
  $tgl1 = strtotime($tgl1);
  $tgl2 = strtotime($tgl2);

  if ($tgl2 > $tgl1) {
    $jarak = $tgl2 - $tgl1;
  } else {
    $jarak = $tgl1 - $tgl2;
  }

  $jarak = $tgl2 - $tgl1;
  $hari = $jarak / 60 / 60 / 24;
  return $hari;
}
