<!-- <head>
        <meta charset="utf-8" />
        <title>PHP Progress Sample</title>
        <link href="dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>

        <div class="row">
                <div class="col-md-6 col-md-offset-5">

                        <div class="progress">
                                <div id="progress_elem" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                        </div>
                </div>
        </div>

        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript">
                function updateBar(progress) {
                        var status = progress+"%";
                        $("#progress_elem").css({width: status}).text(status);

                }
        </script>
</body> -->

<head>
        <meta charset="utf-8" />
        <title>PHP Progress Sample</title>
        <link href="dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>

        <div class="row">
                <div class="col-md-6 col-md-offset-3">
                        <h1>Progress Sample</h1>
                        <h2>ロード中</h2>
                        <div class="progress">
                                <div id="progress_elem" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                        </div>
                </div>
        </div>

        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript">
                function updateBar(progress) {
                        var status = progress+"%";
                        $("#progress_elem").css({width: status}).text(status);

                }
        </script>
</body>
