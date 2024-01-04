<?php  
class Count{
	var $CI;
    var $base_url = "";
    public function __construct()
	{
        $this->CI = & get_instance();
        $this->base_url = base_url();
    }
    public function tbl($tabel_name,$where=array()){
        $this->CI->db->select("*");
        $this->CI->db->from($tabel_name);
        foreach ($where as $row => $value) {
            if (is_array($value)) {
                $this->CI->db->where_in($row, $value);
            }else{
                $this->CI->db->where($row,$value);
            }
        }
        $data = $this->CI->db->get()->num_rows();
        return $data;
    }
}
?>