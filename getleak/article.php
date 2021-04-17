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
                                        <li class="list-inline-item pr-2">
                                            <?php echo '&nbsp;<a class="white-text" href="edit.php?value=' . $id . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>編集</a>&nbsp;'; ?>
                                        </li>
                                        <li class="list-inline-item pr-2">
                                            <?php echo '<a id="delete' . $id . '" class="btn-delete white-text" value="' . $id . '"><i class="fa fa-fire" aria-hidden="true"></i>削除</a>'; ?>
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
