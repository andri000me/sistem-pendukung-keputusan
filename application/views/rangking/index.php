<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"> -->
<link href="<?= base_url(); ?>assets/vendor/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/vendor/bootstrap/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container">
	<div class="card">
		<div class="card-body">
			<h2>Data Rangking Urutan untuk Prioritas Produksi</h2>
			<div class="table">
				<table id="example" class="table table-bordered table-hover display" style="width:100%">
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
					<tbody>
						<?php
						foreach ($tableFinal as $item => $value) {
						?>

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

						<?php
							$no++;
						}
						?>
					</tbody>
				</table>
			</div>

			<!-- </div> -->

			<!-- <?php
					// $table = $this->page->getData('tableFinal');
					foreach ($tableFinal as $item => $value) {
						if ($value->Rangking == 1) {
					?>
					<div class="alert alert-success" role="alert">

					</div>
			<?php
						}
					}
			?> -->


		</div>
	</div>
</div>
</div>









<script src="<?= base_url() ?>assets/vendor/jquery/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/js/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/js/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/js/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/js/buttons.colVis.min.js"></script>
<script>
	$(document).ready(function() {
		$('#example').DataTable({
			"aaSorting": [],
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
	});
</script>