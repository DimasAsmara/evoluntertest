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

        // LOAD JS
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/modul/import/import.js"></script>';

        // RENDER DATA
        $kelurahan = $this->action_m->get_all('kelurahan', ['id_intansi' => $this->id_intansi]);

        // LOAD MYDATA
        $mydata['kelurahan'] = $kelurahan;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }
}
