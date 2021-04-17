<?php
session_start();
error_reporting(0);
require('dbconnect.php');
include_once 'Configuration/top.php';
include_once 'security.php';
include 'database.php';
$db_conf = include_once 'config.php';
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600000000000000000 > time()) {
    $_SESSION['time'] = time();
    $sql=sprintf('SELECT * FROM members WHERE id=%d',
        mysql_real_escape_string($_SESSION['id'])
    );
    $record = mysql_query($sql) or die(mysql_query());
    $member = mysql_fetch_assoc($record);
}
$member_id = $member['id'];

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $db_conf['506']; ?>">
    <title><?php echo $db_conf['505']; ?></title>
    <link rel="shortcut icon" href="<?php echo $db_conf['1065'] ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="google-site-verification" content="Byb4DMytDBTOAjDN1VsaQqwtRVnBIYCdu3qJApGdPSg" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    <!-- If you'd like to support IE8 -->
    <link href="flickity.css" rel="stylesheet">
    <link href="flickity-demo.css" rel="stylesheet">
    <link href="css/top.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/top.js"></script>
    <!--    <div id="loader-bg"><img src="img/ajax-loader (4).gif"></div>-->

</head>
<body>
<html lang="en" class="full-height">
<?php require 'navgetion/nav4.php'; ?>
<nav class="d-none d-lg-block navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">
    <h1 style="font-size: 20px;">FAQ</h1>
    <p><?php echo $db_conf['506']; ?></p>

</nav>

<div class=" d-block d-lg-none">
    <nav class="navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">
        <h1 style="font-size: 20px;">FAQ</h1>
        <p><?php echo $db_conf['506']; ?></p>
    </nav>
</div>
<!--Main Navigation-->
<div id="tags" class="tops"></div>
<div id="person"></div>
<div id="news"></div>
<div id="books"></div>
<div id="comic"></div>
<div id="novel"></div>
<div id="illust"></div>
<div id="magazine"></div>
<div id="movie"></div>
<div id="music"></div>
<div id="anime"></div>
<div id="game"></div>
<div id="society"></div>
<div id="Entertainment"></div>
<div id="science"></div>
<div id="Gourmet"></div>
<div id="Sport"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <br>
            <div class="card border-light">

                <div class="container my-5">


                    <!--Section: Content-->
                    <section>

                        <h6 class="font-weight-normal text-uppercase font-small grey-text mb-4 text-center">FAQ</h6>
                        <!-- Section heading -->
                        <h3 class="font-weight-bold black-text mb-4 pb-2 text-center">よくある質問</h3>
                        <hr class="w-header">
                                              <!-- Section description -->
<!--                        <p class="lead text-muted mx-auto mt-4 pt-2 mb-5 text-center">-->
<!--                            質問がありますか？答えがあります。他に質問がある場合は、サポートセンターをご覧ください。</p>-->

                        <div class="row">
                            <div class="col-md-12 col-lg-10 mx-auto mb-5">

                                <!--Accordion wrapper-->
                                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                                    <!-- Accordion card -->
                                    <div class="card border-top border-bottom-0 border-left border-right border-light">

                                        <!-- Card header -->
                                        <div class="card-header border-bottom border-light" role="tab" id="headingOne1">
                                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                                               aria-controls="collapseOne1">
                                                <h5 class="black-text font-weight-normal mb-0">
                                                    GetLeakについて<i class="fa fa-question-circle" aria-hidden="true"></i>
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                                             data-parent="#accordionEx">
                                            <div class="card-body">
                                                <a href="https://getleak.net/view?id=48851">このサイトは「シャーデンフロイデ」をテーマにしたWEBサイトになります. ...詳しくは</a>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->


                                </div>
                                <!-- Accordion wrapper -->

                            </div>
                        </div>

                    </section>


                </div>
            </div>
        </div>
        <div class="col-md-4">
            <?php require_once('right-menu.php'); ?>
        </div>
    </div>
</div>
</body>
<script src="flickity.pkgd.js"></script>
<script src="fire-flickity.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
</html>
