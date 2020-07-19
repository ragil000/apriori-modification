<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangController extends CI_Controller {

    public function __construct() {
            parent::__construct();
            
            $this->load->model('BarangModel');
            $this->load->model('LibraryRMYModel');
    }

    public function login() {
        $this->load->view('template/login');

    }

    public function getDataById($id) {
        $result = $this->db->get_where('table_barang', ['barang_id' => $id])->result_array();
        echo json_encode($result);
    }

    public function getDataKeluarById($id) {
                  $this->db->join('table_barang tb', 'tb.barang_id=tk.barang_id');
        $result = $this->db->get_where('table_keluar tk', ['keluar_id' => $id])->result_array();
        echo json_encode($result);
    }

    public function setLogin() {
        $cek=$this->BarangModel->_setLogin();
        if ($cek){
            redirect("admin/data-barang");
        }else {
            redirect("admin/login");
        }
    }

    public function setLogout(){
        $data = array('user_id', 'user_fullname');
            
        $this->session->unset_userdata($data);
        redirect("admin/login");
    }

	public function index() {

        if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{

            $data['result'] = $this->BarangModel->_getDataBarang();
            $data['TotalDataBarang'] = $this->BarangModel->_getTotalDataBarang();

            $this->load->view('template/header', $data);
            $this->load->view('content/data-barang');
            $this->load->view('template/footer');

        }
    }
    
    public function barangKeluar() {

        
        if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{
                
            $data['resultBarang'] = $this->BarangModel->_getDataBarang();
            $data['result'] = $this->BarangModel->_getDataBarangKeluar();
            $data['TotalDataBarang'] = $this->BarangModel->_getTotalDataBarang();

            $this->load->view('template/header', $data);
            $this->load->view('content/data-barang-keluar');
            $this->load->view('template/footer');
        }
    }
    
    public function postDataBarangKeluar(){
        
        if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{
                
            $post = $this->input->post();

            $data['result'] = $this->BarangModel->_postDataBarangKeluar($post);

            if($data['result'] > 0){
                redirect(base_url().'/admin/barang-keluar');

            }
        }
    }

    public function editDataBarangKeluar(){
        
        if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{
                
            $post = $this->input->post();

            $data['result'] = $this->BarangModel->_editDataBarangKeluar($post);

            if($data['result'] > 0){
                redirect(base_url().'/admin/barang-keluar');

            }
        }
    }

    public function postDataBarang(){
        
        if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{
                
            $post = $this->input->post();

            $data['result'] = $this->BarangModel->_postDataBarang($post);

            if($data['result'] > 0){
                redirect(base_url().'/admin/data-barang');

            }
        }
    }

    public function editDataBarang(){
        
        if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{
                
            $post = $this->input->post();

            $data['result'] = $this->BarangModel->_editDataBarang($post);

            if($data['result'] > 0){
                redirect(base_url().'/admin/data-barang');

            }
        }
    }


    public function deleteDataBarangKeluar($keluar_id){
        
        if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{

            $data['result'] = $this->BarangModel->_deleteDataBarangKeluar($keluar_id);

            if($data['result'] > 0){
                redirect(base_url().'/admin/barang-keluar');

            }    
        }
    }

    public function deleteDataBarang($barang_id){

        if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{

            $data['result'] = $this->BarangModel->_deleteDataBarang($barang_id);

            if($data['result'] > 0){
                redirect(base_url().'/admin/data-barang');
        
            }
        }
    }

}
