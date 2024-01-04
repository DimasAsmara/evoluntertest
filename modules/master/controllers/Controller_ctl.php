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
    }

    public function index()
    {
        redirect('master/relawan');
    }
    public function relawan()
    {
        if ($this->session->userdata('vol_id_role') == 1) {
            redirect('dashboard');
        }
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $tugas = $this->input->get('penugasan');
        $status = $this->input->get('status');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Relawan';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/relawan";var PRINT = "cetak/excel/relawan";</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/master/relawan.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $paramsuser = [];
        if ($status != 'all') {
            if (in_array($status, ['Y', 'N'])) {
                $where['block'] = $status;
            }
        }
        if ($search) {
            $paramsuser['columnsearch'][] = 'nama';
            $paramsuser['columnsearch'][] = 'email';
            $paramsuser['columnsearch'][] = 'notelp';
            $paramsuser['search'] = $search;
        }
        $where['user.role'] = 1;
        $where['user.id_intansi'] = $this->id_intansi;



        $paramsuser['arrorderby']['kolom'] = 'user.nama';
        $paramsuser['arrorderby']['order'] = 'ASC';

        if ($tugas != NULL && $tugas != 'all') {
            $where['penugasan.id_kelurahan'] = $tugas;
            $paramsuser['arrjoin']['user']['statement'] = 'penugasan.id_user = user.id_user';
            $paramsuser['arrjoin']['user']['type'] = 'LEFT';
            $jumlah =  $this->action_m->cnt_where_params('penugasan', $where, 'penugasan.id_user, penugasan.id_kelurahan, user.*', $paramsuser);
            $paramsuser['limit'] = $limit;
            if ($offset) {
                $paramsuser['offset'] = $offset;
            }
            $user = $this->action_m->get_where_params('penugasan', $where, 'penugasan.id_user, penugasan.id_kelurahan, user.*', $paramsuser);
        } else {
            $jumlah = $this->action_m->cnt_where_params('user', $where, '*', $paramsuser);
            $paramsuser['limit'] = $limit;
            if ($offset) {
                $paramsuser['offset'] = $offset;
            }
            $user = $this->action_m->get_where_params('user', $where, '*', $paramsuser);
        }

        $params['arrjoin']['kelurahan']['statement'] = 'penugasan.id_kelurahan = kelurahan.id_kelurahan';
        $params['arrjoin']['kelurahan']['type'] = 'LEFT';
        $penugasan = $this->action_m->get_where_params('penugasan', ['kelurahan.id_intansi' => $this->id_intansi], 'penugasan.id_user, penugasan.id_kelurahan, kelurahan.nama', $params);
        $wilayah = $this->action_m->get_all('kelurahan', ['id_intansi' => $this->id_intansi]);
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
            $result = '';
        }
        $link = base_url('cetak/excel/relawan');
        $par = '';
        if ($this->input->get()) {
            $no = 1;
            foreach ($this->input->get() as $field => $val) {
                $num = $no++;
                if ($num == 1) {
                    $par .= '?' . $field . '=' . $val;
                } else {
                    $par .= '&' . $field . '=' . $val;
                }
            }
            $link = $link . $par;
        }

        // CETAK DATA
        $mydata['result'] = $result;
        $mydata['wilayah'] = $wilayah;
        $mydata['search'] = $search;
        $mydata['cetak'] = $link;

        load_pagination('master/relawan', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }

    public function wilayah()
    {
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Wilayah';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/wilayah";var PRINT = "cetak/excel/wilayah";</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/master/wilayah.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $param = [];
        if ($search) {
            $param['columnsearch'][] = 'nama';
            $param['search'] = $search;
        }
        $param['arrorderby']['kolom'] = 'kelurahan.nama';
        $param['arrorderby']['order'] = 'ASC';
        $where['id_intansi'] = $this->id_intansi;
        $jumlah = $this->action_m->cnt_where_params('kelurahan', $where, '*', $param);
        $param['limit'] = $limit;
        if ($offset) {
            $param['offset'] = $offset;
        }
        if ($this->id_role == 1) {
            // CEK AKSES RELAWAN
            $domain = [];
            if ($this->id_role == 1) {
                $cek_domain = $this->action_m->get_all('penugasan', ['id_user' => $this->id_user]);
                if ($cek_domain) {
                    foreach ($cek_domain as $val) {
                        $domain[] = $val->id_kelurahan;
                    }
                } else {
                    $domain[] = 0;
                }
            }
            $where['kelurahan.id_kelurahan'] = $domain;
        }
        $wilayah = $this->action_m->get_where_params('kelurahan', $where, 'kelurahan.*,(SELECT COUNT(*) AS cnt FROM penduduk WHERE penduduk.id_kelurahan = kelurahan.id_kelurahan) AS jumlah_penduduk, (SELECT COUNT(*) AS cnt_tps FROM tps WHERE tps.id_kelurahan = kelurahan.id_kelurahan) AS jumlah_tps', $param);
        $params['arrjoin']['user']['statement'] = 'penugasan.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $relawan = $this->action_m->get_where_params('penugasan', ['user.id_intansi' => $this->id_intansi, 'block' => 'N'], 'penugasan.id_user,penugasan.id_kelurahan, user.nama', $params);
        $rel = $this->action_m->get_all('user', ['id_intansi' => $this->id_intansi, 'block' => 'N']);
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
            $result = '';
        }
        $link = base_url('cetak/excel/wilayah');
        $par = '';
        if ($this->input->get()) {
            $no = 1;
            foreach ($this->input->get() as $field => $val) {
                $num = $no++;
                if ($num == 1) {
                    $par .= '?' . $field . '=' . $val;
                } else {
                    $par .= '&' . $field . '=' . $val;
                }
            }
            $link = $link . $par;
        }

        // SET MYDATA
        $mydata['result'] = $result;
        $mydata['relawan'] = $rel;
        $mydata['search'] = $search;
        $mydata['offset'] = ($offset) ? $offset + 1 : 1;
        $mydata['cetak'] = $link;


        load_pagination('master/wilayah', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('wilayah', $mydata, TRUE);
        $this->display();
    }

    public function tps()
    {
        if ($this->session->userdata('vol_id_role') == 1) {
            redirect('dashboard');
        }

        // LOAD MAIN DATA
        $this->data['title'] = 'Data TPS';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/tps";var PRINT = "cetak/excel/tps";</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/master/tps.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $param = [];
        $where['id_intansi'] = $this->id_intansi;
        $id_kelurahan = $this->input->get('id_kelurahan');
        if ($id_kelurahan != '' && $id_kelurahan != 'all' && $id_kelurahan != 'null') {
            $where['kelurahan.id_kelurahan'] = $id_kelurahan;
        }

        $jumlah = $this->action_m->cnt_where_params('kelurahan', $where, '*', $param);
        $param['limit'] = $limit;
        $param['arrorderby']['kolom'] = 'kelurahan.nama';
        $param['arrorderby']['order'] = 'ASC';
        if ($offset) {
            $param['offset'] = $offset;
        }

        $wilayah = $this->action_m->get_where_params('kelurahan', $where, 'kelurahan.*,(SELECT COUNT(*) AS cnt_tps FROM tps WHERE tps.id_kelurahan = kelurahan.id_kelurahan) AS jumlah_tps', $param);
        $kelurahan = $this->action_m->get_all('kelurahan', ['id_intansi' => $this->id_intansi]);
        $tps = $this->action_m->get_all('tps', ['tps.id_intansi' => $this->id_intansi], 'tps.*,(SELECT COUNT(*) FROM penduduk WHERE penduduk.id_tps = tps.id_tps) AS penduduk');
        if ($wilayah) {
            $nu = 0;
            foreach ($wilayah as $row) {
                $nuu = $nu++;
                $result[$nuu]['id_kelurahan'] = $row->id_kelurahan;
                $result[$nuu]['nama'] = $row->nama;
                $result[$nuu]['jumlah_tps'] = $row->jumlah_tps;
                $result[$nuu]['tps'] = [];
                if ($tps) {
                    $no = 0;
                    foreach ($tps as $p) {
                        if ($p->id_kelurahan == $row->id_kelurahan) {
                            $num = $no++;
                            $result[$nuu]['tps'][$num]['id_tps'] = $p->id_tps;
                            $result[$nuu]['tps'][$num]['nama'] = $p->nama;
                            $result[$nuu]['tps'][$num]['jumlah_penduduk'] = $p->penduduk;
                        }
                    }
                }
            }
        } else {
            $result = '';
        }
        // SET MYDATA
        $mydata['result'] = $result;
        $mydata['kelurahan'] = $kelurahan;
        $mydata['offset'] = ($offset) ? $offset + 1 : 1;


        load_pagination('master/tps', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('tps', $mydata, TRUE);
        $this->display();
    }


    public function penduduk()
    {
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $umur_minimal = $this->input->get('umur_minimal');
        $umur_maximal = $this->input->get('umur_maximal');
        $status = $this->input->get('status');
        $data = $this->input->get('data');
        $id_kelurahan = $this->input->get('id_kelurahan');
        $id_tps = $this->input->get('id_tps');
        $rt = $this->input->get('rt');
        $rw = $this->input->get('rw');


        // LOAD MAIN DATA
        $this->data['title'] = 'Data Penduduk';
        // LOAD CSS
        $this->data['css_add'][] = ' <link href="' . base_url() . 'assets/css/range.css" rel="stylesheet" type="text/css" />';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/penduduk"; var PRINT = "cetak/excel/penduduk";</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/master/penduduk.js"></script>';

        $where['penduduk.id_intansi'] = $this->id_intansi;
        if ($id_tps && $id_tps != 'all') {
            $where['penduduk.id_tps'] = $id_tps;
        }
        // CEK AKSES RELAWAN
        $domain = [];
        if ($this->id_role == 1) {
            $cek_domain = $this->action_m->get_all('penugasan', ['id_user' => $this->id_user]);
            if ($cek_domain) {
                foreach ($cek_domain as $val) {
                    $domain[] = $val->id_kelurahan;
                }
            } else {
                $domain[] = 0;
            }
        }
        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $paramspenduduk = [];
        if ($status != '' && $status != 'all') {
            if (in_array($status, [1, 2])) {
                $where['penduduk.status'] = $status;
            }
        }
        if ($data != '' && $data != 'all') {
            if (in_array($data, ['Y', 'N'])) {
                $where['penduduk.new_data'] = $data;
            }
        }
        if ($id_kelurahan != '' && $id_kelurahan != 'all') {
            $where['penduduk.id_kelurahan'] = $id_kelurahan;
        }
        if ($search != '') {
            $paramspenduduk['columnsearch'][] = 'penduduk.nama';
            $paramspenduduk['columnsearch'][] = 'nik';
            $paramspenduduk['columnsearch'][] = 'notelp';
            $paramspenduduk['columnsearch'][] = 'email';
            $paramspenduduk['search'] = $search;
        }

        if ($rt != 'all' && $rt != '') {
            $where['penduduk.rt'] = $rt;
        }
        if ($rw != 'all' && $rw != '') {
            $where['penduduk.rw'] = $rw;
        }

        $paramspenduduk['arrorderby']['kolom'] = 'penduduk.nama';
        $paramspenduduk['arrorderby']['order'] = 'ASC';

        if ($umur_minimal != '' && $umur_maximal != '') {
            $where['penduduk.umur >='] = $umur_minimal;
            $where['penduduk.umur <='] = $umur_maximal;
        }
        if ($this->id_role == 1) {
            $paramspenduduk['where_in']['kolom'] = 'penduduk.id_kelurahan';
            $paramspenduduk['where_in']['value'] = $domain;
        }
        $jumlah = $this->action_m->cnt_where_params('penduduk', $where, '*', $paramspenduduk);
        $paramspenduduk['limit'] = $limit;
        if ($offset) {
            $paramspenduduk['offset'] = $offset;
        }
        $paramspenduduk['arrjoin']['tps']['statement'] = 'penduduk.id_tps = tps.id_tps';
        $paramspenduduk['arrjoin']['tps']['type'] = 'LEFT';
        $result = $this->action_m->get_where_params('penduduk', $where, 'penduduk.*,(SELECT nama FROM user WHERE user.id_user = penduduk.taken_by) AS relawan,(SELECT foto FROM user WHERE user.id_user = penduduk.taken_by) AS foto_relawan,(SELECT nama FROM kelurahan WHERE kelurahan.id_kelurahan = penduduk.id_kelurahan) AS kelurahan,tps.nama AS tps', $paramspenduduk);
        $kelurahan = $this->action_m->get_all('kelurahan', ['id_intansi' => $this->id_intansi]);

        $link = base_url('cetak/excel/penduduk');
        $par = '';
        if ($this->input->get()) {
            $no = 1;
            foreach ($this->input->get() as $field => $val) {
                $num = $no++;
                if ($num == 1) {
                    $par .= '?' . $field . '=' . $val;
                } else {
                    $par .= '&' . $field . '=' . $val;
                }
            }
            $link = $link . $par;
        }

        // CETAK DATA
        if ($this->id_role == 1) {
            if ($search != '' && $id_kelurahan != 'all' && $id_kelurahan != '') {
                $mydata['result'] = $result;
                $mydata['text_false'] = '';
            } else {
                $mydata['result'] = NULL;
                $mydata['text_false'] = 'Relawan harus melakukan Search nama dan filter kelurahan untuk menampilkan data penduduk';
            }
        } else {
            $mydata['result'] = $result;
            $mydata['text_false'] = '';
        }

        $mydata['search'] = $search;
        $mydata['kelurahan'] = $kelurahan;
        $mydata['offset'] = ($offset) ? $offset + 1 : 1;
        $mydata['cetak'] = $link;

        load_pagination('master/penduduk', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('penduduk', $mydata, TRUE);
        $this->display();
    }

    public function pendukung()
    {
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $umur_minimal = $this->input->get('umur_minimal');
        $umur_maximal = $this->input->get('umur_maximal');
        $data = $this->input->get('data');
        $id_kelurahan = $this->input->get('id_kelurahan');
        $id_relawan = $this->input->get('id_relawan');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Pendukung';
        // LOAD CSS
        $this->data['css_add'][] = ' <link href="' . base_url() . 'assets/css/range.css" rel="stylesheet" type="text/css" />';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/pendukung";var PRINT = "cetak/excel/pendukung";</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/master/penduduk.js"></script>';

        $where['penduduk.id_intansi'] = $this->id_intansi;

        // CEK AKSES RELAWAN
        // $domain = [];
        // if ($this->id_role == 1) {
        //     $cek_domain = $this->action_m->get_all('penugasan', ['id_user' => $this->id_user]);
        //     if ($cek_domain) {
        //         foreach ($cek_domain as $val) {
        //             $domain[] = $val->id_kelurahan;
        //         }
        //     } else {
        //         $domain[] = 0;
        //     }
        // }
        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $paramspenduduk = [];
        if ($data != '' && $data != 'all') {
            if (in_array($data, ['Y', 'N'])) {
                $where['penduduk.new_data'] = $data;
            }
        }
        if ($id_kelurahan != '' && $id_kelurahan != 'all') {
            $where['penduduk.id_kelurahan'] = $id_kelurahan;
        }
        if ($search != '') {
            $paramspenduduk['columnsearch'][] = 'penduduk.nama';
            $paramspenduduk['columnsearch'][] = 'nik';
            $paramspenduduk['columnsearch'][] = 'notelp';
            $paramspenduduk['columnsearch'][] = 'email';
            $paramspenduduk['search'] = $search;
        }

        if ($id_relawan != '') {
            $where['penduduk.taken_by'] = $id_relawan;
        }
        $paramspenduduk['arrorderby']['kolom'] = 'penduduk.nama';
        $paramspenduduk['arrorderby']['order'] = 'ASC';



        if ($umur_minimal != '' && $umur_maximal != '') {
            $where['penduduk.umur >='] = $umur_minimal;
            $where['penduduk.umur <='] = $umur_maximal;
        }
        if ($this->id_role == 1) {
            // $paramspenduduk['where_in']['kolom'] = 'penduduk.id_kelurahan';
            // $paramspenduduk['where_in']['value'] = $domain;
            $where['penduduk.taken_by'] = $this->id_user;
        }
        $where['penduduk.status'] = 2;
        $jumlah = $this->action_m->cnt_where_params('penduduk', $where, '*', $paramspenduduk);
        $paramspenduduk['limit'] = $limit;
        if ($offset) {
            $paramspenduduk['offset'] = $offset;
        }
        $paramspenduduk['arrjoin']['tps']['statement'] = 'penduduk.id_tps = tps.id_tps';
        $paramspenduduk['arrjoin']['tps']['type'] = 'LEFT';
        $result = $this->action_m->get_where_params('penduduk', $where, 'penduduk.*,(SELECT nama FROM user WHERE user.id_user = penduduk.taken_by) AS relawan,(SELECT foto FROM user WHERE user.id_user = penduduk.taken_by) AS foto_relawan,(SELECT nama FROM kelurahan WHERE kelurahan.id_kelurahan = penduduk.id_kelurahan) AS kelurahan,tps.nama AS tps', $paramspenduduk);
        $kelurahan = $this->action_m->get_all('kelurahan', ['id_intansi' => $this->id_intansi]);
        $relawan = $this->action_m->get_all('user', ['id_intansi' => $this->id_intansi, 'block' => 'N', 'role' => 1]);

        $link = base_url('cetak/excel/pendukung');
        $par = '';
        if ($this->input->get()) {
            $no = 1;
            foreach ($this->input->get() as $field => $val) {
                $num = $no++;
                if ($num == 1) {
                    $par .= '?' . $field . '=' . $val;
                } else {
                    $par .= '&' . $field . '=' . $val;
                }
            }
            $link = $link . $par;
        }

        // CETAK DATA
        $mydata['result'] = $result;
        $mydata['search'] = $search;
        $mydata['kelurahan'] = $kelurahan;
        $mydata['relawan'] = $relawan;
        $mydata['offset'] = ($offset) ? $offset + 1 : 1;
        $mydata['cetak'] = $link;

        load_pagination('master/pendukung', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('pendukung', $mydata, TRUE);
        $this->display();
    }


    // FUNGSI AJAX
    public function get_single_relawan()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('user', ['id_user' => $id]);
        $penugasan = $this->action_m->get_all('penugasan', ['id_user' => $id]);
        if ($penugasan) {
            $no = 0;
            foreach ($penugasan as $key) {
                $num = $no++;
                $penugasan[$num] = $key->id_kelurahan;
            }
        } else {
            $penugasan = [];
        }
        $data['user'] = $result;
        $data['penugasan'] = $penugasan;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function get_single_wilayah()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('kelurahan', ['id_kelurahan' => $id], "kelurahan.*,(SELECT COUNT(*) FROM tps WHERE tps.id_kelurahan = kelurahan.id_kelurahan) AS jumlah_tps");
        // sleep(1.5);
        echo json_encode($result);
        exit;
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

    public function get_single_penduduk()
    {
        $id = $this->input->post('id');
        $param['arrjoin']['kelurahan']['statement'] = 'penduduk.id_kelurahan = kelurahan.id_kelurahan';
        $param['arrjoin']['kelurahan']['type'] = 'LEFT';
        $param['arrjoin']['user']['statement'] = 'penduduk.create_by = user.id_user';
        $param['arrjoin']['user']['type'] = 'LEFT';
        $result = $this->action_m->get_where_params('penduduk', ['id_penduduk' => $id], 'penduduk.*,kelurahan.nama AS kelurahan,user.nama AS created,(SELECT nama FROM user WHERE id_user = penduduk.taken_by) AS taken', $param);
        if ($result) {
            $result = $result[0];
        }

        // sleep(1.5);
        echo json_encode($result);
        exit;
    }

    public function get_relawan_wilayah()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('kelurahan', ['id_kelurahan' => $id]);
        $params['arrjoin']['user']['statement'] = 'penugasan.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $relawan = $this->action_m->get_where_params('penugasan', ['user.id_intansi' => $this->id_intansi, 'id_kelurahan' => $id, 'block' => 'N', 'role' => 1], 'penugasan.id_user,penugasan.id_kelurahan, user.nama AS relawan,user.foto,user.email', $params);
        $id_penugasan = $this->action_m->get_where_params('penugasan', ['user.id_intansi' => $this->id_intansi, 'block' => 'N', 'role' => 1], '*', $params);
        $params2 = [];
        if ($relawan) {
            $arr = [];
            foreach ($relawan as $row) {
                $arr[] = $row->id_user;
            }
            $params2['not_where_in']['kolom'] = 'user.id_user';
            $params2['not_where_in']['value'] = $arr;
        }

        $base = [];
        if ($id_penugasan) {
            foreach ($id_penugasan as $key) {
                $base[] = $key->id_user;
            }
        }


        $all_relawan = $this->action_m->get_where_params('user', ['user.id_intansi' => $this->id_intansi, 'block' => 'N', 'role' => 1], 'user.id_user,user.nama AS relawan,user.foto,user.email', $params2);
        // sleep(1.5);
        $data['result'] = $result;
        $data['relawan'] = $relawan;
        $data['all_relawan'] = $all_relawan;
        $data['id_penugasan'] = $base;
        $data['id_kelurahan'] = $id;
        $this->load->view('attr/wilayah_modal_relawan', $data);
    }

    public function get_warga_tps()
    {
        $id = $this->input->post('id');
        $id_kelurahan = $this->input->post('id_kelurahan');

        $result = $this->action_m->get_single('tps', ['id_tps' => $id]);
        $warga_tps = $this->action_m->get_all('penduduk', ['penduduk.id_intansi' => $this->id_intansi, 'id_tps' => $id]);
        $warga_non_tps = $this->action_m->get_all('penduduk', ['penduduk.id_intansi' => $this->id_intansi, 'id_tps' => NULL, 'id_kelurahan' => $id_kelurahan]);

        $data['result'] = $result;
        $data['warga_tps'] = $warga_tps;
        $data['warga_non_tps'] = $warga_non_tps;
        $this->load->view('attr/tps_modal_warga', $data);
    }
}
