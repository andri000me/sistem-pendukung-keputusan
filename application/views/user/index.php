<link href="<?= base_url(); ?>assets/vendor/bootstrap/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container">
    <div class="card">
        <div class="card-body">
            <a href=" <?= base_url('admin/tambah_user') ?>" class="btn btn-info">Tambah User</a>

            <br> <br>
            <table class="table" id="table_listing" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Level</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($user->result_array() as $usr) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $usr['username'] ?></td>
                            <td><?= $usr['nama'] ?></td>
                            <td><?= $usr['level'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/view_user/' . $usr['id_user']) ?>" type="button" id="viewKriteria" class="btn btn-sm btn-outline-info view-kriteria" data-toggle="modal" data-target="#theModal"><i class="fa fa-fw fa-eye"></i></a>
                                <!-- <a href="<?= base_url('admin/edit_user/' . $usr['id_user']) ?>" type="button" class="btn btn-sm btn-outline-warning modal-edit-kriteria" data-toggle="modal" data-target="#theModal">Edit User</a> -->
                                <a href="<?= base_url('admin/delete_user/' . $usr['id_user']) ?>" type="button" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></a>
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