<?php defined('BASEPATH') or exit('No direct script access allowed');
class Ilmiah extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ilmiah_model', 'ilmiah_model');
	}

	public function index()
	{
		$query = $this->db->query("SELECT i.id, i.judul_ilmiah, i.date, k.kategori, rt.tahap, r.nama_lengkap FROM ilmiah i
		LEFT JOIN kategori_ilmiah k ON k.id=i.id_kategori		
		LEFT JOIN residen r ON r.id=i.id_residen		
		LEFT JOIN residen_tahap rt ON rt.id=i.id_tahap		
		");
		$result = $query->result_array();

		$data['query'] = $result;
		$data['id_menu'] = "ilmiah";
		$data['class_menu'] = "index";
		$data['title'] = 'Ilmiah';
		//$data['deskripsi'] = 'Tampilkan semua ilmiah dari semua residen. dan semua tahap';
		$data['view'] = 'ilmiah/index.php';
		$this->load->view('layout/layout', $data);
	}

	public function myIlmiah($id, $tahap)
	{
		$query2 = $this->db->query("SELECT id FROM tahap WHERE tahap = " . $tahap);
		$result2 = $query2->row();
		$id_tahap = $result2->id;

		$query = $this->db->query("SELECT * FROM ilmiah WHERE id_residen = 
		(SELECT id FROM residen WHERE user_id =" . $id . ") AND id_tahap = " . $id_tahap);
		$result = $query->result_array();
		$jumlahdoc = $query->num_rows();

		$query3 = $this->db->query("SELECT kategori FROM kategori_ilmiah WHERE tahap = " . $tahap);
		$jumlahkategory = $query3->num_rows();

		$progress = $jumlahdoc / $jumlahkategory * 100;
		$formattedprogress = number_format($progress, 2);

		// echo "progress = ".$progress;

		$data['progress'] = $formattedprogress;
		$data['query'] = $result;
		$data['id_menu'] = 'ilmiah';
		$data['class_menu'] = 'tahap' . $tahap;
		$data['title'] = 'Ilmiah Tahap ' . $tahap;
		$data['view'] = 'ilmiah/myIlmiah.php';
		$this->load->view('layout/layout', $data);
	}

	public function tahap($tahap)
	{
		$query = $this->db->query("SELECT i.id, i.judul_ilmiah, i.date, k.kategori, rt.tahap, r.nama_lengkap FROM ilmiah i
		LEFT JOIN kategori_ilmiah k ON k.id=i.id_kategori		
		LEFT JOIN residen r ON r.id=i.id_residen		
		LEFT JOIN residen_tahap rt ON rt.id=i.id_tahap	
		WHERE i.id_tahap=$tahap");
		$result = $query->result_array();

		$data['query'] = $result;
		$data['id_menu'] = "ilmiah";
		$data['class_menu'] = "tahap" . $tahap;
		$data['tahap'] = $tahap;
		$data['title'] = 'Ilmiah Tahap ' . $tahap;
		//$data['deskripsi'] = 'Tampilkan semua ilmiah dari semua residen berdasarkan tahap';
		$data['view'] = 'ilmiah/tahap.php';
		$this->load->view('layout/layout', $data);
	}

	public function divisi()
	{
		$query = $this->db->query("SELECT i.id, i.judul_ilmiah, i.date, k.kategori, rt.tahap, r.nama_lengkap FROM ilmiah i
		LEFT JOIN kategori_ilmiah k ON k.id=i.id_kategori		
		LEFT JOIN residen r ON r.id=i.id_residen		
		LEFT JOIN residen_tahap rt ON rt.id=i.id_tahap	
		WHERE (rt.tahap='2a' OR rt.tahap='2b')
		");
		$result = $query->result_array();

		$data['query'] = $result;
		$data['id_menu'] = "ilmiah";
		$data['class_menu'] = "divisi";
		$data['title'] = 'Ilmiah Semua Divisi ';
		$data['deskripsi'] = 'Tampilkan semua ilmiah dari semua residen berdasarkan Divisi. Yg tampil hanya tahap 2a dan 2b saja';
		$data['view'] = 'ilmiah/index.php';
		$this->load->view('layout/layout', $data);
	}

	public function detail($id_ilmiah)
	{
		$query1 = $this->db->query("SELECT nama_lengkap FROM residen WHERE id = (SELECT id_residen FROM ilmiah WHERE id =" . $id_ilmiah . ")");
		$result1 = $query1->row();
		$author = $result1->nama_lengkap;

		$query2 = $this->db->query("SELECT * FROM ilmiah WHERE id = " . $id_ilmiah);
		$result2 = $query2->result_array();

		$data['query'] = $result2;
		$data['author'] = $author;
		$data['view'] = 'ilmiah/detail.php';
		$this->load->view('layout/layout', $data);
	}

	public function add($tahap)
	{
		if ($tahap == '2a' or $tahap == '2b') {
			$tahap = 2;
		}

		$query = $this->db->get_where('kategori_ilmiah', array('tahap' => $tahap));
		$result = $query->result_array();

		$data['query'] = $result;
		$data['view'] = 'ilmiah/tambah.php';
		$this->load->view('layout/layout', $data);
	}

	public function store($tahap)
	{
		$userId = $_SESSION['user_id'];

		$query = $this->db->get_where('residen', array('user_id' => $userId));
		$result = $query->row();
		$idResiden = $result->id;

		$query2 = $this->db->get_where('tahap', array('tahap' => $tahap));
		$result = $query2->row();
		$idTahap = $result->id;

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('judul_ilmiah', 'Judul Ilmiah', 'trim|required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'ilmiah/tambah.php';
				$this->load->view('layout/layout', $data);
			} else {
				$upload_path = './uploads/dokumen';

				if (!is_dir($upload_path)) {
					mkdir($upload_path, 0777, TRUE);
				}

				$config = array(
					'upload_path' => $upload_path,
					'allowed_types' => "pdf",
					'overwrite' => FALSE,
				);

				$this->load->library('upload', $config);
				$this->upload->do_upload('file');
				$file = $this->upload->data();

				$data = array(
					'judul_ilmiah' => $this->input->post('judul_ilmiah'),
					'deskripsi' => $this->input->post('deskripsi'),
					'file' => $this->input->post('file'),
					'id_residen' => $idResiden,
					'id_tahap' => $idTahap,
					'id_kategori' => $this->input->post('kategori'),
					'file' => $upload_path . '/' . $file['file_name'],
				);

				$data = $this->security->xss_clean($data);
				$result = $this->ilmiah_model->add_ilmiah($data);
				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil ditambahkan!');
					redirect(base_url('residen/ilmiah/index'));
				}
			}
		} else {
			$data['view'] = 'ilmiah/tambah.php';
			$this->load->view('layout/layout', $data);
		}
	}
}
