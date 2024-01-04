<?php defined('BASEPATH') or exit('No direct script access allowed');



/**

 * CodeIgniter-HMVC

 *

 * @package    CodeIgniter-HMVC

 * @author     N3Cr0N (N3Cr0N@list.ru)

 * @copyright  2019 N3Cr0N

 * @license    https://opensource.org/licenses/MIT  MIT License

 * @link       <URI> (description)

 * @version    GIT: $Id$

 * @since      Version 0.0.1

 * @filesource

 *

 */


class MY_Controller extends MX_Controller

{

    //

    public $CI;



    /**

     * An array of variables to be passed through to the

     * view, layout,....

     */

    protected $data = array();



    /**

     * [__construct description]

     *

     * @method __construct

     */

    public function __construct()

    {



        parent::__construct();



        // This function returns the main CodeIgniter object.

        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.

        $CI = &get_instance();



        // Copyright year calculation for the footer

        $begin = 2019;

        $end =  date("Y");

        $date = "$begin - $end";



        // Copyright

        $this->data['copyright'] = $date;
    }



    function __nocache()
    {

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');

        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);

        $this->output->set_header('Pragma: no-cache');
    }
}



class MY_Frontend extends MY_Controller
{


    var $path_theme = '';
    public function __construct()
    {

        parent::__construct();

        $this->path_theme = 'main_frontend';
    }



    function display($name = '')
    {



        $tpl = $this->path_theme . '/layout_single';



        $this->load->view($tpl, $this->data);
    }
}

class MY_Admin extends MY_Controller
{


    var $path_theme = '';
    public function __construct()
    {

        parent::__construct();

        $this->path_theme = 'main_admin';
        if (!$this->session->userdata('vol_id_user')) {
            redirect('auth');
        }
        if ($this->session->userdata('vol_akses') == 'apk') {
            redirect('mobile');
        }
    }



    function display($name = '')
    {



        $tpl = $this->path_theme . '/layout_single';



        $this->load->view($tpl, $this->data);
    }
}

class MY_Mobile extends MY_Controller
{


    var $path_theme = '';
    public function __construct()
    {

        parent::__construct();

        $this->path_theme = 'mobile_themes';
        if (!$this->session->userdata('vol_id_user')) {
            redirect('auth');
        }
        if ($this->session->userdata('vol_akses') == 'web') {
            redirect('dashboard');
        }
    }



    function display($name = '')
    {



        $tpl = $this->path_theme . '/layout_single';



        $this->load->view($tpl, $this->data);
    }
}
// Backend controller

require_once(APPPATH . 'core/Backend_Controller.php');



// Frontend controller

require_once(APPPATH . 'core/Frontend_Controller.php');
