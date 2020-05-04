<?php
class Kriteria extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('m_kriteria');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['kriteria'] = $this->m_kriteria->get_kriteria();
		$this->load->view('include/navbar');
		$this->load->view('kriteria/index', $data);
		$this->load->view('include/footer');
	}

	function input_error()
	{
		$json['status'] = 0;
		$json['pesan'] 	= validation_errors();
		$this->output
        	->set_content_type('application/json')
        	->set_output(json_encode($json));
	}
	
	function cek_sifat($post_string){
		return $post_string == '0' ? FALSE : TRUE;
	}

	public function tambah_kriteria()
	{
		if($_POST){
			$this->form_validation->set_rules('kriteria', 'kriteria', 'required');
			$this->form_validation->set_rules('sifat', 'sifat', 'required|callback_cek_sifat');
			$this->form_validation->set_rules('bobot', 'bobot', 'numeric|required');
			$this->form_validation->set_rules('keterangan[]', 'keterangan', 'required');
			$this->form_validation->set_rules('nilai[]', 'nilai', 'numeric|required');
			$this->form_validation->set_message('required', '%s harus diisi!');
			$this->form_validation->set_message('cek_sifat', '%s harus diisi!');

			if($this->form_validation->run() == true){
				$kodeKriteria = htmlspecialchars($this->input->post('kode_kriteria'));
				$kriteria = htmlspecialchars($this->input->post('kriteria'));
				$sifat = htmlspecialchars($this->input->post('sifat'));
				$bobot = htmlspecialchars($this->input->post('bobot'));

				$dt = array(
					'kode_kriteria' => $kodeKriteria,
					'kriteria' => $kriteria,
					'sifat' => $sifat,
					'bobot' => $bobot
				);
				$insertKriteria = $this->m_kriteria->insert_kriteria($dt);
				if($insertKriteria){
					$no_array = 0;

					foreach($_POST['keterangan'] AS $k){
						if(!empty($k))
						{
							$ket = $_POST['keterangan'][$no_array];
							$nilai = $_POST['nilai'][$no_array];

							$dt = array(
								'kode_kriteria' => $kodeKriteria,
								'keterangan' => $ket,
								'nilai' => $nilai
							);

							$insertSubKriteria = $this->m_kriteria->insert_sub_kriteria($dt);
							
						}
					$no_array++;
					}
					$pesan = "Kriteria Telah dibuat";
					echo json_encode(array('status' => 1, 'pesan' => "Kriteria berhasil dibuat !"));
				}
			}
			else{
				$this->input_error();
			}
		}
		else{
			$data['kode'] = $this->m_kriteria->get_kode_kriteria();
			$this->load->view('include/navbar');
			$this->load->view('kriteria/tambah_kriteria', $data);
			$this->load->view('include/footer');
		}
	}

	public function save_edit_kriteria()
	{
		$this->form_validation->set_rules('kriteria', 'kriteria', 'required');
		$this->form_validation->set_rules('sifat', 'sifat', 'required|callback_cek_sifat');
		$this->form_validation->set_rules('bobot', 'bobot', 'numeric|required');
		$this->form_validation->set_message('required', '%s harus diisi!');
		$this->form_validation->set_message('cek_sifat', '%s harus diisi!');
		if($this->form_validation->run() == true)
		{
			$kodeKriteria = htmlspecialchars($this->input->post('kode_kriteria'));
			$kriteria = htmlspecialchars($this->input->post('kriteria'));
			$sifat = htmlspecialchars($this->input->post('sifat'));
			$bobot = htmlspecialchars($this->input->post('bobot'));

			$dt = array(
				'kriteria' => $kriteria,
				'sifat' => $sifat,
				'bobot' => $bobot
			);
			$edit = $this->m_kriteria->edit_kriteria($kodeKriteria, $dt);

			if($edit){
				
				$pesan = "Kriteria Telah diedit";
				echo json_encode(array('status' => 1, 'pesan' => "Kriteria berhasil diedit !"));
			}
		}
		else{
			$this->input_error();
		}
	
	}

	public function save_edit_sub_kriteria()
	{
		$this->form_validation->set_rules('keterangan[]', 'keterangan', 'required');
		$this->form_validation->set_rules('nilai[]', 'nilai', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!');
		if ($this->form_validation->run() == true) {
			$kodeKriteria = htmlspecialchars($this->input->post('kodeKriteria'));
			$delete = $this->m_kriteria->delete_sub_kriteria($kodeKriteria);
			if ($delete) {
				$no_array = 0;

				foreach ($_POST['keterangan'] as $k) {
					if (!empty($k)) {
						$ket = $_POST['keterangan'][$no_array];
						$nilai = $_POST['nilai'][$no_array];
						
						$dt = array(
							'kode_kriteria' => $kodeKriteria,
							'keterangan' => $ket,
							'nilai' => $nilai
						);
						$editSubKriteria = $this->m_kriteria->insert_sub_kriteria($dt);
					}
					$no_array++;
				}
				$pesan = "Sub Kriteria berhasil diedit";
				echo json_encode(array('status' => 1, 'pesan' => "Sub Kriteria berhasil diedit !"));
			}
		} else {
			$this->input_error();
		}
	}

	public function view_kriteria()
	{
		$kode = $this->uri->segment('3');
		$data['kode'] = $this->m_kriteria->get_kriteria_by_kode($kode);
		$data['subKriteria'] = $this->m_kriteria->get_sub_kriteria_by_kode($kode)->result_array();
		$this->load->view('kriteria/view_kriteria', $data);
	}

	public function edit_kriteria()
	{
		$kode = $this->uri->segment('3');
		$data['kode'] = $this->m_kriteria->get_kriteria_by_kode($kode);
		//$data['subKriteria'] = $this->m_kriteria->get_sub_kriteria_by_kode($kode);
		$this->load->view('kriteria/edit_kriteria', $data);
	}

	public function edit_sub_kriteria()
	{
		$kode = $this->uri->segment('3');
		$data['detail'] = $this->m_kriteria->get_sub_kriteria_by_kode($kode);
		$this->load->view('kriteria/edit_item_kriteria', $data);
	}

	

	public function delete_kriteria()
	{
		$kode = $this->uri->segment('3');
		
		$hapus = $this->m_kriteria->delete_kriteria($kode);
		if($hapus){
			$hapus_subkriteria = $this->m_kriteria->delete_sub_kriteria($kode);
			if ($hapus_subkriteria) {
				redirect('kriteria');
			}
			
		}
	}

	


}