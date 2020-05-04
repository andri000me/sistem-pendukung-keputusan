<?php
class Alternatif extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('m_alternatif');
		$this->load->model('m_kriteria');
		$this->load->library('form_validation');
	}

	function input_error()
	{
		$json['status'] = 0;
		$json['pesan'] 	= validation_errors();
		$this->output
        	->set_content_type('application/json')
        	->set_output(json_encode($json));
	}
	
	function cek_nilai($post_string){
		return $post_string == '0' ? FALSE : TRUE;
	}

	public function index()
	{
		$data['alternatif'] = $this->m_alternatif->get_alternatif();
		$this->load->view('include/navbar');
		$this->load->view('alternatif/index', $data);
		$this->load->view('include/footer');
	}

	public function get_DataTambah()
	{
		$dataView = array();
		$kriteria = $this->m_kriteria->getAll();
		foreach ($kriteria as $item) {
            $kodekri = $item->kode_kriteria;
            $dataView[$item->kode_kriteria] = array(
				'nama' => $item->kriteria,
				'kode_kriteria' => $item->kode_kriteria,
                'data' => $this->m_alternatif->getById($kodekri)
            );
		}
		return $dataView;
	}

	public function tambah_alternatif($kode = null)
	{
		if($_POST){
			$this->form_validation->set_rules('alternatif', 'alternatif', 'required');
			$this->form_validation->set_rules('kode_kriteria[]', 'bobot', 'required');
			$this->form_validation->set_rules('nilai[]', 'nilai', 'required|callback_cek_nilai');
			$this->form_validation->set_message('required', '%s harus diisi!');
			$this->form_validation->set_message('cek_nilai', '%s harus diisi!');

			if($this->form_validation->run() == true){
				$kodeAlternatif = htmlspecialchars($this->input->post('kode_alternatif'));
				$alternatif = htmlspecialchars($this->input->post('alternatif'));

				$dt = array(
					'kode_alternatif' => $kodeAlternatif,
					'alternatif' => $alternatif
				);
				$insertAlternatif = $this->m_alternatif->insert_alternatif($dt);
				if($insertAlternatif){
					$no_array = 0;

					foreach($_POST['kode_kriteria'] AS $k){
						if(!empty($k))
						{
							$kodeKriteria = $_POST['kode_kriteria'][$no_array];
							$nilai = $_POST['nilai'][$no_array];
							
							$dtNilai = array(
								'kode_kriteria' => $kodeKriteria,
								'kode_alternatif' => $kodeAlternatif,
								'nilai' => $nilai
							);

							$insertNilaiAlternatif = $this->m_alternatif->insert_nilai_alternatif($dtNilai);
							
						}
					$no_array++;
					}
					$pesan = "Alternatif Telah dibuat";
					echo json_encode(array('status' => 1, 'pesan' => "Alternatif berhasil dibuat !"));
				}
			}
			else{
				$this->input_error();
			}
		}
		else{
			$data['kodeAlternatif'] = $this->m_alternatif->get_kode_alternatif();
			$data['dataView'] = $this->get_DataTambah();
			$data['nilaiAlternatif'] = $this->m_alternatif->getNilaiById($kode);
			$this->load->view('include/navbar');
			$this->load->view('alternatif/tambah_alternatif', $data);
			$this->load->view('include/footer');
		}
	}

	public function view_alternatif()
	{
		$kode = $this->uri->segment('3');
		$data['kode'] = $this->m_alternatif->get_alternatif_by_kode($kode);
		$data['nilaiAlternatif'] = $this->m_alternatif->get_nilai_alternatif_by_kode($kode);
		$this->load->view('alternatif/view_alternatif', $data);
	}

	public function delete_alternatif()
	{
		$kode = $this->uri->segment('3');
		
		$hapus = $this->m_alternatif->delete_alternatif($kode);
		if($hapus){
			$hapus_nilai_alternatif = $this->m_alternatif->delete_nilai_alternatif($kode);
			if ($hapus_nilai_alternatif) {
				redirect('alternatif');
			}
		}
	}

	public function edit_alternatif($kode)
	{
		// $kode = $this->uri->segment('3');
		$data['dataView'] = $this->get_DataTambah();
		$data['nilaiAlternatif'] = $this->m_alternatif->getNilaiById($kode);
		$this->load->view('include/navbar');
		$this->load->view('alternatif/edit_alternatif', $data);
		$this->load->view('include/footer');
		
	}

	public function save_edit_alternatif()
	{
		if ($_POST) {
			$this->form_validation->set_rules('alternatif', 'alternatif', 'required');
			$this->form_validation->set_rules('kode_kriteria[]', 'bobot', 'required');
			$this->form_validation->set_rules('nilai[]', 'nilai', 'required');
			$this->form_validation->set_message('required', '%s harus diisi!');
			$this->form_validation->set_message('cek_nilai', '%s harus diisi!');
			if ($this->form_validation->run() == true) {
				$kodeAlternatif = htmlspecialchars($this->input->post('kode_alternatif'));
				$alternatif = htmlspecialchars($this->input->post('alternatif'));

				$dt = array(
					'alternatif' => $alternatif
				);
				$editAlternatif = $this->m_alternatif->edit_alternatif($dt, $kodeAlternatif);
				if ($editAlternatif) {
					$no_array = 0;

					foreach ($_POST['kode_kriteria'] as $k) {
						if (!empty($k)) {
							$kodeKriteria = $_POST['kode_kriteria'][$no_array];
							$nilai = $_POST['nilai'][$no_array];

							$dtNilai = array(
								'nilai' => $nilai
							);

							$editNilaiAlternatif = $this->m_alternatif->edit_nilai_alternatif($dtNilai, $kodeAlternatif, $kodeKriteria);
						}
						$no_array++;
					}
					$pesan = "Alternatif Telah diedit";
					echo json_encode(array('status' => 1, 'pesan' => "Alternatif berhasil diedit !"));
				}
			} 
			else {
				$this->input_error();
			}
		}
	}

	public function hapus_all_alternatif()
	{
		$query = $this->m_alternatif->delete_all_alternatif();
		if ($query) {
			redirect('alternatif');
		}
	}
}