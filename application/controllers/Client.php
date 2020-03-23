<?php
Class Client extends CI_Controller{
    
    private $_client;
    function __construct() {
        parent::__construct();
    }
    
    // menampilkan data mahasiswa
    function index(){
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', 'http://localhost/rest_ci/api');
        $data['data'] = json_decode($response->getBody()->getContents());
        $this->load->view('crud/list',$data);
    }
    public function add()
    {
        $this->load->view('crud/add');
    }
    // insert data mahasiswa
    function create(){
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('POST', 'http://localhost/rest_ci/api',[
            'form_params' => [
                'NO'=>$this->input->post('NO'),
                'NIM'=>$this->input->post('NIM'),
                'NAMA'=>$this->input->post('NAMA'),
                'ASAL'=>$this->input->post('ASAL')
            ]
        ]);
        // echo $response->getBody()->getContents();
        return redirect(base_url('client'),'refresh');
    }
    
    // edit data mahasiswa
    function edit($id){
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', 'http://localhost/rest_ci/api',[
            'query' => [
                'NO'=>$id
            ]
        ]);
        $data['data'] = json_decode($response->getBody()->getContents())[0];

        $this->load->view('crud/edit',$data);
    }
    
    public function update()
    {
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('PUT', 'http://localhost/rest_ci/api',[
            'json' => [
                'NO'=>$this->input->post('NO'),
                'NIM'=>$this->input->post('NIM'),
                'NAMA'=>$this->input->post('NAMA'),
                'ASAL'=>$this->input->post('ASAL'),
            ]
        ]);
        // echo $response->getBody()->getContents();
        return redirect(base_url('client'),'refresh');
    }
    
    // delete data mahasiswa
    function delete($id){
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('DELETE', 'http://localhost/rest_ci/api',[
            'form_params' => [
                'NO'=>$id,
            ]
        ]);
        // echo $response->getBody()->getContents();
        return redirect(base_url('client'),'refresh');
    }
}