<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ubahpassword extends CI_Controller
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
		$this->data['title'] = 'Ubah Password';
        $this->data['no'] = 1;

		$this->load->view('ubahpassword', $this->data);
	}

    public function changepassword(){
       
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('login')['username']])->row_array();
    
            $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('new_password1', 'New  Password', 'required|trim|min_length[3]|matches[new_password2]');
            $this->form_validation->set_rules('new_password2', ' Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
    
            if ($this->form_validation->run() == false) {
                $this->data['title'] = 'Ubah Password';
                $this->data['no'] = 1;
                $this->load->view('ubahpassword', $this->data);
            } else {
                $current_password = $this->input->post('current_password');
                $new_password =  $this->input->post('new_password1');

                if ($data['user']['password'] != md5($current_password)) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Password Lama Salah !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                    );
                    redirect('ubahpassword');
                } else {
                    if ($current_password == $new_password) {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                               Password Lama tidak boleh sama dengan Password Baru!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        );
                        redirect('ubahpassword');
                    } else {
                        
                        $password_hash = md5($new_password);
                        $this->db->set('password', $password_hash);
                        $this->db->where('username', $this->session->userdata('login')['username']);
                        $this->db->update('user');
    
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              Password berhasil di ubah. Silahkan Login Kembali!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        );
                        redirect('logout');
                    }
                }
            }
        }
}