<?php
session_start();
error_reporting(0);
require('dbconnect.php');
include_once 'Configuration/top.php';
$db_conf = include_once 'config.php';
// ログイン状態チェック
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();
    $sql = sprintf('SELECT * FROM members WHERE id=%d',
        mysql_real_escape_string($_SESSION['id']));
    $record = mysql_query($sql) or die(mysql_query());
    $member = mysql_fetch_assoc($record);
} else {
    header('Location: login.php');
}
?>
<?php
require('dbconnect.php');

/**
 * エスケープ
 * @param string $str
 * @return string
 */
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <title>GetLeak | <?php echo $member['simei'] ?><?php echo $member['name'] ?></title>
    <link rel="shortcut icon" href="<?php echo $db_conf['1065'] ?>" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="flickity.css" rel="stylesheet">
    <link href="flickity-demo.css" rel="stylesheet">
    <link href="css/channel.css" rel="stylesheet">

    <div id="loader-bg">
        <img src="img/ajax-loader (4).gif">

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        jQuery(window).on("load", function () {
            jQuery('#loader-bg').hide();
        });

    </script>

    <script language="JavaScript">
        $(function () {
            // 使用する要素名
            var IScontentItems = '.list__item'; // 取得する要素
            var IScontent = '.list'; // 取得要素を追加するコンテンツ
            var ISlink = '.pager__next'; // 次のページのリンク
            var ISlinkarea = '.pager'; // 次のページのリンクの親要素
            var loadingFlag = false; // 読み込み中はtrueにして、複数回発生しないようにする

            $(window).on('load scroll', function () {
                // 次のページ読み込み中の場合は処理を行わない
                if (!loadingFlag) {
                    var winHeight = $(window).height();
                    var scrollPos = $(window).scrollTop();
                    var linkPos = $(ISlink).offset().top;

                    if (winHeight + scrollPos > linkPos) {
                        loadingFlag = true;

                        // 次のページのリンクを取得して、要素を削除しておく
                        var nextPage = $(ISlink).attr('href');
                        $(ISlink).remove();
                        // 次のページの要素を取得
                        $.ajax({
                            type: 'GET',
                            url: nextPage,
                            dataType: 'html'
                        }).done(function (data) {
                            // 次のページのリンクを取得
                            var nextLink = $(data).find(ISlink);
                            // コンテンツ要素を取得
                            var contentItems = $(data).find(IScontentItems);

                            // コンテンツ要素を追加
                            $(IScontent).append(contentItems);

                            // 次のページがある場合はリンクを追加する
                            if (nextLink.length > 0) {
                                $(ISlinkarea).append(nextLink);
                                loadingFlag = false; // 次のページがない場合はloadingFlagをtrueにしたままにして、処理を発生しないようにする
                            }
                        }).fail(function () {
                            alert('ページの取得に失敗しました。');
                        });
                    }
                }
            });
        });
    </script>

</head>

<body>

