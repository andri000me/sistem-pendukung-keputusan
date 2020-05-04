<div class="modal-header">
  <h5 class="modal-title">Kriteria</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="card">
    <div class="card-header">
      Detail Kriteria
    </div>
    <div class="card-body">

      <div class="row">
        <div class=" col-md-3"><b>Kode Kriteria </b></div>
          <div class="col-md-9">: <?= $kode['kode_kriteria'] ?></div>
      </div>
      <div class="row">
        <div class=" col-md-3"><b>Kriteria </b></div>
          <div class="col-md-9">: <?= $kode['kriteria'] ?> </div>
      </div>
      <div class="row">
        <div class=" col-md-3"><b>Sifat</b></div>
          <div class="col-md-9">: <?= $kode['sifat'] ?> </div>
      </div>
      <div class="row">
        <div class=" col-md-3"><b>Bobot </b></div>
          <div class="col-md-9">: <?= $kode['bobot'] ?> </div>
      </div>
    
    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header">
      Nilai Kriteria
    </div>
    <div class="card-body">

      <table class="table ">
        <thead class="bg-info">
          <tr>
            <th scope="col">Keterangan</th>
            <th scope="col">Nilai</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($subKriteria AS $sub){ ?>
          <tr>
            <td><?=  $sub['keterangan']?></td>
            <td><?=  $sub['nilai']?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    
    </div>
  </div>
</div>