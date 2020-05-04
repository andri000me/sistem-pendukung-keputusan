<div class="container">
	<div class="card">
		<div class="card-body">
			<button type="button" class="btn btn-info">Cetak Laporan (PDF)</button>
			<button type="button" class="btn btn-primary">Cetak Laporan (XLS)</button>
			<br> <br>
			<!-- <div class="row"> -->
				<h2>Data Rangking Urutan untuk Prioritas Produksi</h2>
				<div class="table">
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr class="active">
								<!-- <th class="text-center">No</th> -->
								<?php
								$no = 1;
								// $table = $this->page->getData('tableFinal');
								foreach ($tableFinal as $item => $value) {
									foreach ($value as $heading => $itemValue) {
								?>
										<th class="text-center"><?php echo $heading ?></th>
								<?php
									}
									break;
								}
								?>
							</tr>
						</thead>
							<?php
							foreach ($tableFinal as $item => $value) {
							?>
							<tbody>
								<tr>
									<!-- <td class="text-center"><?php echo $no ?></td> -->
									<?php
									foreach ($value as $itemValue) {
									?>
										<td><?php echo $itemValue ?></td>
									<?php
									}
									?>
								</tr>
							</tbody>
							<?php
								$no++;
							}
							?>
					</table>
				</div>

			<!-- </div> -->

			<?php
			// $table = $this->page->getData('tableFinal');
			foreach ($tableFinal as $item => $value) {
				if ($value->Rangking == 1) {
			?>
					<div class="alert alert-success" role="alert">
						<h4><b>Kesimpulan : </b> Dari hasil perhitungan yang dilakukan menggunakan metode SAW
							orderan yang terbaik untuk di pilih adalah
							<?php echo $value->Alternatif ?> dengan nilai <?php echo $value->Total ?>
						</h4>
					</div>
			<?php
				}
			}
			?>

			<!-- <table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Rangking</th>
						<th scope="col">Kriteria</th>
						<th scope="col">Sifat</th>
						<th scope="col">Bobot</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Mark</td>
						<td>Otto</td>
						<td>Otto</td>
						<td>
							<button type="button" class="btn btn-sm btn-outline-info">Lihat</button>
							<button type="button" class="btn btn-sm btn-outline-warning">Edit Kriteria</button>
							<button type="button" class="btn btn-sm btn-outline-primary">Edit Item Kriteria</button>
							<button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
						</td>
					</tr>
					<tr>
						<th scope="row">2</th>
						<td>Jacob</td>
						<td>Thornton</td>
						<td>Otto</td>
						<td>@fat</td>
					</tr>
					<tr>
						<th scope="row">3</th>
						<td>Larry</td>
						<td>the Bird</td>
						<td>Otto</td>
						<td>@twitter</td>
					</tr>
				</tbody>
			</table> -->
		</div>
	</div>
</div>
</div>