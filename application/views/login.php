<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $judul ?></title>
    <link href="<?= base_url().'assets/vendor/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?= base_url().'assets/vendor/font-awesome/css/font-awesome.min.css' ?>" rel="stylesheet">
    <link href="<?= base_url().'assets/css/sb-admin-2.css' ?>" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <?php 
                            if ($this->session->flashdata('error')) {
                                $message = $this->session->flashdata('error');
                                echo "
                                    <div class='alert alert-danger'>
                                        <p><span class='fa fa-ban'></span> $message</p>
                                    </div>
                                ";
                            }

                            echo form_open('login/process'); 
                        ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="username" name="username" type="text" autocomplete="off" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" name="login">
                            </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url().'assets/vendor/jquery/jquery.min.js' ?>"></script>
</body>
</html>