<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;
class Api extends RestController {

	function __construct()
    {
        // Construct the parent class
        parent:: __construct();
	}
	public function index_get(){
		// testing response
		$NO = $this->get('NO');
        if ($NO == '') {
            $kontak = $this->db->get('daftar_mahasiswa_unisbank')->result();
        } else {
            $this->db->where('NO', $NO);
            $kontak = $this->db->get('daftar_mahasiswa_unisbank')->result();
        }
        $this->response($kontak, 200);
    }
    
    public function index_post()
    {
        $data = array(
            'NO'  => $this->post('NO'),
            'NIM'  => $this->post('NIM'),
            'NAMA'   => $this->post('NAMA'),
            'ASAL' => $this->post('ASAL')
        );
        $insert = $this->db->insert('daftar_mahasiswa_unisbank', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    public function index_put() {
        $NO = $this->put('NO');
        $data = array(
            'NO'  => $this->put('NO'),
            'NIM'  => $this->put('NIM'),
            'NAMA'   => $this->put('NAMA'),
            'ASAL' => $this->put('ASAL')
        );
        $this->db->where('NO', $NO);
        $update = $this->db->update('daftar_mahasiswa_unisbank', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    public function index_delete() {
        $id = $this->delete('NO');
        
        $this->db->where('NO', $id);
        $delete = $this->db->delete('daftar_mahasiswa_unisbank');
        if ($delete) {
            $this->response(array('status' => 'success'.$id), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
