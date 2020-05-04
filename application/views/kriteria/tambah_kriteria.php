<div class="container">
	<div class="card">
		<div class="card-body">
			<h2>Tambah Kriteria</h2>
			<br>
			<form id="tambahKriteria" method="post">
				<div class="form-group">
					<label for="kode_kriteria">Kode Kriteria</label>
					<input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" value="<?= $kode ?>" readonly>
				</div>
				<div class="form-group">
					<label for="kriteria">Nama Kriteria</label>
					<input type="text" class="form-control" id="kriteria" name="kriteria" required="required">
				</div>
				<div class="form-group">
					<label for="sifat">Sifat</label>
					<select class="form-control" id="sifat" name="sifat" required>
						<option value="0" disabled selected>--</option>
						<option value="Benefit">Benefit</option>
						<option value="Cost">Cost</option>
					</select>
				</div>
				<div class="form-group">
					<label for="bobot">Bobot</label>
					<input type="number" class="form-control" id="bobot" name="bobot" required>
				</div>

				<div class="card">
					<div class="card-header">
						Item Kriteria
					</div>
					<div class="card-body" id="dynamic_field">
						<table class="table table-borderless">
							<tbody>

							</tbody>
						</table>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<button id='BarisBaru' type="button" class="btn btn-info waves-effect">Baris Baru</button>
						</div>
						<br>
					</div>
				</div>
				<br><button type="button" name="btn_simpan" id="btn_simpan" class="btn btn-info">Simpan</button>
			</form>
		</div>
	</div>
</div>
</div>


<script>
	$(document).ready(function() {
		for (B = 1; B <= 1; B++) {
			BarisBaru();
		}
		var id = $('#dynamic_field tbody tr').length + 1;
		$('#BarisBaru').click(function() {
			BarisBaru();
		});
	});

	function BarisBaru() {
		var Nomor = $('#dynamic_field tbody tr').length + 1;
		var Baris = "<tr id='tr" + Nomor + "'>";
		Baris += "<td> <span>Keterangan</span> " +
			"<input type='text' name='keterangan[]' id='keterangan[]' class='form-control form-group' placeholder='example: Sangat Bagus'> </td>";

		Baris += "<td><span>Nilai</span>" +
			"<select class='form-control form-group' name='nilai[]' id='nilai[]' required >";
		<?php for ($i = 1; $i <= 10; $i++) { ?>
			Baris += "<option value='<?= $i; ?>' ><?= $i; ?> </option>";
		<?php } ?>
		Baris += "</select></td>";



		Baris += "<td><div class='form-group'> <br>" +
			"<button type='button' name='remove' id='HapusBaris' class='btn btn-outline-info remove'><i class='fa fa-fw fa-trash' aria-hidden='true '></i></button> </div></td>";
		Baris += "</tr>";
		$('#dynamic_field tbody').append(Baris);
	}

	$(document).on('click', '#HapusBaris', function(e) {
		e.preventDefault();
		var Nomor = 1;
		$(this).closest('tr').remove();
		$(this).parent().remove();

		$('#dynamic_field tbody tr').each(function() {
			$(this).find('td:nth').html(Nomor);
			Nomor++;
		});
		Nomor++;
	});

	$(document).on('click', '#add_more', function() {
		count = count + 1;
		tambahBaris(count);
	});

	$(document).on('click', '.remove', function() {
		var row_id = $(this).attr("id");
		$('#row' + row_id).remove();
	});

	$(document).on('click', 'button#btn_simpan', function() {

		SaveData();
	});

	function SaveData() {
		var FormData = "kode_kriteria=" + encodeURI($('#kode_kriteria').val());
		FormData += "&kriteria=" + encodeURI($('#kriteria').val());
		FormData += "&sifat=" + encodeURI($('#sifat').val());
		FormData += "&bobot=" + encodeURI($('#bobot').val());
		FormData += "&" + $('#dynamic_field  input').serialize();
		FormData += "&" + $('#dynamic_field  select').serialize();
		$.ajax({
			url: "<?php echo base_url('kriteria/tambah_kriteria'); ?>",
			type: "POST",
			cache: false,
			data: FormData,
			dataType: 'json',
			success: function(json) {
				if (json.status == 1) {
					swal("Selamat!", json.pesan, "success")
						.then((value) => {
							window.location.href = "<?php echo site_url('kriteria/index'); ?>";
						});
				} else {
					swal("Maaf!", json.pesan, "error");
				}
			}
		});
	}
</script>