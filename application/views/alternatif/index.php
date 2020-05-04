<link href="<?= base_url(); ?>assets/vendor/bootstrap/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container">
	<div class="card">
		<div class="card-body">
		<?php
		$role = $this->session->userdata('role');
		if ($role == 'user'){
		?>
			<a href=" <?= base_url('alternatif/tambah_alternatif') ?>" class="btn btn-info float-left"> Tambah Alternatif</a>
			<a href=" <?= base_url('alternatif/hapus_all_alternatif') ?>" class="btn btn-danger float-right delete-all-alternatif"> Hapus Semua Alternatif</a>
			<br> <br>
		<?php } ?>

			<table class="table" id="table_listing" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Alternatif</th>
						<?php
						$role = $this->session->userdata('role');
						if ($role == 'user'){
						?>
						<th scope="col">Action</th>
						<?php }?>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($alternatif->result_array() as $a) { ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $a['alternatif'] ?></td>
							<?php
							$role = $this->session->userdata('role');
							if ($role == 'user'){
							?>
							<td>
								<a href="<?= base_url('alternatif/view_alternatif/' . $a['kode_alternatif']) ?>" id="viewKriteria" data-toggle="modal" data-target="#theModal" type=" button" class="btn btn-sm btn-outline-info view-alternatif"><i class="fa fa-fw fa-eye"></i></a>
								<a href="<?= base_url('alternatif/edit_alternatif/' . $a['kode_alternatif']) ?>" type=" button" class="btn btn-sm btn-outline-warning modal-edit-alternatif"><i class="fa fa-fw fa-pencil-square-o" aria-hidden="true"></i></a>
								<a href="<?= base_url('alternatif/delete_alternatif/' . $a['kode_alternatif']) ?>" type="button" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></a>
							</td>
							<?php } ?>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>


<div id="theModal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/vendor/jquery/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
		$('#table_listing').DataTable();
	});

	// $('.modal-edit-alternatif').on('click', function(e) {
	// 	e.preventDefault();
	// 	$('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
	// });

	$('.view-alternatif').on('click', function(e) {
		e.preventDefault();
		$('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
	});

	$(document).on('click', '.delete-confirm', function(e) {
		event.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Apakah Kamu Yakin?',
			text: 'Data ini akan dihapus secara permanen!',
			icon: 'warning',
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				window.location.href = url;
			}
		});
	});

	$(document).on('click', '.delete-all-alternatif', function(e) {
		event.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Apakah Kamu Yakin?',
			text: 'Data ini akan dihapus secara permanen!',
			icon: 'warning',
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				window.location.href = url;
			}
		});
	});
</script>