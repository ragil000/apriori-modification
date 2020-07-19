<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangModel extends CI_Model {

	public function _getDataBarang() {
        return $this->db->get('table_barang')->result_array();
    }
    
    public function _setLogin() {
        $post=$this->input->post();
        $result=$this->db->get_where('table_user',['user_name' => $post['user_name'],'user_password' =>md5($post['user_password'])])->result_array();
        $cek=$this->db->get_where('table_user',['user_name' => $post['user_name'],'user_password' =>md5($post['user_password'])])->num_rows();
        if ($cek > 0){
            $data = [
                'user_id' => $result[0]['user_id'],
                'user_fullname' => $result[0]['user_fullname']
            ];
            $this->session->set_userdata($data);
            return true;
        }else 
        {
            return false;
        }
        
    }

    public function _getDataBarangKeluar() {
        $this->db->join('table_barang', 'table_barang.barang_id = table_keluar.barang_id');
        $this->db->order_by('table_keluar.keluar_tanggal', 'DESC');
        return $this->db->get('table_keluar')->result_array();
    }
    
    public function _postDataBarangKeluar($post) {
        $data = [
            'barang_id' => $post['barang_id'],
            'keluar_tanggal' => $post['keluar_tanggal'],
            'keluar_jumlah' => $post['keluar_jumlah']
        ];

        $this->db->insert('table_keluar', $data);
        return $this->db->affected_rows();
    }

    public function _editDataBarangKeluar($post) {
        $data = [
            'barang_id' => $post['barang_id'],
            'keluar_tanggal' => $post['keluar_tanggal'],
            'keluar_jumlah' => $post['keluar_jumlah']
        ];

        $this->db->update('table_keluar', $data, ['keluar_id' => $post['keluar_id']]);
        return $this->db->affected_rows();
    }
    
    public function _postDataBarang($post) {
        $data = [
            'barang_nama' => $post['barang_nama'],
            'barang_kategori' => $post['barang_kategori'],
        ];

        $this->db->insert('table_barang', $data);
        return $this->db->affected_rows();
    }

    public function _editDataBarang($post) {
        $data = [
            'barang_nama' => $post['barang_nama'],
            'barang_kategori' => $post['barang_kategori'],
        ];

        $this->db->update('table_barang', $data, ['barang_id' => $post['barang_id']]);
        return $this->db->affected_rows();
    }
    
    public function _getTotalDataBarang() {
        $count = $this->db->get('table_barang')->num_rows();
        return $count;
    }

    public function _deleteDataBarangKeluar($keluar_id) {

        $this->db->delete('table_keluar', ['keluar_id' => $keluar_id]);
        return $this->db->affected_rows();
    }
    
    public function _deleteDataBarang($barang_id) {

        $this->db->delete('table_barang', ['barang_id' => $barang_id]);
        return $this->db->affected_rows();
	}
}
