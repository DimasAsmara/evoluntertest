<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
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
        if ($this->id_role == 1) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        redirect('statistik/kelurahan');
    }

    public function kelurahan()
    {
        $mydata = [];

        // DEKLARASI VARIABLE
        $end = $this->input->get('end_date');
        $id_kelurahan = $this->input->get('id_kelurahan');
        if (!$end) {
            $end = date('Y-m-d');
        }

        if ($id_kelurahan != '' && $id_kelurahan != 'all') {
            $wh['kelurahan.id_kelurahan'] = $id_kelurahan;
            $where['penduduk.id_kelurahan'] = $id_kelurahan;
        }
        $str_end = strtotime($end);
        $begin = date('Y-m-d', strtotime('-30 days', $str_end));
        $arr = [];
        $date = [];
        $value = [];
        $label = '';

        // RENDER DATA
        // CEK AKSES RELAWAN
        $domain = [];
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


        // LOAD DATA GLOBAL
        $www['id_intansi'] = $this->id_intansi;
        if ($this->id_role == 1) {
            $www['id_kelurahan'] = $domain;
        }
        $lk = $this->action_m->get_all('kelurahan', $www);
        // LOAD JS
        $this->data['js_add'][] = '<script>
        var page = "statistik/kelurahan";
        var kategori=' . json_encode($date) . ';
        var value_chart = ' . json_encode($value) . ';
        var field =' . json_encode($field) . ';
        var pendukung = ' . json_encode($field_value) . ';
        </script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/dashboard/dashboard.js"></script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/statistik/stc.js"></script>';

        $mydata['kelurahan'] = $lk;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('kelurahan', $mydata, TRUE);
        $this->display();
    }

    public function relawan()
    {
        $mydata = [];

        // DEKLARASI VARIABLE
        $end = $this->input->get('end_date');
        $id_relawan = $this->input->get('id_relawan');
        if (!$end) {
            $end = date('Y-m-d');
        }

        if ($id_relawan != '' && $id_relawan != 'all') {
            $wh['user.id_user'] = $id_relawan;
            $where['penduduk.taken_by'] = $id_relawan;
        }
        $str_end = strtotime($end);
        $begin = date('Y-m-d', strtotime('-30 days', $str_end));
        $arr = [];
        $date = [];
        $value = [];
        $label = '';

        // RENDER DATA
        // CEK AKSES RELAWAN
        $domain = [];
        $wh['user.id_intansi'] = $this->id_intansi;
        $s = '';
        $relawan = $this->action_m->get_all('user', $wh, 'user.nama AS relawan, (SELECT COUNT(*) FROM penduduk WHERE penduduk.status = 2 AND penduduk.taken_by = user.id_user' . $s . ') AS pendukung');

        $field = [];
        $field_value = [];
        if ($relawan) {
            foreach ($relawan as $key) {
                $field[] = $key->relawan;
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


        // LOAD DATA GLOBAL
        $www['id_intansi'] = $this->id_intansi;
        $www['block'] = 'N';
        $lk = $this->action_m->get_all('user', $www);
        // LOAD JS
        $this->data['js_add'][] = '<script>
        var page = "statistik/relawan";
        var kategori=' . json_encode($date) . ';
        var value_chart = ' . json_encode($value) . ';
        var field =' . json_encode($field) . ';
        var pendukung = ' . json_encode($field_value) . ';
        </script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/dashboard/dashboard.js"></script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/statistik/stc.js"></script>';

        $mydata['relawan'] = $lk;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('relawan', $mydata, TRUE);
        $this->display();
    }
}
