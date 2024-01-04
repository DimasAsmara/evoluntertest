<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
{
    var $id_intansi = '';
    var $id_role = '';
    var $id_user = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_intansi = $this->session->userdata('vol_id_intansi');
        $this->id_role = $this->session->userdata('vol_id_role');
        $this->id_user = $this->session->userdata('vol_id_user');
        if ($this->id_role == 1) {
            redirect('master/penduduk');
        }
    }

    public function index()
    {
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
        $we['id_intansi'] = $this->id_intansi;
        $we['block'] = 'N';
        $we['role'] = 1;
        $p['arrorderby']['kolom'] = 'pendukung';
        $p['arrorderby']['order'] = 'DESC';
        $limit = 5;
        $offset = $this->uri->segment(2);
        $jumlah = count($this->action_m->get_all('user', $we));
        $p['limit'] = $limit;
        if ($offset) {
            $p['offset'] = $offset;
        }

        $poin = $this->action_m->get_where_params('user', $we, 'user.id_user,user.foto,user.nama,user.email,(SELECT COUNT(*) FROM penduduk WHERE penduduk.taken_by = user.id_user) AS pendukung', $p);
        load_pagination('dashboard', $limit, $jumlah, 0);

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


        // LOAD JS
        $this->data['js_add'][] = '<script>
        var page = "dashboard";
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
        $mydata['relawan'] = $relawan;
        $mydata['poin'] = $poin;
        $mydata['offset'] = ($offset) ? $offset + 1 : 1;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }
}
