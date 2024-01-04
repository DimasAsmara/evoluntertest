<?php  
class Linker{
	var $CI;
    var $base_link = "";
    var $base_url = "";
    var $appath_url = "";
    var $id_sekolah = "";
    public function __construct()
	{
        $this->CI = & get_instance();

        $this->base_link = 'https://lmssma.alphatechin.id/data/';
        $this->base_url = base_url();
        $this->appath_url = APPPATH.'../../data/';
        $this->id_sekolah = $this->CI->session->userdata('lms_id_sekolah_siswa');
    }
    public function img_default($gambar){
        $link = $this->base_link.'default/'.$gambar;
        return $link;
    }
    public function img_splash($gambar){
        $link = $this->base_link.'splash/'.$gambar;
        return $link;
    }
    public function img_banner($gambar){
        $link = $this->base_link.'sekolah_'.$this->id_sekolah.'/banner/'.$gambar;
        return $link;
    }
    public function img_siswa($gambar){
        $link = $this->base_link.'sekolah_'.$this->id_sekolah.'/siswa/'.$gambar;
        return $link;
    }
    public function img_konten($gambar,$date){
        $dt = date_create($date);
        $tahun = date_format($dt,"Y");
        $bulan = date_format($dt,"m");
        $link = $this->base_link.'sekolah_'.$this->id_sekolah.'/konten/'.$tahun.'/'.$bulan.'/'.$gambar;
        return $link;
    }
    public function url_materi($type, $path)
    {
        $data = $this->base_link.'sekolah_'.$this->id_sekolah.'/materi/'.$type.'/'.$path;
        return $data;
    }



    // APPATH
    public function appath_img_siswa($gambar)
    {
        $data = $this->appath_url.'sekolah_'.$this->id_sekolah.'/siswa/'.$gambar;
        return $data;
    }
    public function appath_img_banner($gambar)
    {
        $data = $this->appath_url.'sekolah_'.$this->id_sekolah.'/banner/'.$gambar;
        return $data;
    }
    public function appath_materi($type, $path)
    {
        $data = $this->appath_url.'sekolah_'.$this->id_sekolah.'/materi/'.$type.'/'.$path;
        return $data;
    }
    public function appath_konten($gambar,$date)
    {
        $dt = date_create($date);
        $tahun = date_format($dt,"Y");
        $bulan = date_format($dt,"m");
        $link = $this->appath_url.'sekolah_'.$this->id_sekolah.'/konten/'.$tahun.'/'.$bulan.'/'.$gambar;
        return $link;
    }
}
?>