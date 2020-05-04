<div class="container">
    <div class="card">
        <div class="card-body">
            <h2>Edit Alternatif</h2>
            <br>
            <form method="post">
                <div class="form-group">
                    <label>Kode Alternatif</label>
                    <input type="text" class="form-control" id="kode_alternatif" name="kode_alternatif" value="<?= $nilaiAlternatif[0]->kode_alternatif; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Alternatif</label>
                    <input type="text" class="form-control" id="alternatif" name="alternatif" value="<?php echo isset($nilaiAlternatif[0]->alternatif) ? $nilaiAlternatif[0]->alternatif : '' ?>">
                </div>
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataView as $item) { ?>
                            <tr id="subAlternatif">
                                <td>
                                    <?= $item['nama'] ?><input type="text" value="<?= $item['kode_kriteria'] ?>" name="kode_kriteria[]" id="kode_kriteria[]" hidden>
                                </td>
                                <td>
                                    <select class="form-control col-md-4" name="nilai[]" id="nilai[]" required>
                                        <option value="" disabled selected>--</option>
                                        <?php
                                        foreach ($item['data'] as $dataItem) { ?>

                                            <option value="<?php echo $dataItem->nilai; ?>" 
                                            <?php 
                                            if (isset($nilaiAlternatif)) {
                                                foreach ($nilaiAlternatif as $item => $value){
                                                    if ($value->kode_kriteria == $dataItem->kode_kriteria) {
                                                        $selected = '';
                                                        if ($value->nilai == $dataItem->nilai) {
                                                            echo 'selected="selected"';
                                                        }
                                                    }
                                                }
                                            }
                                            ?> />
                                            <?php echo $dataItem->keterangan;  ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <br><button type="button" id="btn_simpan" class="btn btn-info">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {

        $(document).on('click', 'button#btn_simpan', function() {

            SaveData();
        });

        function SaveData() {
            var FormData = "kode_alternatif=" + encodeURI($('#kode_alternatif').val());
            FormData += "&alternatif=" + encodeURI($('#alternatif').val());
            FormData += "&" + $('#subAlternatif  input').serialize();
            FormData += "&" + $('#subAlternatif  select').serialize();
            $.ajax({
                url: "<?php echo base_url('alternatif/save_edit_alternatif'); ?>",
                type: "POST",
                cache: false,
                data: FormData,
                dataType: 'json',
                success: function(json) {
                    if (json.status == 1) {
                        swal("Selamat!", json.pesan, "success")
                            .then((value) => {
                                window.location.href = "<?php echo site_url('alternatif'); ?>";
                            });

                    } else {
                        swal("Maaf!", json.pesan, "error");
                    }
                }

            });

        }

    });
</script>