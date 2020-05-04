<link href="<?= base_url(); ?>assets/vendor/bootstrap/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container">
	<div class="card">
		<div class="card-body">
			<a href=" <?= base_url('kriteria/tambah_kriteria') ?>" class="btn btn-info"> Tambah Kriteria</a>

			<br> <br>
			<table class="table" id="table_listing" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Kode Kriteria</th>
						<th scope="col">Kriteria</th>
						<th scope="col">Sifat</th>
						<th scope="col">Bobot</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($kriteria->result_array() as $kri) { ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $kri['kode_kriteria'] ?></td>
							<td><?= $kri['kriteria'] ?></td>
							<td><?= $kri['sifat'] ?></td>
							<td><?= $kri['bobot'] ?></td>
							<td>
								<a href="<?= base_url('kriteria/view_kriteria/' . $kri['kode_kriteria']) ?>" type="button" id="viewKriteria" class="btn btn-sm btn-outline-info view-kriteria" data-toggle="modal" data-target="#theModal"><i class="fa fa-fw fa-eye"></i></a>
								<a href="<?= base_url('kriteria/edit_kriteria/' . $kri['kode_kriteria']) ?>" type="button" class="btn btn-sm btn-outline-warning modal-edit-kriteria" data-toggle="modal" data-target="#theModal">Edit Kriteria</a>
								<a href="<?= base_url('kriteria/edit_sub_kriteria/' . $kri['kode_kriteria']) ?>" type="button" class="btn btn-sm btn-outline-primary modal-edit-sub-kriteria" data-toggle="modal" data-target="#theModal">Edit Item Kriteria</a>
								<a href="<?= base_url('kriteria/delete_kriteria/' . $kri['kode_kriteria']) ?>" type="button" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></a>
							</td>
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

	$('.view-kriteria').on('click', function(e) {
		e.preventDefault();
		$('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
	});

	$('.modal-edit-sub-kriteria').on('click', function(e) {
		e.preventDefault();
		$('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
	});

	$('.modal-edit-kriteria').on('click', function(e) {
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
			buttons: ["Batal", "Ya!"],
		}).then(function(value) {
			if (value) {
				window.location.href = url;
			}
		});
	});
</script>