<?php defined('BASEPATH') or exit('No direct script access allowed');

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



    // MASTER RELAWAN

    public function tambah_relawan()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama relawan';
        $arrVar['email']            = 'Alamat email';
        $arrVar['notelp']           = 'Nomor telepon';
        $arrVar['password']         = 'Kata sandi';
        $arrVar['repassword']       = 'Konfirmasi kata sandi ';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var, ['password', 'repassword'])) {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
        }
        $penugasan = $this->input->post('penugasan');
        if (!in_array(false, $arrAccess)) {
            $user_email = $this->action_m->get_single('user', ['email' => $email]);
            $user_telp = $this->action_m->get_single('user', ['notelp' => $notelp]);
            if (!validasi_email($email)) {
                $data['status'] = false;
                $data['alert']['message'] = 'Alamat email tidak valid!';
                echo json_encode($data);
                exit;
            }

            if ($user_email) {
                $data['status'] = false;
                $data['alert']['message'] = 'Alamat email sudah terdaftar!';
                echo json_encode($data);
                exit;
            }
            if ($user_telp) {
                $data['status'] = false;
                $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                echo json_encode($data);
                exit;
            }

            if ($password != $repassword) {
                $data['status'] = false;
                $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                echo json_encode($data);
                exit;
            } else {
                $post['password'] = hash_my_password($email . $password);
            }
            $post['create_by'] = $this->session->userdata('vol_id_user');
            $post['id_intansi'] = $this->session->userdata('vol_id_intansi');
            if (!empty($_FILES['foto']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/user/')) {
                    mkdir('/data/user/');
                }
                $foto = $_FILES['foto'];
                $tujuan = './data/user/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_relawan = [];

                if (!$this->upload->do_upload('foto')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_relawan = array('upload_data' => $this->upload->data());
                    $post['foto'] = $data_relawan['upload_data']['file_name'];
                }
            }
            $insert = $this->action_m->insert('user', $post);
            if ($insert) {
                if ($penugasan) {
                    $no = 0;
                    $ps = [];
                    foreach ($penugasan as $value) {
                        $num = $no++;
                        $ps[$num]['id_user'] = $insert;
                        $ps[$num]['id_kelurahan'] = $value;
                    }
                    $this->action_m->insert_batch('penugasan', $ps);
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Data relawan berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/relawan #reload_table');
                $data['modal']['id'] = '#kt_modal_relawan';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_relawan()
    {
        // VARIABEL
        $arrVar['id_user']          = 'Id user';
        $arrVar['nama']             = 'Nama relawan';
        $arrVar['email']            = 'Alamat email';
        $arrVar['notelp']           = 'Nomor telepon';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $result = $this->action_m->get_single('user', ['id_user' => $id_user]);
        $penugasan = $this->input->post('penugasan');
        $password = $this->input->post('password');
        $repassword = $this->input->post('repassword');
        if (!in_array(false, $arrAccess)) {
            if (!validasi_email($email)) {
                $data['status'] = false;
                $data['alert']['message'] = 'Alamat email tidak valid!';
                echo json_encode($data);
                exit;
            }

            if ($result->email != $email) {
                $cek_email = $this->action_m->get_single('user', ['email' => $email]);
                if ($cek_email) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Alamat email sudah terdaftar!';
                    echo json_encode($data);
                    exit;
                }
            }

            if ($result->notelp != $notelp) {
                $cek_notelp = $this->action_m->get_single('user', ['notelp' => $notelp]);
                if ($cek_notelp) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                    echo json_encode($data);
                    exit;
                }
            }

            if ($password) {
                if ($password != $repassword) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                    echo json_encode($data);
                    exit;
                } else {
                    $post['password'] = hash_my_password($email . $password);
                }
            }
            $nama_foto = $this->input->post('nama_foto');
            if ($nama_foto == '') {
                $post['foto'] = NULL;
                unlink('./data/user/' . $result->foto);
            }
            if (!empty($_FILES['foto']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/user/')) {
                    mkdir('/data/user/');
                }
                $foto = $_FILES['foto'];
                $tujuan = './data/user/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_relawan = [];

                if (!$this->upload->do_upload('foto')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_relawan = array('upload_data' => $this->upload->data());
                    $post['foto'] = $data_relawan['upload_data']['file_name'];
                    unlink($tujuan . $nama_foto);
                }
            }
            $update = $this->action_m->update('user', $post, ['id_user' => $id_user]);
            if ($update) {
                $this->action_m->delete('penugasan', ['id_user' => $id_user]);
                if ($penugasan != '') {

                    $no = 0;
                    $ps = [];
                    foreach ($penugasan as $value) {
                        $num = $no++;
                        $ps[$num]['id_user'] = $id_user;
                        $ps[$num]['id_kelurahan'] = $value;
                    }
                    $this->action_m->insert_batch('penugasan', $ps);
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Data relawan berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/relawan #reload_table');
                $data['modal']['id'] = '#kt_modal_relawan';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_relawan()
    {
        $id = $this->input->post('id');
        $hapus = $this->action_m->delete('user', ['id_user' => $id]);
        if ($hapus) {
            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            $data['alert']['message'] = 'Data relawan berhasil dihapus';
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data relawan gagal dihapus! Coba lagi nanti atau laporkan';
        }

        echo json_encode($data);
        exit;
    }

    public function block_user()
    {
        $id = $this->input->post('id');
        $action = $this->input->post('action');
        $reason = $this->input->post('reason');

        $set['block'] = $action;
        if ($action == 'Y') {
            $set['block_reason'] = $reason;
            $set['block_date'] = date('Y-m-d H:i:s');
            $set['block_by'] = $this->session->userdata('vol_id_user');
        } else {
            $set['block_reason'] = NULL;
            $set['block_date'] = NULL;
            $set['block_by'] = NULL;
        }

        $update = $this->action_m->update('user', $set, ['id_user' => $id]);
        if ($update) {
            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            if ($action == 'Y') {
                $data['alert']['message'] = 'Relawan berhasil di blockir! Relawan tidak akan bisa melakukan akses pada sistem';
            } else {
                $data['alert']['message'] = 'Status blockir relawan telah dibuka! Relawan bisa melakukan akses pada sistem';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Relawan gagal di blockir! Coba lagi setelah beberapa saat atau laporkan';
        }
        echo json_encode($data);
        exit;
    }

    public function drag_relawan($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data relawan belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            $cek = $this->action_m->get_all('user', ['id_user' => $id, 'block' => 'N']);
            if ($cek) {
                foreach ($id as $value) {
                    $num = $no++;
                    $set[$num]['id_user'] = $value;
                    $set[$num]['block'] = 'Y';
                    $set[$num]['block_by'] = $this->session->userdata('vol_id_user');
                    $set[$num]['block_date'] = date('Y-m-d H:i:s');
                }
                $block = $this->action_m->update_batch('user', $set, 'id_user');
                if ($block) {
                    $data['status'] = 200;
                    $data['alert']['message'] = 'Berhasil melakukan block pada sejumlah user';
                    $data['load'][0]['parent'] = '#base_table';
                    $data['load'][0]['reload'] = base_url('master/relawan #reload_table');
                } else {
                    $data['status'] = 500;
                    $data['alert']['message'] = 'Gagal melakukan block pada sejumlah user';
                }
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Relawan yang di pilih sudah dalam kondisi di blockir';
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            $cek = $this->action_m->get_all('user', ['id_user' => $id, 'block' => 'Y']);
            if ($cek) {
                foreach ($id as $value) {
                    $num = $no++;
                    $set[$num]['id_user'] = $value;
                    $set[$num]['block'] = 'N';
                    $set[$num]['block_by'] = NULL;
                    $set[$num]['block_date'] = NULL;
                }
                $unblock = $this->action_m->update_batch('user', $set, 'id_user');
                if ($unblock) {
                    $data['status'] = 200;
                    $data['alert']['message'] = 'Berhasil membuka block pada sejumlah user';
                    $data['load'][0]['parent'] = '#base_table';
                    $data['load'][0]['reload'] = base_url('master/relawan #reload_table');
                } else {
                    $data['status'] = 500;
                    $data['alert']['message'] = 'Gagal membuka block pada sejumlah user';;
                }
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Relawan yang di pilih sudah dalam kondisi tidak di blockir';
            }
        } elseif ($action == 'deleted') {
            $set = [];
            foreach ($id as $value) {
                $d[] = $value;
            }
            $set['id_user'] = $d;
            $delete = $this->action_m->delete_batch('user', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah user';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/relawan #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah user';;
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }


    // MASTER WILAYAH
    public function tambah_wilayah()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama kelurahan';
        $arrVar['jumlah_tps']        = 'Jumlah TPS';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        if (!in_array(false, $arrAccess)) {
            $post['id_intansi'] = $this->session->userdata('vol_id_intansi');
            $insert = $this->action_m->insert('kelurahan', $post);
            if ($insert) {
                for ($i = 0; $i < $jumlah_tps; $i++) {
                    $p[$i]['id_kelurahan'] = $insert;
                    $p[$i]['id_intansi'] = $this->id_intansi;
                    $p[$i]['nama'] = 'TPS ' . ($i + 1);
                }
                $tps = $this->action_m->insert_batch('tps', $p);
                if ($tps) {
                    $data['status'] = true;
                    $data['alert']['message'] = 'Data kelurahan berhasil di tambahkan!';
                    $data['load'][0]['parent'] = '#base_table';
                    $data['load'][0]['reload'] = base_url('master/wilayah #reload_table');
                    $data['modal']['id'] = '#kt_modal_wilayah';
                    $data['modal']['action'] = 'hide';
                    $data['input']['all'] = true;
                } else {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Data TPS gagal di tambahkan!';
                }
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Data kelurahan gagal di tambahkan!';
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_wilayah()
    {
        // VARIABEL
        $arrVar['id_kelurahan']     = 'ID kelurahan';
        $arrVar['nama']             = 'Nama kelurahan';
        $arrVar['jumlah_tps']       = 'Jumlah TPS';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        $result = $this->action_m->get_single('kelurahan', ['id_kelurahan' => $id_kelurahan, 'id_intansi' => $this->id_intansi], 'kelurahan.*, (SELECT COUNT(*) AS cnt_tps FROM tps WHERE tps.id_kelurahan = kelurahan.id_kelurahan) AS cnt_tps');
        if (!$result) {
            $data['status'] = false;
            $data['alert']['message'] = 'Data kelurahan tidak di temukan!';
            echo json_encode($data);
            exit;
        }
        if (!in_array(false, $arrAccess)) {
            $update = $this->action_m->update('kelurahan', $post, ['id_kelurahan' => $id_kelurahan]);
            if ($update) {
                if ($jumlah_tps != $result->cnt_tps) {
                    if ($jumlah_tps > $result->cnt_tps) {
                        $p = [];
                        $a = $result->cnt_tps + 1;;
                        for ($i = 0; $i < ($jumlah_tps - $result->cnt_tps); $i++) {
                            $p[$i]['id_kelurahan'] = $id_kelurahan;
                            $p[$i]['id_intansi'] = $this->id_intansi;
                            $p[$i]['nama'] = 'TPS ' . $a++;
                        }
                        $ac_tps = $this->action_m->insert_batch('tps', $p);
                    } else {
                        $params['limit'] = $result->cnt_tps;
                        $params['offset'] = $jumlah_tps;
                        $tps = $this->action_m->get_where_params('tps', ['id_kelurahan' => $id_kelurahan], '*', $params);
                        if ($tps) {
                            $d = [];
                            foreach ($tps as $key) {
                                $d[] = $key->id_tps;
                            }
                            $w['id_tps'] = $d;
                        }
                        $del_tps = $this->action_m->delete_batch('tps', $w);
                    }
                }

                $data['status'] = true;
                $data['alert']['message'] = 'Data kelurahan berhasil dirubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/wilayah #reload_table');
                $data['modal']['id'] = '#kt_modal_wilayah';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_wilayah()
    {
        $id = $this->input->post('id');
        $hapus = $this->action_m->delete('kelurahan', ['id_kelurahan' => $id]);
        if ($hapus) {
            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            $data['alert']['message'] = 'Data kelurahan berhasil dihapus';
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data kelurahan gagal dihapus! Coba lagi nanti atau laporkan';
        }

        echo json_encode($data);
        exit;
    }

    public function drag_wilayah($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data relawan belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'deleted') {
            $set = [];
            foreach ($id as $value) {
                $d[] = $value;
            }
            $set['id_kelurahan'] = $d;
            $delete = $this->action_m->delete_batch('kelurahan', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah kelurahan';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/wilayah #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah kelurahan';;
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }

    public function set_relawan()
    {
        $id_kelurahan = $this->input->post('id_kelurahan');
        $id_user = $this->input->post('id_user');
        $id_relawan = $this->input->post('id_relawan');


        if ($id_user || $id_relawan) {
            $no = 0;
            $in = [];
            $del = [];
            $insert = 1;
            $delete = true;
            $tabel = '<table class="sweet">';

            if ($id_user) {
                $d = [];
                $tabel .= '<tr><th>Relawan di tambahkan</th></tr>';
                foreach ($id_user as $value) {
                    $num = $no++;
                    $in[$num]['id_user'] = $value;
                    $in[$num]['id_kelurahan'] = $id_kelurahan;
                    $d[] = $value;
                }
                $insert = $this->action_m->insert_batch('penugasan', $in);
                $rel_insert = $this->action_m->get_all('user', ['id_user' => $d]);

                if ($rel_insert) {
                    foreach ($rel_insert as $val) {
                        $tabel .= '<tr>';
                        $tabel .= '<td>' . $val->nama . '</td>';
                        $tabel .= '</tr>';
                    }
                }
            }

            if ($id_relawan) {
                $d = [];
                foreach ($id_relawan as $value) {
                    $del[] = $value;
                }
                $w['id_user'] = $del;
                $w['id_kelurahan'] = $id_kelurahan;
                $delete = $this->action_m->delete_batch('penugasan', $w);
                $rel_hapus = $this->action_m->get_all('user', ['id_user' => $del]);
                $tabel .= '<tr><th>Relawan di hapus</th></tr>';
                if ($rel_hapus) {
                    foreach ($rel_hapus as $val) {
                        $tabel .= '<tr>';
                        $tabel .= '<td>' . $val->nama . '</td>';
                        $tabel .= '</tr>';
                    }
                }
            }

            if ($insert && $delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil mengatur relawan! </br></br>' . $tabel;
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/wilayah #reload_table');
                $data['modal']['id'] = '#kt_modal_tambah_pic';
                $data['modal']['action'] = 'hide';
            } else {
                $data['status'] = 700;
                $data['alert']['message'] = 'Gagal menambahkan relawan! Coba lagi nanti atau laporkan';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Tidak ada data relawan yang di pilih!';
        }
        echo json_encode($data);
        exit;
    }




    // MASTER PENDUDUK
    public function tambah_penduduk()
    {
        // VARIABEL
        $arrVar['nama']                 = 'Nama penduduk';
        $arrVar['id_kelurahan']             = 'Kelurahan';
        $arrVar['notelp']               = 'Nomor Telepon';
        $arrVar['id_tps']               = 'TPS';
        $arrVar['umur']               = 'Umur';
        $arrVar['rt']               = 'Rt';
        $arrVar['rw']               = 'Rw';
        if ($this->id_role == 1) {
            $arrVar['nik']              = 'NIK ';
            $arrVar['email']              = 'Alamat email ';
            $arrVar['gender']              = 'Gender';
            $arrVar['alamat']              = 'Alamat lengkap ';
        }
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                if (!in_array($var, ['rt', 'rw'])) {
                    $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                }
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        if (!$rt || !$rw) {
            $data['required'][] = ['req_rt_rw', 'Data RT dan RW tidak boleh kosong !'];
        }
        if ($this->id_role == 2) {
            $arrVar2['nik']              = 'NIK';
            $arrVar2['email']              = 'Alamat email';
            $arrVar2['gender']              = 'Gender';
            $arrVar2['alamat']              = 'Alamat lengkap';
            foreach ($arrVar2 as $var => $value) {
                $$var = $this->input->post($var);
                if ($$var) {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
        }

        if (isset($nik) && $nik != '') {
            $cek_nik = $this->action_m->get_single('penduduk', ['id_intansi' => $this->id_intansi, 'nik' => $nik]);
            if ($cek_nik) {
                $data['status'] = false;
                $data['alert']['message'] = 'NIK Sudah terdaftar sebagai pendukung! Cek kembali NIK yang anda masukan';
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
            } else {
                if ($this->id_role == 1) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Foto Penduduk tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
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
            } else {
                if ($this->id_role == 1) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Foto KTP tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }
            }
            if ($this->id_role == 1) {
                $post['new_data'] = 'Y';
                $post['status'] = 2;
                $post['taken_by'] = $this->id_user;
                $post['taken_date'] = date('Y-m-d H:i:s');
            } else {
                $post['new_data'] = 'N';
                $post['status'] = 1;
            }
            $post['create_by'] = $this->id_user;
            $post['id_intansi'] = $this->session->userdata('vol_id_intansi');
            $insert = $this->action_m->insert('penduduk', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data penduduk berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/penduduk #reload_table');
                $data['modal']['id'] = '#kt_modal_penduduk';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Data penduduk gagal di tambahkan!';
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_penduduk()
    {
        // VARIABEL
        $arrVar['id_penduduk']                 = 'ID penduduk';
        $arrVar['nama']                 = 'Nama penduduk';
        $arrVar['id_kelurahan']             = 'Kelurahan';
        $arrVar['id_tps']             = 'TPS';
        $arrVar['notelp']               = 'Nomor Telepon';
        $arrVar['umur']               = 'Umur';
        $arrVar['rt']               = 'Rt';
        $arrVar['rw']               = 'Rw';
        if ($this->id_role == 1) {
            $arrVar['nik']              = 'NIK ';
            $arrVar['email']              = 'Alamat email ';
            $arrVar['gender']              = 'Gender';
            $arrVar['alamat']              = 'Alamat lengkap ';
        }
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                if (!in_array($var, ['rt', 'rw'])) {
                    $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                }
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        if (
            !$rt || !$rw
        ) {
            $data['required'][] = ['req_rt_rw', 'Data RT dan RW tidak boleh kosong !'];
        }
        if ($this->id_role == 2) {
            $arrVar2['nik']              = 'NIK';
            $arrVar2['email']              = 'Alamat email';
            $arrVar2['gender']              = 'Gender';
            $arrVar2['alamat']              = 'Alamat lengkap';
            foreach ($arrVar2 as $var => $value) {
                $$var = $this->input->post($var);
                if ($$var) {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
        }
        if (isset($nik) && $nik != '') {
            $cek_nik = $this->action_m->get_single('penduduk', ['id_intansi' => $this->id_intansi, 'nik' => $nik]);
            if ($cek_nik) {
                $data['status'] = false;
                $data['alert']['message'] = 'NIK Sudah terdaftar sebagai pendukung! Cek kembali NIK yang anda masukan';
                echo json_encode($data);
                exit;
            }
        }
        $penduduk = $this->action_m->get_single('penduduk', ['id_penduduk' => $id_penduduk]);
        if (!$penduduk) {
            $data['status'] = false;
            $data['alert']['message'] = 'Data penduduk tidak di temukan! Coba lagi nanti atau hubungi admin';
            echo json_encode($data);
            exit;
        }
        if (!in_array(false, $arrAccess)) {
            $nama_foto_pendukung = $this->input->post('nama_foto_pendukung');
            $nama_foto_ktp = $this->input->post('nama_foto_ktp');
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
                    unlink('./data/penduduk/' . $penduduk->foto_pendukung);
                    $arrAccess[] = true;
                }
            } else {
                if ($this->id_role == 1 && $nama_foto_pendukung == '') {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Foto Penduduk tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                } else {
                    if ($nama_foto_pendukung == '') {
                        $post['foto_pendukung'] = NULL;
                        unlink('./data/user/' . $nama_foto_pendukung);
                    }
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
                $tujuan_ktp = './data/penduduk/';
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
                    unlink('./data/penduduk/' . $penduduk->foto_ktp);
                }
            } else {
                if ($this->id_role == 1 && $nama_foto_ktp == '') {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Foto KTP tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                } else {
                    if ($nama_foto_ktp == '') {
                        $post['foto_ktp'] = NULL;
                        unlink('./data/user/' . $nama_foto_ktp);
                    }
                }
            }
            $update = $this->action_m->update('penduduk', $post, ['id_penduduk' => $id_penduduk]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data penduduk berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/penduduk #reload_table');
                $data['modal']['id'] = '#kt_modal_penduduk';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Data penduduk gagal di rubah!';
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }


    public function hapus_penduduk()
    {
        $id = $this->input->post('id');
        $hapus = $this->action_m->delete('penduduk', ['id_penduduk' => $id]);
        if ($hapus) {
            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            $data['alert']['message'] = 'Data penduduk berhasil dihapus';
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data penduduk gagal dihapus! Coba lagi nanti atau laporkan';
        }

        echo json_encode($data);
        exit;
    }

    public function drag_penduduk($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data penduduk belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'deleted') {
            $set = [];
            foreach ($id as $value) {
                $d[] = $value;
            }
            $set['id_penduduk'] = $d;
            $delete = $this->action_m->delete_batch('penduduk', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah penduduk';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/penduduk #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah penduduk';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }


    // MASTER PENDUKUNG
    public function tambah_pendukung()
    {
        // VARIABEL
        $arrVar['id_penduduk']                 = 'ID Penduduk';
        $arrVar['nama']                 = 'Nama';
        $arrVar['nik']                  = 'NIK';
        $arrVar['notelp']               = 'Nomor telepon';
        $arrVar['gender']               = 'Gender';
        $arrVar['new_data']             = 'Data baru';
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_2_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
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
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/penduduk #reload_table');
                $data['modal']['id'] = '#kt_modal_add_pendukung';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
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


    // MASTER TPS
    public function tambah_tps()
    {
        // VARIABEL
        $arrVar['id_kelurahan']     = 'ID kelurahan';
        $arrVar['jumlah_tps']       = 'Jumlah TPS';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var, ['jumlah_tps'])) {
                    $post[$var] = trim($$var);
                }
                $arrAccess[] = true;
            }
        }

        $result = $this->action_m->get_single('kelurahan', ['id_kelurahan' => $id_kelurahan, 'id_intansi' => $this->id_intansi], 'kelurahan.*, (SELECT COUNT(*) AS cnt_tps FROM tps WHERE tps.id_kelurahan = kelurahan.id_kelurahan) AS cnt_tps');
        if (!$result) {
            $data['status'] = false;
            $data['alert']['message'] = 'Data kelurahan tidak di temukan!';
            echo json_encode($data);
            exit;
        }
        if (!in_array(false, $arrAccess)) {
            if ($jumlah_tps != $result->cnt_tps) {
                if ($jumlah_tps > $result->cnt_tps) {
                    $p = [];
                    $a = $result->cnt_tps + 1;;
                    for ($i = 0; $i < ($jumlah_tps - $result->cnt_tps); $i++) {
                        $p[$i]['id_kelurahan'] = $id_kelurahan;
                        $p[$i]['id_intansi'] = $this->id_intansi;
                        $p[$i]['nama'] = 'TPS ' . $a++;
                    }
                    $end_action = $this->action_m->insert_batch('tps', $p);
                } else {
                    $params['limit'] = $result->cnt_tps;
                    $params['offset'] = $jumlah_tps;
                    $tps = $this->action_m->get_where_params('tps', ['id_kelurahan' => $id_kelurahan], '*', $params);
                    if ($tps) {
                        $d = [];
                        foreach ($tps as $key) {
                            $d[] = $key->id_tps;
                        }
                        $w['id_tps'] = $d;
                    }
                    $end_action = $this->action_m->delete_batch('tps', $w);
                }
                if ($end_action) {
                    $update_kelurahan = $this->action_m->update('tps', ['jumlah_tps' => $jumlah_tps], ['id_kelurahan' => $id_kelurahan]);
                    $data['status'] = true;
                    $data['alert']['message'] = 'Data TPS berhasil dirubah!';
                    $data['load'][0]['parent'] = '#base_table';
                    $data['load'][0]['reload'] = base_url('master/tps #reload_table');
                    $data['modal']['id'] = '#kt_modal_tps';
                    $data['modal']['action'] = 'hide';
                    $data['input']['all'] = true;
                } else {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Tidak dapat mengatur TPS! Hubungi admin atau tunggu beberapa saat';
                }
            } else {
                $data['status'] = false;
                $data['alert']['message'] = 'Tidak ada perubahan data TPS!';
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function set_warga()
    {
        $id_tps = $this->input->post('id_tps');
        $id_penduduk_1 = $this->input->post('id_penduduk_1');
        $id_penduduk_2 = $this->input->post('id_penduduk_2');


        if ($id_penduduk_1 || $id_penduduk_2) {

            $in = [];
            $in2 = [];

            $update_1 = 1;
            $update_2 = 1;
            $tabel = '<table class="sweet">';

            if ($id_penduduk_1) {
                $no = 0;
                $d = [];
                $tabel .= '<tr><th>Penduduk di hapus</th></tr>';
                foreach ($id_penduduk_1 as $value) {
                    $num = $no++;
                    $in[$num]['id_penduduk'] = $value;
                    $in[$num]['id_tps'] = null;
                    $d[] = $value;
                }
                $update_1 = $this->action_m->update_batch('penduduk', $in, 'id_penduduk');
                $rel_insert = $this->action_m->get_all('penduduk', ['id_penduduk' => $d]);

                if ($rel_insert) {
                    foreach ($rel_insert as $val) {
                        $tabel .= '<tr>';
                        $tabel .= '<td>' . $val->nama . '</td>';
                        $tabel .= '</tr>';
                    }
                }
            }

            if ($id_penduduk_2) {
                $noo = 0;
                $d = [];
                $tabel .= '<tr><th>Penduduk di tambahkan</th></tr>';
                foreach ($id_penduduk_2 as $value) {
                    $numm = $noo++;
                    $in2[$numm]['id_penduduk'] = $value;
                    $in2[$numm]['id_tps'] = $id_tps;
                    $d[] = $value;
                }
                $update_2 = $this->action_m->update_batch('penduduk', $in2, 'id_penduduk');
                $rel_insert_2 = $this->action_m->get_all('penduduk', ['id_penduduk' => $d]);

                if ($rel_insert_2) {
                    foreach ($rel_insert_2 as $val) {
                        $tabel .= '<tr>';
                        $tabel .= '<td>' . $val->nama . '</td>';
                        $tabel .= '</tr>';
                    }
                }
            }


            if ($update_1 && $update_2) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil mengatur penduduk! </br></br>' . $tabel;
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/tps #reload_table');
                $data['modal']['id'] = '#kt_modal_tambah_warga';
                $data['modal']['action'] = 'hide';
            } else {
                $data['status'] = 700;
                $data['alert']['message'] = 'Gagal mengatur penduduk! Coba lagi nanti atau laporkan';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Tidak ada data penduduk yang di pilih!';
        }

        $data['penduduk_1'] = $update_1;
        $data['penduduk_2'] = $update_2;
        echo json_encode($data);
        exit;
    }
}
