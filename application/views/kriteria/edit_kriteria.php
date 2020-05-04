<div class="modal-header">
  <h5 class="modal-title">Edit Kriteria</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
    <form id="tambahKriteria" method="post" >
        <div class="container">
            <div class="form-group">
                <label for="kode_kriteria">Kode Kriteria</label>
                <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" value="<?= $kode['kode_kriteria'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="kriteria">Nama Kriteria</label>
                <input type="text" class="form-control" id="kriteria" name="kriteria" value="<?= $kode['kriteria'] ?>" required>
            </div>
            <div class="form-group">
                <label for="sifat">Sifat</label>
                <select class="form-control" id="sifat" name="sifat" required>
                    <option disabled>--</option>
                    <option value="Benefit" <?php if($kode['sifat']=="benefit") echo 'selected="selected"'; ?> >Benefit</option>
                    <option value="Cost" <?php if($kode['sifat']=="cost") echo 'selected="selected"'; ?>>Cost</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bobot" >Bobot</label>
                <input type="number" class="form-control" id="bobot" name="bobot" value="<?= $kode['bobot'] ?>" required> 
            </div>
            <button type="button" name="btn_simpan" id="btn_simpan_edit" class="btn btn-info">Simpan</button>
            </div>
    </form>
</div>

<script>
	$(document).ready(function() {

		$(document).on('click', 'button#btn_simpan_edit', function() {

			SaveData();
		});

		function SaveData() {
			var FormData = "kode_kriteria=" + encodeURI($('#kode_kriteria').val());
			FormData += "&kriteria=" + encodeURI($('#kriteria').val());
			FormData += "&sifat=" + encodeURI($('#sifat').val());
			FormData += "&bobot=" + encodeURI($('#bobot').val());
			$.ajax({
				url: "<?php echo base_url('kriteria/save_edit_kriteria'); ?>",
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
	});
</script>