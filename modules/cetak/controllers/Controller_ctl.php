<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
{
    var $id_intansi = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        if ($this->session->userdata('vol_id_role') == 1) {
            redirect('dashboard');
        }
        $this->id_intansi = $this->session->userdata('vol_id_intansi');
    }
    public function index()
    {
        echo "PRIVATE PAGE";
    }
    public function excel($page = NULL)
    {
        if ($page) {
            $data = [];
            if ($page == 'relawan') {
                $data = $this->_func_relawan($this->input->get());
            } elseif ($page == 'wilayah') {
                $data = $this->_func_wilayah($this->input->get());
            } elseif ($page == 'penduduk') {
                $data = $this->_func_penduduk($this->input->get());
            } elseif ($page == 'pendukung') {
                $data = $this->_func_pendukung($this->input->get());
            }
            $data['result'] = $data;
            $this->load->view($page, $data);
        } else {
            echo "HALAMAN CETAK BELUM SIAP";
        }
    }

    // FUNGSI
    private function _func_relawan($get)
    {
        if ($get) {
            foreach ($get as $field => $value) {
                $$field = $value;
            }
        }
        $tugas = $penugasan;
        $params = [];
        $paramsuser = [];
        if (isset($status) && $status != 'all') {
            if (in_array($status, ['Y', 'N'])) {
                $where['block'] = $status;
            }
        }
        if (isset($search)) {
            $search = search_encode($search);
            $paramsuser['columnsearch'][] = 'nama';
            $paramsuser['columnsearch'][] = 'email';
            $paramsuser['columnsearch'][] = 'notelp';
            $paramsuser['search'] = $search;
        }
        $where['user.role'] = 1;
        $where['user.id_intansi'] = $this->id_intansi;



        if (isset($tugas) != NULL && $tugas != 'all') {
            $where['penugasan.id_kelurahan'] = $tugas;
            $paramsuser['arrjoin']['user']['statement'] = 'penugasan.id_user = user.id_user';
            $paramsuser['arrjoin']['user']['type'] = 'LEFT';
            $user = $this->action_m->get_where_params('penugasan', $where, 'penugasan.id_user, penugasan.id_kelurahan, user.*', $paramsuser);
        } else {
            $user = $this->action_m->get_where_params('user', $where, '*', $paramsuser);
        }

        $params['arrjoin']['kelurahan']['statement'] = 'penugasan.id_kelurahan = kelurahan.id_kelurahan';
        $params['arrjoin']['kelurahan']['type'] = 'LEFT';
        $penugasan = $this->action_m->get_where_params('penugasan', [], 'penugasan.id_user, penugasan.id_kelurahan, kelurahan.nama', $params);

        if ($user) {
            $nu = 0;
            foreach ($user as $row) {
                $nuu = $nu++;
                $result[$nuu]['id_user'] = $row->id_user;
                $result[$nuu]['nama'] = $row->nama;
                $result[$nuu]['email'] = $row->email;
                $result[$nuu]['notelp'] = $row->notelp;
                $result[$nuu]['foto'] = $row->foto;
                $result[$nuu]['block'] = $row->block;
                $result[$nuu]['penugasan'] = [];
                if ($penugasan) {
                    $no = 0;
                    foreach ($penugasan as $p) {
                        if ($p->id_user == $row->id_user) {
                            $num = $no++;
                            $result[$nuu]['penugasan'][$num]['id_kelurahan'] = $p->id_kelurahan;
                            $result[$nuu]['penugasan'][$num]['kelurahan'] = $p->nama;
                        }
                    }
                }
            }
        } else {
            $result = null;
        }

        return $result;
    }

    private function _func_wilayah($get)
    {
        if ($get) {
            foreach ($get as $field => $value) {
                $$field = $value;
            }
        }
        $param = [];
        if (isset($search)) {
            $search = search_encode($search);
            $param['columnsearch'][] = 'nama';
            $param['search'] = $search;
        }
        $wilayah = $this->action_m->get_where_params('kelurahan', ['id_intansi' => $this->id_intansi], 'kelurahan.*,(SELECT COUNT(*) AS cnt FROM penduduk WHERE penduduk.id_kelurahan = kelurahan.id_kelurahan) AS jumlah_penduduk, (SELECT COUNT(*) AS cnt_tps FROM tps WHERE tps.id_kelurahan = kelurahan.id_kelurahan) AS jumlah_tps', $param);
        $params['arrjoin']['user']['statement'] = 'penugasan.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $relawan = $this->action_m->get_where_params('penugasan', ['user.id_intansi' => $this->id_intansi, 'user.block' => 'N'], 'penugasan.id_user,penugasan.id_kelurahan, user.nama', $params);
        if ($wilayah) {
            $nu = 0;
            foreach ($wilayah as $row) {
                $nuu = $nu++;
                $result[$nuu]['id_kelurahan'] = $row->id_kelurahan;
                $result[$nuu]['nama'] = $row->nama;
                $result[$nuu]['jumlah_tps'] = $row->jumlah_tps;
                $result[$nuu]['jumlah_penduduk'] = $row->jumlah_penduduk;
                $result[$nuu]['relawan'] = [];
                if ($relawan) {
                    $no = 0;
                    foreach ($relawan as $p) {
                        if ($p->id_kelurahan == $row->id_kelurahan) {
                            $num = $no++;
                            $result[$nuu]['relawan'][$num]['id_user'] = $p->id_user;
                            $result[$nuu]['relawan'][$num]['relawan'] = $p->nama;
                        }
                    }
                }
            }
        } else {
            $result = null;
        }

        return $result;
    }

    private function _func_penduduk($get)
    {
        if ($get) {
            foreach ($get as $field => $value) {
                $$field = $value;
            }
        }

        $where['penduduk.id_intansi'] = $this->id_intansi;
        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $paramspenduduk = [];
        if (isset($status) && $status != '' && $status != 'all') {
            if (in_array($status, [1, 2])) {
                $where['penduduk.status'] = $status;
            }
        }
        if (isset($data) && $data != '' && $data != 'all') {
            if (in_array($data, ['Y', 'N'])) {
                $where['penduduk.new_data'] = $data;
            }
        }
        if (isset($id_kelurahan) && $id_kelurahan != '' && $id_kelurahan != 'all') {
            $where['penduduk.id_kelurahan'] = $id_kelurahan;
        }
        if (isset($id_tps) && $id_tps != 'all') {
            $where['penduduk.id_tps'] = $id_tps;
        }
        if (isset($search) && $search != '') {
            $search = search_encode($search);
            $paramspenduduk['columnsearch'][] = 'penduduk.nama';
            $paramspenduduk['columnsearch'][] = 'nik';
            $paramspenduduk['columnsearch'][] = 'notelp';
            $paramspenduduk['columnsearch'][] = 'email';
            $paramspenduduk['search'] = $search;
        }

        if ($umur_minimal != '' && $umur_maximal != '') {
            $where['penduduk.umur >='] = $umur_minimal;
            $where['penduduk.umur <='] = $umur_maximal;
        }
        $paramspenduduk['arrjoin']['tps']['statement'] = 'penduduk.id_tps = tps.id_tps';
        $paramspenduduk['arrjoin']['tps']['type'] = 'LEFT';
        $result = $this->action_m->get_where_params('penduduk', $where, 'penduduk.*,(SELECT nama FROM kelurahan WHERE kelurahan.id_kelurahan = penduduk.id_kelurahan) AS kelurahan,tps.nama AS tps', $paramspenduduk);

        if ($result) {
            $data = $result;
        } else {
            $data = null;
        }

        return $data;
    }

    private function _func_pendukung($get)
    {
        if ($get) {
            foreach ($get as $field => $value) {
                $$field = $value;
            }
        }

        $where['penduduk.id_intansi'] = $this->id_intansi;
        $where['penduduk.status'] = 2;
        // LOAD DATA
        $paramspenduduk = [];
        if (isset($data) && $data != '' && $data != 'all') {
            if (in_array($data, ['Y', 'N'])) {
                $where['penduduk.new_data'] = $data;
            }
        }
        if (isset($data) && $id_kelurahan != '' && $id_kelurahan != 'all') {
            $where['penduduk.id_kelurahan'] = $id_kelurahan;
        }
         if (isset($data) && $id_relawan != '' && $id_relawan != 'all') {
            $where['penduduk.taken_by'] = $id_relawan;
        }
        if (isset($search) && $search != '') {
            $search = search_encode($search);
            $paramspenduduk['columnsearch'][] = 'penduduk.nama';
            $paramspenduduk['columnsearch'][] = 'nik';
            $paramspenduduk['columnsearch'][] = 'notelp';
            $paramspenduduk['columnsearch'][] = 'email';
            $paramspenduduk['search'] = $search;
        }

        if (isset($umur_minimal) && $umur_minimal != '' && isset($umur_maximal) && $umur_maximal != '') {
            $where['penduduk.umur >='] = $umur_minimal;
            $where['penduduk.umur <='] = $umur_maximal;
        }

        $paramspenduduk['arrjoin']['tps']['statement'] = 'penduduk.id_tps = tps.id_tps';
        $paramspenduduk['arrjoin']['tps']['type'] = 'LEFT';
        $result = $this->action_m->get_where_params('penduduk', $where, 'penduduk.*,(SELECT nama FROM kelurahan WHERE kelurahan.id_kelurahan = penduduk.id_kelurahan) AS kelurahan,tps.nama AS tps', $paramspenduduk);
        if ($result) {
            $data = $result;
        } else {
            $data = null;
        }

        return $data;
    }
}
