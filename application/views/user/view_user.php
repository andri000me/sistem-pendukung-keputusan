<div class="modal-header">
    <h5 class="modal-title">User</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="card">
        <div class="card-header">
            Detail User
        </div>
        <div class="card-body">

            <div class="row">
                <div class=" col-md-3"><b>Username </b></div>
                <div class="col-md-9">: <?= $detail['username'] ?></div>
            </div>
            <div class="row">
                <div class=" col-md-3"><b>Nama </b></div>
                <div class="col-md-9">: <?= $detail['nama'] ?> </div>
            </div>
            <div class="row">
                <div class=" col-md-3"><b>Level</b></div>
                <div class="col-md-9">: <?= $detail['level'] ?> </div>
            </div>
            <div class="row">
                <div class=" col-md-3"><b>Email </b></div>
                <div class="col-md-9">: <?= $detail['email'] ?> </div>
            </div>
            <div class="row">
                <div class=" col-md-3"><b>No. HP </b></div>
                <div class="col-md-9">: <?= $detail['no_hp'] ?> </div>
            </div>

        </div>
    </div>
    <br>
    
</div>