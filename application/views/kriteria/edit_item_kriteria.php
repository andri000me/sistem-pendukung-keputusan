<div class="modal-header">
    <h5 class="modal-title">Edit Sub Kriteria</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="post">
        <div class="container">
            <?php $row = $detail->row() ?>
            <input type="hidden" name="kodeKriteria" id="kodeKriteria" value="<?= $row->kode_kriteria; ?>">
            <div class="sub-kriteria" id="dynamic_field">
                <table class="table table-borderless">
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <button id='BarisBaru' type="button" class="btn btn-info waves-effect"> Baris Baru</button>
            </div>
            <br>
            <button type="button" name="btn_simpan" id="btn_simpan" class="btn btn-info">Simpan</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        <?php foreach ($detail->result() as $d) : ?>
            fillItem('<?= $d->keterangan; ?>', '<?= $d->nilai; ?>');
        <?php endforeach; ?>

        var id = $('#dynamic_field tbody tr').length + 1;
        $('#BarisBaru').click(function() {
            BarisBaru();
        });
        $("#dynamic_field").find('input[type=text],select').filter(':visible:first').focus();
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

        // Baris += "<td><div class='form-group'>" +
        //     "<input type='text' name='nilai[]' id='nilai" + Nomor + "' class='form-control nilai_list' placeholder='1-10'> </div></td>";
        Baris += "<td><div class='form-group'> <br>" +
            "<button type='button' name='remove' id='HapusBaris' class='btn btn-outline-info remove'><i class='fa fa-fw fa-trash' aria-hidden='true '></i></button> </div></td>";
        Baris += "</tr>";
        $('#dynamic_field tbody').append(Baris);
    }

    function fillItem(keterangan, nilai) {
        var Nomor = $('#dynamic_field tbody tr').length + 1;
        var Baris = "<tr id='tr" + Nomor + "'>";
        Baris += "<td><span>Keterangan</span> " +
            "<input type='text' name='keterangan[]' id='keterangan[]' value='" + keterangan + "' class='form-control form-group' placeholder='example: Sangat Bagus'> </td>";

        Baris += "<td><span>Nilai</span>";
        Baris += "<select class='form-control form-group' name='nilai[]' id='nilai[]' required >";

        for (var i = 1; i <= 10; i++) {
            var selected = '';
            if (i == nilai) {
                selected += 'selected';
            }
            Baris += "<option value='" + i + "' " + selected + " > " + i + "</option>";
        }
        Baris += "</select></td>";

        Baris += "<td><br>" +
            "<button type='button' name='remove' id='HapusBaris' class='btn btn-outline-info remove'><i class='fa fa-fw fa-trash' aria-hidden='true '></i></button></td>";
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

    $(document).on('click', 'button#btn_simpan', function() {
        SaveData();
    });

    function SaveData() {
        var FormData = "kodeKriteria=" + encodeURI($('#kodeKriteria').val());
        FormData += "&" + $('#dynamic_field  input').serialize();
        FormData += "&" + $('#dynamic_field  select').serialize();

        $.ajax({
            url: "<?php echo base_url('kriteria/save_edit_sub_kriteria'); ?>",
            type: "POST",
            cache: false,
            data: FormData,
            dataType: 'json',
            success: function(json) {
                if (json.status == 1) {
                    swal("Selamat!", json.pesan, "success")
                        .then((value) => {
                            window.location.href = "<?php echo site_url('kriteria'); ?>";
                        });

                } else {
                    swal("Maaf!", json.pesan, "error");
                }
            }

        });

    }
</script>