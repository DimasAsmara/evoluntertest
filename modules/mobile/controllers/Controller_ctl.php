<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Mobile
{
    var $id_intansi = '';
    var $id_user = '';
    var $id_role = '';
    var $email = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_intansi = $this->session->userdata('vol_id_intansi');
        $this->id_user = $this->session->userdata('vol_id_user');
        $this->id_role = $this->session->userdata('vol_id_role');
        $this->email = $this->session->userdata('vol_email');
    }

    public function index($par = '')
    {
        if ($par != '') {
            $page = $par;
        } else {
            $page = $this->input->get('page');
        }

        $home = '';
        $input = '';
        $profil = '';
        if ($page || $page != '' || in_array($page, ['home', 'input', 'profil', 'ubah_sandi'])) {
            if ($page == 'home') {
                $home = 'active';
            } elseif ($page == 'input') {
                $input = 'active';
            } elseif ($page == 'profil') {
                $profil = 'active';
            } elseif ($page == 'ubah_sandi') {
                $ubah_sandi = 'active';
            } else if ($page == 'data_pendukung') {
                $data_pendukung = 'active';
            }
        }
        // DEKLARASI VARIABLE
        $end = date('Y-m-d');
        $str_end = strtotime(date('Y-m-d'));
        $begin = date('Y-m-d', strtotime('-6 days', $str_end));
        $arr = [];
        $date = [];
        $value = [];
        $label = '';

        // RENDER DATA
        // CEK AKSES RELAWAN
        $domain = [];
        if ($this->id_role == 2) {
            $penduduk = $this->action_m->get_all('penduduk', ['id_intansi' => $this->id_intansi], 'COUNT(*) AS total,(SELECT COUNT(*) FROM penduduk WHERE id_intansi = ' . $this->id_intansi . ' AND status = 2) AS pendukung');
            $relawan = $this->action_m->get_all('user', ['id_intansi' => $this->id_intansi, 'role' => 1], 'COUNT(*) AS jmlh')[0]->jmlh;
        } else {
            $relawan = 0;
            $cek_domain = $this->action_m->get_all('penugasan', ['id_user' => $this->id_user]);
            if ($cek_domain) {
                foreach ($cek_domain as $val) {
                    $domain[] = $val->id_kelurahan;
                }
            } else {
                $domain[] = 0;
            }
            $penduduk = $this->action_m->get_all('penduduk', ['id_intansi' => $this->id_intansi, 'id_kelurahan' => $domain], 'COUNT(*) AS total,(SELECT COUNT(*) FROM penduduk WHERE id_intansi = ' . $this->id_intansi . ' AND status = 2 AND taken_by = ' . $this->id_user . ') AS pendukung');
        }
        $wh['kelurahan.id_intansi'] = $this->id_intansi;
        $s = '';
        if ($this->id_role == 1) {
            $wh['kelurahan.id_kelurahan'] = $domain;
            $s = ' AND penduduk.taken_by = ' . $this->id_user;
        }
        $kelurahan = $this->action_m->get_all('kelurahan', $wh, 'kelurahan.nama AS kelurahan, (SELECT COUNT(*) FROM penduduk WHERE penduduk.status = 2 AND penduduk.id_kelurahan = kelurahan.id_kelurahan' . $s . ') AS pendukung');

        $field = [];
        $field_value = [];
        if ($kelurahan) {
            foreach ($kelurahan as $key) {
                $field[] = $key->kelurahan;
                $field_value[] = $key->pendukung;
            }
        }

        $where['DATE(taken_date) >='] = $begin;
        $where['DATE(taken_date) <='] = $end;
        $where['penduduk.id_intansi'] = $this->id_intansi;
        if ($this->id_role == 1) {
            $where['penduduk.id_kelurahan'] = $domain;
        }
        $select = 'DATE(taken_date) AS tanggal, COUNT(*) AS jumlah';
        $param['groupby'] = 'DATE(taken_date)';
        $param['arrorderby']['kolom'] = 'taken_date';
        $param['arrorderby']['order'] = 'ASC';
        $stc = $this->action_m->get_where_params('penduduk', $where, $select, $param);
        if ($stc) {
            foreach ($stc as $key) {
                $arr[$key->tanggal] = $key->jumlah;
            }
        }
        $a = new DateTime($begin);
        $z = new DateTime(date('Y-m-d', strtotime('+1 days', $str_end)));

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($a, $interval, $z);

        foreach ($period as $dt) {
            $date[] = $dt->format("d M");
            if (isset($arr[$dt->format("Y-m-d")])) {
                $value[] = $arr[$dt->format("Y-m-d")];
            } else {
                $value[] = 0;
            }
        }


        $pendukung = ($penduduk) ? $penduduk[0]->pendukung : 0;
        $total = ($penduduk) ? $penduduk[0]->total : 0;
        if ($pendukung) {
            $persen = round(($pendukung / $total) * 100, 1);
        } else {
            $persen = 0;
        }
        if ($pendukung > 99999999) {
            $label .= number_format($pendukung, 0, ',', '.');
        } else {
            $label .= number_format($pendukung, 0, ',', '.') . ' Pendukung';
        }

        // LOAD DATA GLOBAL
        if ($this->id_role == 1) {
            $wh['id_kelurahan'] = $domain;
        }

        $where22['penduduk.id_intansi'] = $this->id_intansi;
        $where22['penduduk.status'] = 2;
        $where22['penduduk.taken_by'] = $this->id_user;
        $params22['arrjoin']['tps']['statement'] = 'penduduk.id_tps = tps.id_tps';
        $params22['arrjoin']['tps']['type'] = 'LEFT';
        $params22['arrjoin']['kelurahan']['statement'] = 'penduduk.id_kelurahan = kelurahan.id_kelurahan';
        $params22['arrjoin']['kelurahan']['type'] = 'LEFT';
        $result = $this->action_m->get_where_params('penduduk', $where22, 'penduduk.*,tps.nama AS tps,kelurahan.nama AS kelurahan', $params22);
        $lk = $this->action_m->get_all('kelurahan', $wh);
        // LOAD JS
        $this->data['js_add'][] = '<script>
        var page = "mobile";
        var label_pendukung = "' . $label . '";
        var persentase_pendukung = "' . $persen . '";
        var kategori=' . json_encode($date) . ';
        var value_chart = ' . json_encode($value) . ';
        var field =' . json_encode($field) . ';
        var pendukung = ' . json_encode($field_value) . ';
        </script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/dashboard/dashboard.js"></script>';

        // RENDER MYDATA

        $mydata['penduduk'] = $total;
        $mydata['jumlah_pendukung'] = $label;
        $mydata['jumlah_kelurahan'] = count($kelurahan);
        $mydata['relawan'] = $relawan;
        $mydata['active']['home'] = $home;
        $mydata['active']['input'] = $input;
        $mydata['active']['profil'] = $profil;
        $mydata['active']['ubah_sandi'] = $ubah_sandi;
        $mydata['active']['data_pendukung'] = $data_pendukung;
        $mydata['list_kelurahan'] = $lk;
        $mydata['result'] = $result;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }

    public function cari_penduduk()
    {
        $kelurahan = $this->input->post('kelurahan');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $nama = $this->input->post('nama');
        $tps = $this->input->post('tps');
        $where = [];

        if (!$kelurahan && $kelurahan == '') {
            echo "KELURAHAN TIDAK BOLEH KOSONG";
            exit;
        } else {
            $where['penduduk.id_kelurahan'] = $kelurahan;
        }

        if (!$nama && $nama == '') {
            echo "NAMA TIDAK BOLEH KOSONG";
            exit;
        } else {
            $params['columnsearch'][] = 'penduduk.nama';
            $params['search'] = $nama;
        }

        if ($tps != '' && $tps != 'all') {
            $where['penduduk.id_tps'] = $tps;
        }

        if ($rt != '' && $rt != 'all') {
            $where['penduduk.rt'] = $rt;
        }
        if ($rw != '' && $rw != 'all') {
            $where['penduduk.rw'] = $rw;
        }

        $where['penduduk.id_intansi'] = $this->id_intansi;
        $params['arrjoin']['tps']['statement'] = 'penduduk.id_tps = tps.id_tps';
        $params['arrjoin']['tps']['type'] = 'LEFT';
        $params['arrjoin']['kelurahan']['statement'] = 'penduduk.id_kelurahan = kelurahan.id_kelurahan';
        $params['arrjoin']['kelurahan']['type'] = 'LEFT';
        $result = $this->action_m->get_where_params('penduduk', $where, 'penduduk.*,tps.nama AS tps,kelurahan.nama AS kelurahan', $params);
        $data['status'] = true;
        $mydata['result'] = $result;
        $this->load->view('list_penduduk', $mydata);
    }

    public function edit_foto()
    {

        if (empty($_FILES['foto_profil']['tmp_name'])) {
            $data['status'] = false;
            $data['alert']['message'] = 'Foto profil tidak boleh kosong!';
            echo json_encode($data);
            exit;
        }

        if (!empty($_FILES['foto_profil']['tmp_name'])) {
            $result = $this->action_m->get_single('user', ['id_user' => $this->id_user]);
            if (!file_exists('/data/')) {
                mkdir('/data/');
            }
            if (!file_exists('../data/user/')) {
                mkdir('/data/user/');
            }
            $foto_profil = $_FILES['foto_profil'];
            $ext = explode('/', $foto_profil['type']);
            if (!in_array($ext[count($ext) - 1], ['png', 'jpg', 'jpeg'])) {
                $data['status'] = false;
                $data['alert']['message'] = 'Tipe file foto pendukung tidak di dukung!' . $ext[count($ext) - 1];
                echo json_encode($data);
                exit;
            }
            $tujuan = './data/user/';
            $config['upload_path'] = $tujuan;
            $config['file_name'] = uniqid();
            $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
            $config['file_ext_tolower'] = true;

            $this->load->library('upload', $config);

            $user_foto = [];

            if (!$this->upload->do_upload('foto_profil')) {

                $error = $this->upload->display_errors();
                $data['status'] = false;
                $data['alert']['message'] = $error;
                echo json_encode($data);
                exit;
            } else {
                $user_foto = array('upload_data' => $this->upload->data());
                $post['foto_profil'] = $user_foto['upload_data']['file_name'];
                if ($result->foto != '') {
                    unlink('./data/user/' . $result->foto);
                }

                $arrAccess[] = true;
            }

            $update = $this->action_m->update('user', ['foto' => $user_foto['upload_data']['file_name']], ['id_user' => $this->id_user]);
            if ($update) {
                $arrSession['vol_foto'] = $user_foto['upload_data']['file_name'];
                $this->session->set_userdata($arrSession);
                $data['status'] = true;
                $data['alert']['message'] = 'Foto berhasil di perbarui';
                echo json_encode($data);
                exit;
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Foto gagal di perbarui! Coba lagi nanti atau hubungi admin';
                echo json_encode($data);
                exit;
            }
        } else {
            $data['status'] = false;
            $data['alert']['message'] = 'Foto profil tidak boleh kosong!';
            echo json_encode($data);
            exit;
        }
    }

    public function get_tps($semua = 'Y')
    {
        $id = $this->input->post('id_kelurahan');

        $result = $this->action_m->get_all('tps', ['id_kelurahan' => $id]);
        $opt = '';
        if ($result) {
            if ($semua == 'Y') {
                $opt .= '<option value="all">Semua</option>';
            }

            foreach ($result as $row) {
                $opt .= '<option value="' . $row->id_tps . '">' . $row->nama . '</option>';
            }
        } else {
            $opt = '<option value="">Pilih kelurahan terlebih dahulu</option>';
        }
        $data['option'] = $opt;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }


    public function tambah_pendukung()
    {
        // VARIABEL
        $arrVar['id_penduduk']                 = 'ID Penduduk';
        $arrVar['nama2']                 = 'Nama';
        $arrVar['nik']                  = 'NIK';
        $arrVar['gender']               = 'Gender';
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if ($var == 'nama2') {
                    $post['nama'] = trim($$var);
                } else {
                    $post[$var] = trim($$var);
                }

                $arrAccess[] = true;
            }
        }

        $nama_foto_pendukung = $this->input->post('nama_foto_pendukung');
        $nama_foto_ktp = $this->input->post('nama_foto_ktp');
        $cek_penduduk = $this->action_m->get_single('penduduk', ['id_intansi' => $this->id_intansi, 'id_penduduk' => $id_penduduk]);

        if (!$cek_penduduk) {
            $data['status'] = false;
            $data['alert']['message'] = 'Penduduk tidak terdaftar!';
            echo json_encode($data);
            exit;
        }
        if ($nik != $cek_penduduk->nik) {
            $cek_nik = $this->action_m->get_single('penduduk', ['id_intansi' => $this->id_intansi, 'nik' => $nik]);
            if ($cek_nik) {
                $data['status'] = false;
                $data['alert']['message'] = 'NIK Sudah terdaftar sebagai pendukung! Cek kembali NIK yang anda masukan';
                echo json_encode($data);
                exit;
            }
        }
        if (empty($_FILES['foto_pendukung']['tmp_name'])) {
            if (!$nama_foto_pendukung) {
                $data['status'] = false;
                $data['alert']['message'] = 'Foto pendukung tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }
        }

        if (empty($_FILES['foto_ktp']['tmp_name'])) {
            if (!$nama_foto_ktp) {
                $data['status'] = false;
                $data['alert']['message'] = 'Foto KTP tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }
        }
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['foto_pendukung']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/penduduk/')) {
                    mkdir('/data/penduduk/');
                }
                $foto_pendukung = $_FILES['foto_pendukung'];
                $ext = explode('/', $foto_pendukung['type']);
                if (!in_array($ext[count($ext) - 1], ['png', 'jpg', 'jpeg'])) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Tipe file foto pendukung tidak di dukung!' . $ext[count($ext) - 1];
                    echo json_encode($data);
                    exit;
                }
                $tujuan = './data/penduduk/';
                $config['upload_path'] = $tujuan;
                $config['file_name'] = uniqid();
                $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_penduduk = [];

                if (!$this->upload->do_upload('foto_pendukung')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_penduduk = array('upload_data' => $this->upload->data());
                    $post['foto_pendukung'] = $data_penduduk['upload_data']['file_name'];
                    $arrAccess[] = true;
                }
            }
            if (!empty($_FILES['foto_ktp']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/env/')) {
                    mkdir('/data/env/');
                }
                $foto_ktp = $_FILES['foto_ktp'];
                $ext = explode('/', $foto_ktp['type']);
                if (!in_array($ext[count($ext) - 1], ['png', 'jpg', 'jpeg'])) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Tipe file foto KTP tidak di dukung!';
                    echo json_encode($data);
                    exit;
                }
                $tujuan_ktp = './data/env/';
                $config['upload_path'] = $tujuan_ktp;
                $config['file_name'] = uniqid();
                $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG|JPEG';
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_ktp = [];

                if (!$this->upload->do_upload('foto_ktp')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_ktp = array('upload_data' => $this->upload->data());
                    $post['foto_ktp'] = $data_ktp['upload_data']['file_name'];
                }
            }
            $post['status'] = 2;
            $post['taken_by'] = $this->id_user;
            $post['taken_date'] = date('Y-m-d H:i:s');

            $update = $this->action_m->update('penduduk', $post, ['id_penduduk' => $id_penduduk]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Penduduk berhasil di dijadiakan pendukung!';
                $data['reload'] = true;
                // $data['page_input'] = true;
                // $data['input']['all'] = true;
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Gagal dijadikan pendukung!';
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_kata_sandi()
    {
        // VARIABEL
        $arrVar['password']                 = 'ID Penduduk';
        $arrVar['re_password']                 = 'Nama';
        $arrVar['new_password']                  = 'NIK';
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var, ['re_password', 'new_password'])) {
                    $post[$var] = trim($$var);
                }
                $arrAccess[] = true;
            }
        }



        if (!in_array(FALSE, $arrAccess)) {
            $cek_pass = hash_my_password($this->email . $password);
            $res = $this->action_m->get_single('user', ['id_user' => $this->id_user]);
            if ($cek_pass != $res->password) {
                $data['status'] = false;
                $data['alert']['message'] = 'Kata sandi anda salah!';
                echo json_encode($data);
                exit;
            }

            if ($new_password != $re_password) {
                $data['status'] = false;
                $data['alert']['message'] = 'Konfirmasi kata sandi salah!';
                echo json_encode($data);
                exit;
            }

            $new = hash_my_password($this->email . $new_password);
            $update = $this->action_m->update('user', ['password' => $new], ['id_user' => $this->id_user]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Berhasil merubah kata sandi!';
                $data['input']['all'] = true;
                $data['ubah_sandi'] = 1;
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Gagal merubah kata sandi! Coba lagi nanti atau laporkan pada admin';
            }
        } else {
            $data['status'] = false;
        }

        echo json_encode($data);
        exit;
    }
}
