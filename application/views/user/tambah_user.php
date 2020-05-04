<div class="container">
    <div class="card">
        <div class="card-body">
            <h2>Tambah User</h2>
            <br>
            <form id="" method="post">
                <div class="form-group">
                    <label for="username">Username</label><label class="text-danger">*</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label><label class="text-danger">*</label>
                    <input type="text" class="form-control" id="nama" name="nama" required="required">
                </div>
                <div class="form-group">
                    <label for="level">Level</label><label class="text-danger">*</label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="0" readonly selected="selected">--</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="nohp">No. HP</label>
                    <input type="number" class="form-control" id="nohp" name="nohp">
                </div>
                <div class="form-group">
                    <label>Password</label><label class="text-danger">*</label>
                    <input type="password" class="form-control" name="password" required id="password">
                </div>
                <div class="form-group">
                    <label>Re-Password</label><label class="text-danger">*</label>
                    <input type="password" class="form-control" name="password1" required id="password1">
                </div>


                <br><button type="button" name="btn_simpan" id="btn_simpan" class="btn btn-info">Simpan</button>
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
            var FormData = "username=" + encodeURI($('#username').val());
            FormData += "&nama=" + encodeURI($('#nama').val());
            FormData += "&level=" + encodeURI($('#level').val());
            FormData += "&email=" + encodeURI($('#email').val());
            FormData += "&nohp=" + encodeURI($('#nohp').val());
            FormData += "&password1=" + encodeURI($('#password1').val());
            FormData += "&password=" + encodeURI($('#password').val());
            $.ajax({
                url: "<?php echo base_url('admin/tambah_user'); ?>",
                type: "POST",
                cache: false,
                data: FormData,
                dataType: 'json',
                success: function(json) {
                    if (json.status == 1) {
                        swal("Selamat!", json.pesan, "success")
                            .then((value) => {
                                window.location.href = "<?php echo site_url('admin/list_user'); ?>";
                            });

                    } else {
                        swal("Maaf!", json.pesan, "error");
                    }
                }

            });

        }

    });
</script>