<?php
error_reporting(0);
require_once 'nav/nav3.php'; ?>
<div class="container">

    <!-- Grid row -->
    <div class="row">
        <div class="col-md-8">
            <br>
            <?php
            $id = $member['id'];
            $topic1 = "SELECT * FROM favorite WHERE user_id ='$id'";
            mysql_real_escape_string($topic1);
            $topic2 = mysql_query($topic1) or die(mysql_error());
            $test = array();
            ?>

            <?php
            while ($topic = mysql_fetch_assoc($topic2)):
                ?>

                <?php

                $following_id = $topic['favorite_id'];
                $following_posts = "SELECT * FROM posts  WHERE display_flag = 1 AND id ='$following_id'";
                mysql_real_escape_string($following_posts);
                $following_value = mysql_query($following_posts) or die(mysql_error());
                ?>
                <?php
                while ($following_data = mysql_fetch_assoc($following_value)):
                    ?>

                    <?php $books[] = array(
                    'id' => $following_data['id'],
                    'member_id' => $following_data['member_id'],
                    'editor' => $following_data['editor'],
                    'gazouid' => $following_data['gazouid'],
                    'taitol' => $following_data['taitol'],
                    'kategori' => $following_data['kategori'],
                    'created' => $following_data['created'],
                    'book_name' => $following_data['kiji'],
                    'tag' => $following_data['tag']
                ); ?>
                <?php
                endwhile;
                ?>

            <?php
            endwhile;
            ?>

            <?php
            define('MAX', '10');

            $books_num = count($books);
            $max_page = ceil($books_num / MAX);

            if (!isset($_GET['page_id'])) {
                $now = 1;
            } else {
                $now = $_GET['page_id'];
            }

            $start_no = ($now - 1) * MAX;

            $disp_data1 = array_slice($books, $start_no, MAX, true);


            ?>
            <div class="contents">
                <script type="text/javascript">

                    $(function () {

                        $(document).on("click", ".btn-favorite", function () {

                            var id = $(this).attr("value");
                            console.log(id);
                            $.ajax({
                                type: "GET",
                                url: 'favorite.php',
                                dataType: 'html',
                                data: {data: id},
                                success: function (response) {

                                    if (response == 'loginerror') {
                                        alert('ログインしてください');
                                    } else {

                                        $('#favorite' + id).replaceWith('<a id="favorite' + id + '" class="btn-favorite-delete white-text" value="' + id + '"><i class="fa fa-star" aria-hidden="true"></i>お気に入り削除</a>');

                                    }
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("ajax通信に失敗しました");
                                    console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                                    console.log("textStatus     : " + textStatus);
                                    console.log("errorThrown    : " + errorThrown.message);
                                }
                            });
                        });


                        $(function () {
                            $(document).on("click", ".btn-favorite-delete", function () {
                                var id = $(this).attr("value");

                                $.ajax({
                                    type: "GET",
                                    url: 'favorite.delete.php',
                                    dataType: 'html',
                                    data: {data: id},
                                    success: function (k) {
                                        //デバッグ用 アラートとコンソール

                                        if (k == 'loginerror') {
                                            alert('ログインしてください');
                                        } else {

                                            $('#favorite' + id).replaceWith('<a id="favorite' + id + '" class="btn-favorite white-text" value="' + id + '"><i class="fa fa-star" aria-hidden="true"></i>お気に入り</a>');

                                        }
                                    },
                                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                                        console.log("ajax通信に失敗しました");
                                        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                                        console.log("textStatus     : " + textStatus);
                                        console.log("errorThrown    : " + errorThrown.message);
                                    }
                                });
                            });
                        });
                    });
                    $(document).on("click", ".btn-delete", function () {
                        // 「OK」時の処理開始 ＋ 確認ダイアログの表示
                        if (window.confirm('本当にいいんですね？')) {
                            var id = $(this).attr("value");

                            $.ajax({
                                type: "GET",
                                url: 'article_delete.php',
                                dataType: 'html',
                                data: {data: id},
                                success: function (response) {
                                    alert('削除が完了しました。');
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("通信に失敗しました");
                                }
                            });
                        }
                        // 「OK」時の処理終了

                        // 「キャンセル」時の処理開始


                    });

                </script>

                <div class="list" style="list-style:none">
                    <div class="list__item">
                        <?php
                        foreach ($disp_data1 as $val) {
                            ?>

                            <?php

                            try {
                                $id = $val['member_id'];
                                $gazou = $val['gazouid'];
                                if (isset($gazou)) {
                                    $images = $pdo->query("select * from upload where id = '$gazou'  ");
                                }
                            } catch (PDOException $e) {
                                // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
                                http_response_code(500);
                                header('Content-Type: text/plain; charset=UTF-8', true, 500);
                                exit($e->getMessage());
                            }
                            ?>
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="clearfix">
                                        <a href="view.php?id=<?php echo $val['id']; ?>">
                                            <div class="inner clearfix">

                                            </div>
                                        </a>
                                        <div class="container mt-5">


                                            <!--Section: Content-->
                                            <section class="dark-grey-text">
                                                <!-- Grid row -->
                                                <div class="row align-items-center">

                                                    <!-- Grid column -->
                                                    <div class="col-lg-5 col-xl-4">

                                                        <!-- Featured image -->
                                                        <div class="view overlay rounded ">
                                                            <?php if (isset($gazou)) { ?>
                                                                <?php foreach ($images as $i => $img): ?>
                                                                    <img src="data:image/jpeg;base64,<?= base64_encode($img['data']) ?>"
                                                                         width="100%" height="100%" class="img img-fluid"
                                                                         alt="画像<?= $i + 1 ?>">
                                                                <?php endforeach; ?>
                                                            <?php } else { ?>

                                                                <?php $value = htmlspecialchars_decode($val['editor']); ?>

                                                                <?php preg_match_all('/<img.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i',
                                                                    $value,
                                                                    $img_path_list);
                                                                //表示します
                                                                if ($img_path_list[1][0]) {
                                                                    echo '<img src="' . $img_path_list[1][0] . '" class="img img-fluid"  alt="">';
                                                                } else {
                                                                    echo '<img src="img/no-image12.png" class="img img-fluid"  alt="">';
                                                                }
                                                            }
                                                            ?>
                                                            <a>
                                                                <div class="mask rgba-white-slight"></div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    <!-- Grid column -->

                                                    <!-- Grid column -->
                                                    <div class="col-lg-7 col-xl-8">

                                                        <!-- Post title -->
                                                        <h4 class="font-weight-bold mb-3"><strong><?php $str = h($val['taitol']);
                                                                $str = mb_strimwidth($str, 0, 205, '…', 'UTF-8');
                                                                echo $str; ?></strong></h4>

                                                        <!-- Post data -->
                                                        <p>by <a href="people.php?id=<?php echo $val['member_id']; ?>"
                                                                 class="font-weight-bold">こちらのチャンネル</a>, <?= h($val['created']); ?>
                                                            ,<?php echo $val['kategori']; ?></p>
                                                        <!-- Read more button -->
                                                        <a href="view.php?id=<?php echo $val['id']; ?>"
                                                           class="btn btn-primary btn-md mx-0 btn-rounded">会話に参加する</a>

                                                    </div>
                                                    <!-- Grid column -->

                                                </div>
                                                <!-- Grid row -->
                                                <br>
                                                <div class="rounded-bottom mdb-color text-center">
                                                    <ul class="list-unstyled list-inline font-small">
                                                        <li class="list-inline-item pr-2 white-text">
                                                            <?php
                                                            $saiseix = $val['id'];
                                                            $saisei1 = "select count(*) as cnt from saiseisu where saisei_id = '$saiseix'";
                                                            mysql_real_escape_string($saisei1);
                                                            $saisei2 = mysql_query($saisei1) or die(mysql_error());
                                                            $saisei = mysql_fetch_assoc($saisei2)
                                                            ?>
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            <?php echo $saisei['cnt']; ?>
                                                        </li>
                                                        <li class="list-inline-item pr-2 white-text">
                                                            <?php
                                                            $commentx = $val['id'];
                                                            $comment5 = "SELECT (SELECT COUNT(*) FROM comment WHERE comment_id = '$commentx') AS count FROM comment limit 0,1";
                                                            mysql_real_escape_string($comment5);
                                                            $comment2 = mysql_query($comment5) or die(mysql_error());
                                                            $comment3 = mysql_fetch_assoc($comment2);
                                                            ?>

                                                            <i class="fa fa-comment" aria-hidden="true"></i>
                                                            &nbsp;<?php echo $comment3['count']; ?>
                                                        </li>

                                                        <li class="list-inline-item pr-2">
                                                            <?php
                                                            $member_id = $member['id'];
                                                            $id = $val['id'];
                                                            $sql = "select * from favorite where favorite_id='$id' AND user_id ='$member_id'";
                                                            $favorite_id = mysql_query($sql) or die(mysql_error());
                                                            $favorite = mysql_num_rows($favorite_id);
                                                            if ($favorite == 0) {
                                                                echo '<a id="favorite' . $id . '" class="btn-favorite white-text" value="' . $id . '"><i class="fa fa-star" aria-hidden="true"></i>お気に入り</a>';
                                                            } else {
                                                                echo '<a id="favorite' . $id . '" class="btn-favorite-delete white-text" value="' . $id . '"><i class="fa fa-star" aria-hidden="true"></i>お気に入り削除</a>';
                                                            }
                                                            ?>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </section>
                                            <!--Section: Content-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <?php

                if ($now < $max_page) { // リンクをつけるかの判定
                    echo '<div class="pager"><a class="pager__next" href=\'/profile.following.php?page_id=' . ($now + 1) . '\')>次へ</a></div>' . '　';
                } else {
                }
                ?>

            </div>


        </div>

        <!-- Grid column -->
        <div class="col-md-4">
            <?php require_once('usercord.php'); ?>
            <?php require_once('right-menu.php'); ?>
        </div>

    </div>


</div>


<!-- Footer -->
<script src="flickity.pkgd.js"></script>
<script src="fire-flickity.js"></script>

<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
