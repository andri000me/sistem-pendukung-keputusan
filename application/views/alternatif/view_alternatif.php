<div class="modal-header">
    <h5 class="modal-title">Alternatif</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="card">
        <div class="card-header">
            Detail Alternatif
        </div>
        <div class="card-body">

            <div class="row">
                <div class=" col-md-3"><b>Kode Alternatif </b></div>
                <div class="col-md-9">: <?= $kode['kode_alternatif'] ?></div>
            </div>
            <div class="row">
                <div class=" col-md-3"><b>Alternatif </b></div>
                <div class="col-md-9">: <?= $kode['alternatif'] ?> </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <?php
                    if ($nilaiAlternatif->num_rows() > 0) {
                        foreach ($nilaiAlternatif->result() as $nilai) {
                    ?>

                            <div class="row">

                                <div class=" col-md-3"><?= $nilai->kriteria; ?></div>
                                <div class="col-md-9">: <?= $nilai->keterangan; ?> </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>

            </div>




        </div>
    </div>

</div>