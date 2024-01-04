<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Frontend
{
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('vol_id_user')) {
            redirect('dashboard');
        }
        $tab = $this->input->get('tab');

        // GLOBAL VARIABEL
        $this->data['title'] = 'Login Admin';

        // LOAD JS
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/auth/login.js"></script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/auth/register.js"></script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/auth/forgot.js"></script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/auth/mekanikal.js"></script>';

        // LOAD VARIABEL
        $mydata['tab'] = '';
        if ($tab) {
            $mydata['tab'] = $tab;
        }
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }


    //  FUNCTION 
    public function login_proses()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $email = strtolower($email);
        if (!$_POST) {
            redirect('auth');
        }
        if (!$email || !$password) {
            $data['status'] = 700;
            $data['message'] = 'Tidak ada data terdeteksi! Silahkan cek dan coba lagi.';
            echo json_encode($data);
            exit;
        }
        if (!validasi_email($email)) {
            $data['status'] = 700;
            $data['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
            echo json_encode($data);
            exit;
        }

        $result = $this->action_m->get_single('user', ['email' => $email]);
        if ($result) {
            if ($result->block == 'Y') {
                if ($result->block_reason) {
                    $reason = ' dengan alasan </br></br><b>' . $result->block_reason . '!</b></br></br>';
                } else {
                    $reason = '!';
                }
                $data['status'] = 700;
                $data['message'] = 'Anda telah di blockir' . $reason . ' Anda tidak bisa melakukan akses pada sistem. Hubungi admin jika terjadi kesalahan';
                echo json_encode($data);
                exit;
            }
            if ($result->password == hash_my_password($email . $password)) {

                $arrSession['vol_id_user'] = $result->id_user;
                $arrSession['vol_id_intansi'] = $result->id_intansi;
                $arrSession['vol_nama'] = $result->nama;
                $arrSession['vol_email'] = $result->email;
                $arrSession['vol_id_role'] = $result->role;
                $arrSession['vol_notelp'] = $result->notelp;
                $arrSession['vol_role'] = get_role($result->role);
                $arrSession['vol_foto'] = $result->foto;
                if ($this->input->get('fcm_key')) {
                    $arrSession['vol_akses'] = 'apk';
                } else {
                    $arrSession['vol_akses'] = 'web';
                }


                $this->session->set_userdata($arrSession);

                $data['status'] = 200;
                $data['message'] = 'Data sesuai! Selamat datang ' . get_role($result->role) . ' ' . $result->nama;
                if ($this->input->get('fcm_key')) {
                    $data['redirect'] = base_url('mobile');
                } else {
                    $data['redirect'] = base_url('dashboard');
                }
            } else {
                $data['status'] = 500;
                $data['message'] = 'Kata sandi salah! Silahkan cek dan coba lagi.';
            }
        } else {
            $data['status'] = 500;
            $data['message'] = 'Email tidak terdaftar! Silahkan cek dan coba lagi.';
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function regis_proses()
    {
        $email      = $this->input->post('email');
        $email      = strtolower($email);
        $kode      = $this->input->post('kode');
        $password   = $this->input->post('password');
        $repassword   = $this->input->post('repassword');

        // PERIKSA URL
        if (!$_POST) {
            redirect('auth');
        }
        // PERIKSA INPUT
        if (!$email || !$kode || !$password || !$repassword) {
            $data['status'] = 500;
            $data['message'] = 'Data tidak terdeteksi! Silahkan cek ulang data yang anda masukan';
            echo json_encode($data);
            exit;
        }
        if (!validasi_email($email)) {
            $data['status'] = 700;
            $data['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
            echo json_encode($data);
            exit;
        }
        if ($password != $repassword) {
            $data['status'] = 500;
            $data['message'] = 'Konfirmasi kata sandi salah!';
            echo json_encode($data);
            exit;
        }

        // CEK KODE INTANSI
        $cek_kode = $this->action_m->get_single('intansi', ['kode' => $kode]);
        if (!$cek_kode) {
            $data['status'] = 500;
            $data['message'] = 'Kode relawan tidak valid! Silahkan periksa ulang kode relawan';
            echo json_encode($data);
            exit;
        }
        if ($cek_kode->member >= $cek_kode->kuota) {
            $data['status'] = 500;
            $data['message'] = 'Batas kuota relawan telah terpenuhi! Hubungi admin relawan jika terjadi kesalahan';
            echo json_encode($data);
            exit;
        }

        // CEK USER
        $result = $this->action_m->get_single('user', ['email' => $email]);
        if ($result) {
            $data['status'] = 500;
            $data['message'] = 'Email yang anda masukan sudah terdaftar!';
            echo json_encode($data);
            exit;
        }

        $arrInsert['email'] = $email;
        $arrInsert['password'] = hash_my_password($email . $password);
        $arrInsert['id_intansi'] = $cek_kode->id_intansi;
        $insert = $this->action_m->insert('user', $arrInsert);

        if ($insert) {
            $jmlh = $this->action_m->get_all('user', ['block' => 'N']);
            $arrUpdate['member'] = count($jmlh);
            $update = $this->action_m->update('intansi', $arrUpdate);
            if ($update) {
                $arrSession['vol_id_user'] = $insert;
                $arrSession['vol_id_intansi'] = $cek_kode->id_intansi;
                $arrSession['vol_email'] = $email;
                $arrSession['vol_nama'] = '';
                $arrSession['vol_notelp'] = '';
                $arrSession['vol_id_role'] = 1;
                $arrSession['vol_role'] = get_role(1);
                $arrSession['vol_foto'] = '';
                if ($this->input->get('fcm_key')) {
                    $arrSession['vol_akses'] = 'apk';
                } else {
                    $arrSession['vol_akses'] = 'web';
                }


                $this->session->set_userdata($arrSession);

                $data['status'] = 200;
                $data['message'] = 'Anda berhasil mendaftar! Selamat datang relawan';
                if ($this->input->get('fcm_key')) {
                    $data['redirect'] = base_url('mobile');
                } else {
                    $data['redirect'] = base_url('dashboard');
                }
            } else {
                $data['status'] = 700;
                $data['message'] = 'Gagal merubah data! silahkan cek data atau coba lagi nanti';
            }
        } else {
            $data['status'] = 700;
            $data['message'] = 'Gagal menambah data! silahkan cek data atau coba lagi nanti';
        }
        echo json_encode($data);
        exit;
    }

    public function forgot_proses()
    {
        $email      = $this->input->post('email');

        // CEK URL
        if (!$_POST) {
            redirect('auth');
        }
        if (!$email) {
            $data['status'] = 700;
            $data['message'] = 'Email tidak boleh kosong';
            echo json_encode($data);
            exit;
        }
        if (!validasi_email($email)) {
            $data['status'] = 700;
            $data['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
            echo json_encode($data);
            exit;
        }

        $result = $this->action_m->get_single('user', ['email' => $email]);
        if ($result) {
            $data['status'] = 200;
            $data['message'] = 'Kami telah mengirimkan email pada akun ' . $email . '. Silahkan cek email anda </br></br><b>Nb : Cek folder spam jika email tidak terkirim</b>';
        } else {
            $data['status'] = 500;
            $data['message'] = 'Email tidak terdaftar! Silahkan cek dan coba lagi.';
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }


    public function logout()
    {
        $this->session->unset_userdata('vol_id_user');
        $this->session->unset_userdata('vol_id_intansi');
        $this->session->unset_userdata('vol_nama');
        $this->session->unset_userdata('vol_id_role');
        $this->session->unset_userdata('vol_role');
        $this->session->unset_userdata('vol_notelp');
        $this->session->unset_userdata('vol_foto');
        $this->session->unset_userdata('vol_email');

        if ($this->input->get('mobile') == true) {
            redirect('auth?fcm_key=1');
        } else {
            redirect('auth');
        }
    }
}
