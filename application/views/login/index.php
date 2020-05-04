<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link href="<?= base_url(); ?>assets/css/stylecss.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="d-none d-lg-block col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider">
                                <div>
                                    <!-- <div class="width: 100%; display: inline-block;"> -->
                                        <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-deep-blue">
                                            <div class="slide-img-bg" style="background-image: url('<?= base_url('assets/img/loginbg.jpg'); ?>');"></div>
                                        </div>
                                    <!-- </div> -->
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <div class="app-logo"></div>
                            <h4 class="mb-0">
                                <?= $this->session->flashdata('message'); ?>
                                <span class="d-block"><strong>Selamat Datang,</strong></span>
                                <span>Silahkan login akun Anda.</span></h4>

                            <div class="divider row"></div>
                            <div>
                                <form class="" action="<?= base_url('auth') ?>" method="post">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="username" class="">Username</label><input name="username" id="username" type="text" class="form-control"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="password" class="">Password</label><input name="password" id="password" type="password" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="position-relative form-check">
                                        <div class="divider row"></div>
                                        <div class="d-flex align-items-center">
                                            <div class="ml-auto">
                                                <button type="submit" class="btn btn-info btn-lg">Login</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>assets/scripts/javascript.js"></script>
</body>

</html>