<div class="container">
    <div class="card">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile" aria-selected="true">Edit Profile</a>
                    <a class="nav-item nav-link" id="ubah-password-tab" data-toggle="tab" href="#ubah-password" role="tab" aria-controls="ubah-password" aria-selected="false">Ubah Password</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                    <br>
                    <form id="" method="post">
                        <div class="form-group">
                            <label for="username">Username</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label><label class="text-danger">*</label>
                            <select class="form-control" id="level" name="level" required>
                                <option value="0" readonly selected="selected">--</option>
                                <option value="admin" <?php if ($user['level'] == "admin") echo 'selected'; ?>>Admin</option>
                                <option value="user" <?php if ($user['level'] == "user") echo 'selected'; ?>>User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="nohp">No. HP</label>
                            <input type="number" class="form-control" id="nohp" name="nohp" value="<?= $user['no_hp'] ?>">
                        </div>


                        <br><button type="button" name="btn_edit_profile" id="btn_edit_profile" class="btn btn-info">Simpan</button>
                    </form>

                </div>




                <div class="tab-pane fade" id="ubah-password" role="tabpanel" aria-labelledby="ubah-password-tab">
                    <br>
                    <form id="" method="post">
                        <input type="hidden" name="id_user" id="id_user" value="<?= $user['id_user'] ?>">
                        <div class="form-group">
                            <label>Password Lama</label><label class="text-danger">*</label>
                            <input type="password" class="form-control" name="passwordlama" required id="passwordlama">
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label><label class="text-danger">*</label>
                            <input type="password" class="form-control" name="password" required id="password">
                        </div>
                        <div class="form-group">
                            <label>Re-Password Baru</label><label class="text-danger">*</label>
                            <input type="password" class="form-control" name="password1" required id="password1">
                        </div>


                        <br><button type="button" name="btn_simpan_edit_password" id="btn_simpan_edit_password" class="btn btn-info">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $(document).on('click', 'button#btn_edit_profile', function() {

            SaveData();
        });

        function SaveData() {
            var FormData = "username=" + encodeURI($('#username').val());
            FormData += "&nama=" + encodeURI($('#nama').val());
            FormData += "&level=" + encodeURI($('#level').val());
            FormData += "&email=" + encodeURI($('#email').val());
            FormData += "&nohp=" + encodeURI($('#nohp').val());
            $.ajax({
                url: "<?php echo base_url('setting/edit_profile'); ?>",
                type: "POST",
                cache: false,
                data: FormData,
                dataType: 'json',
                success: function(json) {
                    if (json.status == 1) {
                        swal("Selamat!", json.pesan, "success")
                            .then((value) => {
                                window.location.href = "<?php echo site_url('setting'); ?>";
                            });

                    } else {
                        swal("Maaf!", json.pesan, "error");
                    }
                }

            });

        }

    });
</script>
<script>
    $(document).ready(function() {

        $(document).on('click', 'button#btn_simpan_edit_password', function() {

            SaveData();
        });

        function SaveData() {
            var FormData = "passwordlama=" + encodeURI($('#passwordlama').val());
            FormData += "&password1=" + encodeURI($('#password1').val());
            FormData += "&password=" + encodeURI($('#password').val());
            FormData += "&id_user=" + encodeURI($('#id_user').val());
            $.ajax({
                url: "<?php echo base_url('setting/ubah_password'); ?>",
                type: "POST",
                cache: false,
                data: FormData,
                dataType: 'json',
                success: function(json) {
                    if (json.status == 1) {
                        swal("Selamat!", json.pesan, "success")
                            .then((value) => {
                                window.location.href = "<?php echo site_url('setting'); ?>";
                            });

                    } else {
                        swal("Maaf!", json.pesan, "error");
                    }
                }

            });

        }

    });
</script>