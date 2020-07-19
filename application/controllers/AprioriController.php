<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AprioriController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('AprioriModel');
		$this->load->model('BarangModel');
		$this->load->model('LibraryRMYModel');

	}

	public function index($range = 1) {
		if(!isset($_SESSION['user_id'])){
            redirect("admin/login");
        }else{
                
            $data['resultBarang'] = $this->BarangModel->_getDataBarang();
            $data['result'] = $this->_getApriori($range);
            $data['TotalDataBarang'] = $this->BarangModel->_getTotalDataBarang();

            $this->load->view('template/header', $data);
            $this->load->view('content/data-barang-terlaku');
            $this->load->view('template/footer');
        }
	}

	private function _getApriori($range = 1){
		$aprioriData = $this->AprioriModel->_getApriori($range);
		usort($aprioriData, function($a, $b) {
			return $b['support'] - $a['support'];
		});
		return $aprioriData;
	}

}
