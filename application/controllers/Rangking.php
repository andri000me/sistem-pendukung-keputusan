<?php
class Rangking extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('page');
		$this->load->model('M_kriteria');
		$this->load->model('M_alternatif');
		$this->load->model('M_rangking');
		// $this->page->setTitle('Rangking');
	}

	public function index()
	{
		$alternatif = $this->M_alternatif->getAll();

		if ($alternatif == null) {
			redirect('rangking/noData');
		}
		/**
		 * Menghapus table SAW jika ada
		 */
		$this->M_rangking->dropTable();

		/**
		 * $kriteria data dari table kriteria
		 */
		$kriteria = $this->M_kriteria->getAll();

		/**
		 * membuat table SAW berdasarkan data dari table kriteria
		 * menginputkan semua data nilai
		 */
		$this->M_rangking->createTable($kriteria);

		/**
		 * Ambil data dari table SAW untuk perhitungan awal
		 */
		$table1 = $this->initialTableSAW($alternatif);
		// $this->page->setData('table1', $table1);
		$data['table1'] = $table1;


		/**
		 * mengambil sifat kriteria
		 * @var $dataSifat array
		 */
		$dataSifat = $this->getDataSifat();
		// $this->page->setData('dataSifat', $dataSifat);
		$data['dataSifat'] = $dataSifat;

		/**
		 * Mengambil nilai maksimal dan minimal berdasarkan sifat
		 */
		$dataValueMinMax = $this->getVlueMinMax($dataSifat);
		// $this->page->setData('valueMinMax', $dataValueMinMax);
		$data['dataValueMinMax'] = $dataValueMinMax;

		/**
		 * Proses 1 ubah data berdasarkan sifat
		 */

		$table2 = $this->getCountBySifat($dataSifat, $dataValueMinMax);
		// $this->page->setData('table2', $table2);
		$data['table2'] = $table2;

		/**
		 * Hitung perkalian bobot dengan nilai kriteria
		 */
		$bobot = $this->M_kriteria->getBobotKriteria();
		// $this->page->setData('bobot', $bobot);
		$data['bobot'] = $bobot;
		$table3 = $this->getCountByBobot($bobot);
		// $this->page->setData('table3', $table3);
		$data['table3'] = $table3;

		/**
		 * Add kolom total dan rangking
		 */
		$this->M_rangking->addColumnTotalRangking();

		/**
		 * Menghitung nilai total
		 */
		$this->countTotal();

		/**
		 * Mengambil data yang sudah di rangking
		 */
		$tableFinal = $this->getDataRangking();
		// $this->page->setData('tableFinal', $tableFinal);
		$data['tableFinal'] = $tableFinal;


		/**
		 * Menghapus table SAW
		 */
		// $this->M_rangking->dropTable();

		$this->load->view('include/navbar');
		$this->load->view('rangking/index3', $data);
		$this->load->view('include/footer');
	}

	public function noData()
	{
		$this->load->view('include/navbar');
		$this->load->view('rangking/noData');
		$this->load->view('include/footer');
	}
	private function initialTableSAW($alternatif)
	{
		$nilai = $this->M_alternatif->getNilaiAlt();

		$dataInput = array();
		$no = 0;
		foreach ($alternatif as $item => $itemalternatif) {
			foreach ($nilai as $index => $itemNilai) {
				if ($itemalternatif->kode_alternatif == $itemNilai->kode_alternatif) {
					$dataInput[$no]['alternatif'] = $itemalternatif->alternatif;
					$dataInput[$no][$itemNilai->kriteria] = $itemNilai->nilai;
				}
			}
			$no++;
		}

		foreach ($dataInput as $data => $item) {
			$this->M_rangking->insert($item);
		}
		return $this->M_rangking->getAll();
	}

	private function getDataSifat()
	{
		$sawData = $this->M_rangking->getAll();
		$dataSifat = array();
		foreach ($sawData as $item => $value) {
			foreach ($value as $x => $z) {
				if ($x == 'Alternatif') {
					continue;
				}
				$dataSifat[$x] = $this->M_rangking->getStatus($x);
			}
		}
		return $dataSifat;
	}

	private function getVlueMinMax($dataSifat)
	{
		$sawData = $this->M_rangking->getAll();
		$dataValueMinMax = array();
		foreach ($sawData as $point => $value) {
			foreach ($value as $x => $z) {
				if ($x == 'Alternatif') {
					continue;
				}
				foreach ($dataSifat as $item => $itemX) {
					if ($x == $item) {

						if ($x == $item && $itemX->sifat == 'Benefit') {
							if (!isset($dataValueMinMax['max' . $x])) {
								$dataValueMinMax['kriteria' . $x] = $x;
								$dataValueMinMax['max' . $x] = $z;
								$dataValueMinMax['sifat' . $x] = 'Benefit';
							} elseif ($z > $dataValueMinMax['max' . $x]) {
								$dataValueMinMax['max' . $x] = $z;
							}
						} else {
							if (!isset($dataValueMinMax['min' . $x])) {
								$dataValueMinMax['kriteria' . $x] = $x;
								$dataValueMinMax['min' . $x] = $z;
								$dataValueMinMax['sifat' . $x] = 'Cost';
							} elseif ($z < $dataValueMinMax['min' . $x]) {
								$dataValueMinMax['min' . $x] = $z;
							}
						}
					}
				}
			}
		}

		return $dataValueMinMax;
	}

	private function getCountBySifat($dataSifat, $dataValueMinMax)
	{
		$sawData = $this->M_rangking->getAll();
		foreach ($sawData as $point => $value) {
			foreach ($value as $x => $z) {
				if ($x == 'Alternatif') {
					continue;
				}
				foreach ($dataSifat as $item => $sifat) {
					if ($x == $item) {
						if ($sifat->sifat == 'Benefit') {

							$newData = $z / $dataValueMinMax['max' . $x];
							$dataUpdate = array(
								$x => $newData
							);
							$where = array(

								'Alternatif' => $value->Alternatif
							);

							$this->M_rangking->update($dataUpdate, $where);
						} else {
							$newData = $dataValueMinMax['min' . $x] / $z;
							$dataUpdate = array(
								$x => $newData
							);
							$where = array(

								'Alternatif' => $value->Alternatif
							);

							$this->M_rangking->update($dataUpdate, $where);
						}
					}
				}
			}
		}

		return $this->M_rangking->getAll();
	}

	private function countTotal()
	{
		$sawData = $this->M_rangking->getAll();

		foreach ($sawData as $item => $value) {
			$total = 0;
			foreach ($value as $item => $itemData) {
				if ($item == 'Alternatif') {
					continue;
				} elseif ($item == 'Total') {
					$dataUpdate = array(
						'Total' => $total
					);

					$where = array(
						'Alternatif' => $value->Alternatif
					);

					$this->M_rangking->update($dataUpdate, $where);
				} else {
					$total = $total + $itemData;
				}
			}
		}
	}

	private function getCountByBobot($bobot)
	{

		$sawData = $this->M_rangking->getAll();
		foreach ($sawData as $point => $value) {
			foreach ($value as $x => $z) {
				if ($x == 'Alternatif') {
					continue;
				}
				foreach ($bobot as $item => $itemKriteria) {

					if ($x == $itemKriteria->kriteria) {

						$sawData[$point]->$x =  $z * $itemKriteria->bobot;
						$newData = $z * $itemKriteria->bobot;
						$dataUpdate = array(
							$x => $newData
						);
						$where = array(
							'Alternatif' => $value->Alternatif
						);

						$this->M_rangking->update($dataUpdate, $where);
					}
				}
			}
		}

		return $this->M_rangking->getAll();
	}

	private function getDataRangking()
	{
		$sawData = $this->M_rangking->getSortTotalByDesc();
		$no = 1;
		foreach ($sawData as $item => $value) {
			$dataUpdate = array(
				'Rangking' => $no
			);
			$where = array(
				'Alternatif' => $value->Alternatif
			);

			$this->M_rangking->update($dataUpdate, $where);
			$no++;
		}
		return $this->M_rangking->getSortRangking();
	}
}