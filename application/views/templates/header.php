<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url("assets/css/bootstrap.min.css"); ?>"
          rel="stylesheet">
    <link href="<?= base_url("assets/css/font-awesome.min.css"); ?>"
          rel="stylesheet">
    <link href="<?= base_url("assets/css/style.css"); ?>" rel="stylesheet">
    <![endif]-->
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"
               href="<?= base_url('/') ?>"><?= PRJ_NAME ?></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= base_url('products') ?>">Products List</a></li>
                <li><a href="#" data-toggle="modal" data-target="#aboutModal">About</a>
                </li>
              <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === TRUE) : ?>
                  <li><a href="<?= base_url('logout') ?>">Logout</a></li>
                  <li><a href="<?= base_url('admin/product/add') ?>">Add A
                          Product</a></li>
              <?php else : ?>
                  <li><a href="<?= base_url('login') ?>">Login</a></li>
                  <li><a href="<?= base_url('register') ?>">Register</a></li>
              <?php endif; ?>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<!-- Modal -->
<div id="aboutModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Simple Project Have been defined By
                    SB</h4>
            </div>
            <div class="modal-body">
                <p class=" alert-warning">This is a simple test project based on
                    CodeIgnitor 3.1.5 have been done By <strong>Yusef</strong>
                    which was suggested By <strong>Sajad</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">Close
                </button>
            </div>
        </div>

    </div>
</div>


