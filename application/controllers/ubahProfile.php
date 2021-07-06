<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ubahProfile extends CI_Controller
{
    public function __construct()
    {
        //memanggil method kosntrukter di CI Controller
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->session->login['level'] != 'kasir' && $this->session->login['level'] != 'admin') redirect();
		$this->data['aktif'] = 'kasir';
		$this->load->model('M_user', 'm_user');
      
    }
    public function index(){
		$this->data['title'] = 'Ubah Profile';
        $this->data['no'] = 1;

		$this->load->view('ubahProfile', $this->data);
	}
    
    public function ubahProfile(){
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('login')['username']])->row_array();

        $this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[15]');
        $this->form_validation->set_rules('nama','Nama','trim|required|min_length[2]|max_length[15]');

        if($this->form_validation->run()==false){
            $this->data['title'] = 'Ubah Profile';
            $this->load->view('ubahProfile',$this->data);
        }else{
            $username = $this->input->post('username');
            $nama = $this->input->post('nama');

            $this->session->set_userdata('username',$username);
            $this->session->set_userdata('nama',$nama);

            $this->db->set('username',$username);
            $this->db->set('nama',$nama);
            $this->db->where('username', $this->session->userdata('login')['username']);
            $this->db->update('user');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Profile berhasil di ubah. Silahkan Login Kembali
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('logout');
        }
    }
}