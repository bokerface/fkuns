<?php defined('BASEPATH') or exit('No direct script access allowed');
class Users extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user_model');
		$this->load->model('profile/profile_model', 'profile_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index($role = 0)
	{
		// periksa kategori
		$role = ($role != '') ? $role : '';
 
		$data['role'] = $role;
		$data['users'] = $this->user_model->get_users($role);
		$data['count_all'] = $this->user_model->count_all_users_by_role('');
		$data['count_admin'] = $this->user_model->count_all_users_by_role(4);
		$data['count_dp'] = $this->user_model->count_all_users_by_role(2);
		$data['count_residen'] = $this->user_model->count_all_users_by_role(3); 
		$data['view'] = 'admin/users/user_list';

		$this->load->view('layout/layout', $data);
	}



	public function add()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
		//	$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		//	$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			//$this->form_validation->set_rules('role', 'Role', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/users/user_add';
				$this->load->view('layout/layout', $data);
			} else {
				/*
				$upload_path = './uploads/fotoProfil';

				if (!is_dir($upload_path)) {
					mkdir($upload_path, 0777, TRUE);
				}
				
				$config = array(
					'upload_path' => $upload_path,
					'allowed_types' => "jpg|png|jpeg",
					'overwrite' => FALSE,
				);

				$this->load->library('upload', $config);
				$this->upload->do_upload('foto_profil');
				$foto_profil = $this->upload->data();
				*/
				$data = array(
					'username' => $this->input->post('username'),
				//	'firstname' => $this->input->post('firstname'),
					'email' => $this->input->post('email'),
				//	'mobile_no' => $this->input->post('mobile_no'),
				//	'id_prodi' => $this->input->post('id_prodi'),
					'role' => $this->input->post('role'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),			
				//	'photo' => $upload_path . '/' . $foto_profil['file_name'],
				);

				$data = $this->security->xss_clean($data);
				$result = $this->user_model->add_user($data);
				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil ditambahkan!');
					redirect(base_url('admin/users'));
				}
			}
		} else {
			// $data['prodi'] = $this->prodi_model->get_all_prodi();
			$data['view'] = 'admin/users/user_add';
			$this->load->view('layout/layout', $data);
		}
	}

	public function edit($id = 0)
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
		//	$this->form_validation->set_rules('firstname', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		//	$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->user_model->get_user_by_id($id);
				$data['view'] = 'admin/users/user_edit';
				$this->load->view('layout/layout', $data);
			} else {

				/*$upload_path = './uploads/fotoProfil';

				if (!is_dir($upload_path)) {
					mkdir($upload_path, 0777, TRUE);
				}

				$config = array(
					'upload_path' => $upload_path,
					'allowed_types' => "jpg|png|jpeg",
					'overwrite' => FALSE,
				);

				$this->load->library('upload', $config);
				$this->upload->do_upload('foto_profil');
				$foto_profil = $this->upload->data();
				*/
				$data = array(
					'username' => $this->input->post('username'),
				//	'firstname' => $this->input->post('firstname'),
					'email' => $this->input->post('email'),
				//	'mobile_no' => $this->input->post('mobile_no'),
					'password' => ($this->input->post('password') !== "" ? password_hash($this->input->post('password'), PASSWORD_BCRYPT) : $this->input->post('password_hidden')),
					'updated_at' => date('Y-m-d : h:m:s'),
				//	'photo' => ($foto_profil['file_name']) !== "" ? $upload_path . '/' . $foto_profil['file_name'] : $this->input->post('foto_profil_hidden'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);

				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil diubah!');
					redirect(base_url('admin/users'));
				}
			}
		} else {
			$data['user'] = $this->user_model->get_user_by_id($id);
			$data['view'] = 'admin/users/user_edit';
			$this->load->view('layout/layout', $data);
		}
	}

	public function detail($id = 0)
	{
		$data['user'] = $this->user_model->get_user_by_id($id);

		$data['view'] = 'admin/users/detail';
		$this->load->view('layout/layout', $data);
	}

	public function del($id)
	{
		$this->db->delete('ci_users', array('id' => $id));
		$this->session->set_flashdata('msg', 'Pengguna berhasil dihapus!');
		redirect(base_url('admin/users'));
	}
}
