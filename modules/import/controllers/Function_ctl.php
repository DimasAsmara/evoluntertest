<?php defined('BASEPATH') or exit('No direct script access allowed');


include_once(APPPATH . '../vendor/excelReader/excel_reader2.php');
include_once(APPPATH . '../vendor/excelReader/SpreadsheetReader.php');
class Function_ctl extends MY_Admin
{
    var $id_role = '';
    var $id_user = '';
    var $id_intansi = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_role = $this->session->userdata('vol_id_role');
        $this->id_user = $this->session->userdata('vol_id_user');
        $this->id_intansi = $this->session->userdata('vol_id_intansi');
    }


    public function index()
    {
        echo "HALAMAN TIDAK TERSEDIA";
    }

    public function relawan()
    {
        if (empty($_FILES['data']['tmp_name'])) {
            $data['required'][] = ['req_relawan_data',  'Data tidak boleh kosong !'];
            $arrakses[] = false;
        } else {
            $arrakses[] = true;
        }


        if (!in_array(false, $arrakses)) {
            $penugasan = $this->input->post('penugasan');
            $fileName = $_FILES["data"]["name"];
            $fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
            $newFileName = 'relawan-' . date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;


            $targetDirectory = './data/import/' . $newFileName;
            move_uploaded_file($_FILES['data']['tmp_name'], $targetDirectory);

            error_reporting(0);

            $reader = new SpreadsheetReader($targetDirectory);
            $no = 0;
            $n = 0;
            $num = 0;
            $jmlh = 0;
            $arr = [];
            // DEFAULT PASSWORD (1234%)
            foreach ($reader as $key => $row) {
                $num = $no++;
                if ($num != 0) {
                    if ($row[0] != NULL && $row[1] != NULL && $row[2] != NULL) {
                        $nn = $n++;
                        $arr[$nn]['id_intansi'] = $this->id_intansi;
                        $arr[$nn]['nama'] = $row[0];
                        $arr[$nn]['email'] = $row[1];
                        $arr[$nn]['notelp'] = $row[2];
                        if ($row[3] == '' || $row[3] == null) {
                            $arr[$nn]['password'] = hash_my_password($row[1] . '1234%');
                        } else {
                            $arr[$nn]['password'] = hash_my_password($row[1] . $row[3]);
                        }
                        $arr[$nn]['role'] = 1;
                        $arr[$nn]['create_by'] = $this->id_user;
                    }
                }
            }
            $jmlh = $nn;
            if (($jmlh - 1) < 1) {
                $data['status'] = false;
                $data['alert']['message'] = 'Data relawan yang anda masukan kosong! fungsi import tidak di jalankan';
                echo json_encode($data);
                exit;
            }


            $insert = $this->action_m->insert_batch('user', $arr);

            if ($insert) {
                $tbh = '';
                if ($penugasan) {
                    $last_id = $insert + (($jmlh - 1) - 1);
                    $ps = [];
                    $nu = 0;
                    $pn = count($penugasan);
                    for ($i = $insert; $i <= $last_id; $i++) {
                        for ($a = 0; $a < $pn; $a++) {
                            $nuu = $nu++;
                            $ps[$nuu]['id_user'] = $i;
                            $ps[$nuu]['id_kelurahan'] = $penugasan[$a];
                        }
                    }
                    $panu = $this->action_m->insert_batch('penugasan', $ps);
                    if (!$panu) {
                        $tbh = ' Penugasan gagal di terapkan! cek secara manual';
                    }
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Data relawan telah berhasil di import!' . $tbh;
                $data['redirect'] = base_url('master/relawan');
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Data relawan gagal di import! Periksa jaringan anda atau tunggu beberapa saat. Hubungi admin jika kesalahan berlanjut';
            }
        } else {
            $data['status'] = false;
        }



        echo json_encode($data);
        exit;
    }


    public function penduduk()
    {
        $kelurahan = $this->input->post('kelurahan');
        $tps = $this->input->post('tps');
        if (empty($_FILES['data']['tmp_name'])) {
            $data['required'][] = ['req_penduduk_data',  'Data tidak boleh kosong !'];
            $arrakses[] = false;
        } else {
            $arrakses[] = true;
        }
        if (!$kelurahan) {
            $data['required'][] = ['req_penduduk_kelurahan',  'Kelurahan tidak boleh kosong !'];
            $arrakses[] = false;
        } else {
            $arrakses[] = true;
        }

        if (!$tps) {
            $data['required'][] = ['req_penduduk_tps',  'TPS tidak boleh kosong !'];
            $arrakses[] = false;
        } else {
            $arrakses[] = true;
        }


        if (!in_array(false, $arrakses)) {
            $fileName = $_FILES["data"]["name"];
            $fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
            $newFileName = 'penduduk-' . date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;


            $targetDirectory = './data/import/' . $newFileName;
            move_uploaded_file($_FILES['data']['tmp_name'], $targetDirectory);

            error_reporting(0);

            $reader = new SpreadsheetReader($targetDirectory);
            $no = 0;
            $n = 0;
            $num = 0;
            $jmlh = 0;
            $arr = [];
            // DEFAULT PASSWORD (1234%)
            foreach ($reader as $key => $row) {
                $num = $no++;
                if ($num != 0) {
                    if ($row[0] != NULL && $row[1] != NULL && $row[2] != NULL && $row[3] != NULL && $row[4] != NULL) {
                        $nn = $n++;
                        $arr[$nn]['id_intansi'] = $this->id_intansi;
                        $arr[$nn]['id_kelurahan'] = $kelurahan;
                        $arr[$nn]['id_tps'] = $tps;
                        $arr[$nn]['nama'] = $row[0];
                        $arr[$nn]['email'] = $row[6];
                        $arr[$nn]['notelp'] = $row[5];
                        $arr[$nn]['umur'] = $row[2];
                        $arr[$nn]['gender'] = $row[1];
                        $arr[$nn]['rt'] = $row[3];
                        $arr[$nn]['rw'] = $row[4];
                        $arr[$nn]['alamat'] = $row[7];
                        $arr[$nn]['status'] = 1;
                        $arr[$nn]['create_by'] = $this->id_user;
                    }
                }
            }
            $jmlh = $nn;
            if (($jmlh - 1) < 1) {
                $data['status'] = false;
                $data['alert']['message'] = 'Data yang penduduk anda masukan kosong! fungsi import tidak di jalankan';
                echo json_encode($data);
                exit;
            }


            $insert = $this->action_m->insert_batch('penduduk', $arr);

            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data penduduk telah berhasil di import!';
                $data['redirect'] = base_url('master/penduduk');
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Data penduduk gagal di import! Periksa jaringan anda atau tunggu beberapa saat. Hubungi admin jika kesalahan berlanjut';
            }
        } else {
            $data['status'] = false;
        }



        echo json_encode($data);
        exit;
    }




    public function kelurahan()
    {
        if (empty($_FILES['data']['tmp_name'])) {
            $data['required'][] = ['req_kelurahan_data',  'Data tidak boleh kosong !'];
            $arrakses[] = false;
        } else {
            $arrakses[] = true;
        }


        if (!in_array(false, $arrakses)) {
            $fileName = $_FILES["data"]["name"];
            $fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
            $newFileName = 'kelurahan-' . date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;


            $targetDirectory = './data/import/' . $newFileName;
            move_uploaded_file($_FILES['data']['tmp_name'], $targetDirectory);

            error_reporting(0);

            $reader = new SpreadsheetReader($targetDirectory);
            $no = 0;
            $n = 0;
            $num = 0;
            $jmlh = 0;
            $arr = [];
            $tps = [];
            foreach ($reader as $key => $row) {
                $num = $no++;
                if ($num != 0) {
                    if ($row[0] != NULL && $row[1] != NULL) {
                        $nn = $n++;
                        $arr[$nn]['id_intansi'] = $this->id_intansi;
                        $arr[$nn]['nama'] = $row[0];
                        $arr[$nn]['jumlah_rw'] = $row[2];
                        $arr[$nn]['jumlah_rt'] = $row[3];
                        $arr[$nn]['jumlah_tps'] = $row[1];
                        $tps[] = $row[1];
                    }
                }
            }
            $jmlh = $nn + 1;
            if (($jmlh) < 1) {
                $data['status'] = false;
                $data['alert']['message'] = 'Data kelurahan yang anda masukan kosong! fungsi import tidak di jalankan';
                echo json_encode($data);
                exit;
            }


            $insert = $this->action_m->insert_batch('kelurahan', $arr);

            if ($insert) {
                $tbh = '';
                if (count($tps) > 0) {
                    $last_id = $insert + (($jmlh) - 1);
                    $a = 0;
                    $idd = [];
                    for ($i = $insert; $i <= $last_id; $i++) {
                        $idd[] = $i;
                    }

                    for ($b = 0; $b < count($tps); $b++) {
                        for ($c = 1; $c <= $tps[$b]; $c++) {
                            $aa = $a++;
                            $at[$aa]['id_intansi'] = $this->id_intansi;
                            $at[$aa]['id_kelurahan'] = $idd[$b];
                            $at[$aa]['nama'] = 'TPS ' . $c;
                        }
                    }
                    $t_tps = $this->action_m->insert_batch('tps', $at);
                    if (!$t_tps) {
                        $tbh .= 'TPS Tidak di tambahkan! Tambahkan manual';
                    }
                }


                $data['status'] = true;
                $data['alert']['message'] = 'Data kelurahan telah berhasil di import!' . $tbh;
                $data['redirect'] = base_url('master/wilayah');
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Data kelurahan gagal di import! Periksa jaringan anda atau tunggu beberapa saat. Hubungi admin jika kesalahan berlanjut';
            }
        } else {
            $data['status'] = false;
        }



        echo json_encode($data);
        exit;
    }
}
