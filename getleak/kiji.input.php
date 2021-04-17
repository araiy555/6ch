<?php
error_reporting(0);
session_start();
require('dbconnect.php');
// ログイン状態チェック
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
$_SESSION['time'] = time();
$sql=sprintf('SELECT * FROM members WHERE id=%d',
mysql_real_escape_string($_SESSION['id']));
$record = mysql_query($sql) or die(mysql_query());
$member = mysql_fetch_assoc($record);
$member_id = $member['id'];
}

if($_REQUEST['completion'] === '1'){
$completion = '投稿が完了しました。';
}
if($_REQUEST['formerror'] === '1' )
{
  $completion = '内容に問題があります。';
}
if($_REQUEST['fileerror'] === '2')
{
  $completion = 'ファイルに問題があります。';
}
if ($_REQUEST['extension'] === '3')
{
  $completion = '拡張子に問題があります。';
}
?>

<?php $db_conf = include_once 'config.php';?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <title>GetLeak | 投稿を作成する</title>
  <link rel="shortcut icon" href="<?php echo $db_conf['1065']?>" type="image/x-icon">
  <meta name="description" content="GetLeakは全世界すべての方が無料でアップロードすることが可能です。あなたの情報を公開してみよう!!">
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



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.css">
<link rel="stylesheet" href="assets/app.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="http://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/default.min.css">
    <script src="http://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js"></script>

    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>

<script type="text/javascript">
//商品検索
$(function() {
//登録ボタンがクリックされたら処理が走ります。
$('#start2').click(function() {

  if (confirm('この内容で検索しますか？')) {
    var title = $("#title").val();
    var tag = $("#tag").val();
    var editor = $('.ql-editor').html()

    var error = {};
    var error_data = '';

    if (!title) {
      error.product_id = 1;
      error_data += 'タイトルを入力してください。';
    }
    if (!editor) {
      error.product_id = 1;
      error_data += '内容を入力してください。';
    }
    if (!tag) {
      error.product_id = 3;
      error_data += 'タグを入力してください';
    }

    var result = Object.keys(error).length;

    if (result == 0) {
      var form = $('#my_form');

      var data = {
         kokuseki : $('#kokuseki').val(),
          member_id : $('#member_id').val(),
         title : $("#title").val(),
       tag : $("#tag").val(),
       image : $("#datavalue").val(),
       image1 : $("#result").val(),
       douga : $("#result1").val(),
         editor: $('.ql-editor').html()
       };

      //formから
      // form.serialize(),
      // var param = $form.serializeArray();
           //ここからajaxの処理です。
           $.ajaxSetup({
             scriptCharset: 'utf-8'
           });
           $.ajax({
             //POST通信
             type: "POST",
             //ここでデータの送信先URLを指定します。
             url: "kiji.toukou.php",
             data: data,
             //リクエストが完了するまで実行される
             beforeSend: function() {
               $('.loading').removeClass('hide');
             },
             //処理が成功したら
             success: function(data, dataType) {
               $('.loading').addClass('hide');

               value = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>'+ data +'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
               $('#res').html(value);
               return false;
             },
             //処理がエラーであれば
             error: function() {
               alert('通信エラー');
             }
           });
           //submitによる画面リロードを防いでいます。
           return false;
    } else {
      alert(error_data);
      return false;
    }
  }
});
});
</script>


</script>

<style>
#loader-bg {
background: #fff;
height: 100%;
width: 100%;
position: fixed;
top: 0px;
left: 0px;
z-index: 10;
}
#loader-bg img {
background: #fff;
position: fixed;
top: 50%;
left: 50%;
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
z-index: 10;
}

body {
font-family: Helvetica, Arial, ;
font-size: 12px;

}
.bootstrap-tagsinput .tag {
margin-right: 2px;
color: white;
}
.label-info {
background-color: #5bc0de;
}
.label {
display: inline;
padding: .2em .6em .3em;
font-size: 75%;
font-weight: 700;
line-height: 1;
color: #fff;
text-align: center;
white-space: nowrap;
vertical-align: baseline;
border-radius: .25em;
}
/*検索ボックス*/
#keyword{
background:#eee;/*検索ボックスの背景カラー*/
}
.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 10px;
}

</style>
<div id="loader-bg">
<img src="img/ajax-loader (4).gif">
</div>
<div class="loading hide">
<img src="img/ajax-loader (4).gif">
</div>

<script>
jQuery(window).on("load", function() {
jQuery('#loader-bg').hide();
});
var $submitBtn = $('button[type="submit"]');
$submitBtn.on('click',function(){
setTimeout(function(){
$('body').append('<div class="loading"><img src="loading.gif" /></div>');
},100);
});
</script>
<script language="JavaScript">
<!--
function Check(){
if(document.sati.search.value==""){
alert("コメントを入力してください。");
return	false;
}

return	true;
}
//	-->
</script>

<script language="JavaScript">
<!--
function Check2(){
if(document.satim.search.value==""){
alert("コメントを入力してください。");
return	false;
}

return	true;
}
//	-->
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>
<script type="text/javascript">
function i() {
var browser = document.fmk.s.value;
location.href = browser;
}
</script>
<!-- <script type="text/javascript">
$(function () {
  var count = 0;
  $(document).on('click','#start2',function(){
     progress(count);
  });
  $(document).on('click','#back2',function(){
    $("#pgss2").css({'width':'0%'});
  });

  function progress(count){
    setTimeout(function(){
      $("#pgss2").css({'width':count+'%'});
      count++;
      if(count == 90) return;
      progress(count);
    },100);
  }
})
</script> -->
<script>
<!--
$(function(){
// ファイルのアップロード処理
var uploadFiles = function(files) {
    // FormDataオブジェクトを用意
    var fd = new FormData();

    // ファイルの個数を取得
    var filesLength = files.length;
//         var member_id = $('#member_id').val();
// if (member_id) {
//
// }else {
//   member_id = 1;
// }
//             console.log(member_id);
//
// fd.append(member_id);
    // ファイル情報を追加
    for (var i = 0; i < filesLength; i++) {
        console.log(files[i]["name"]);
        fd.append("files[]", files[i]);
    }

    // Ajaxでアップロード処理をするファイルへ内容渡す
    $.ajax({
        url: 'https://getleak.net/image.movie.php',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        cache: false,
        xhr : function(){
            var XHR = $.ajaxSettings.xhr();
            XHR.upload.addEventListener('progress',function(e){
                var progre = parseInt(e.loaded/e.total * 100);
                $('#prog').val(progre);
                $('#pv').html(progre);
            });
            return XHR;
        }


    }).done(function(data) {
        console.log(data);
        $('#sort').html(data);
$("#datavalue").remove();
    }).fail(function(data) {
        alert('問題が発生しました。');
        console.log(data.responseText);
    });
};

// ファイルドロップ時の処理
$('#drag-area').on('drop', function(e){
    // デフォルトの挙動を停止
    e.preventDefault();

    // ファイル情報を取得
    var files = e.originalEvent.dataTransfer.files;
    uploadFiles(files);


// デフォルトの挙動を停止　これがないと、ブラウザーによりファイルが開かれる
}).on('dragenter', function(){
    return false;
}).on('dragover', function(){
    return false;
});


// ボタンを押した時の処理
$('#btn').on('click', function() {
    // ダミーボタンとinput[type="file"]を連動
    $('#file_selecter').click();
});

$('#file_selecter').on('change', function(){
    // ファイル情報を取得
    var files = this.files;
    uploadFiles(files);
});

});
-->
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
var i = 0;

$(function() {

var $content = $('.field:last-child');
$('.add_btn').on('click', function() {
i++;
  $content.clone(true).insertAfter('.parent').

  attr('id',i).  //上で取得した要素の中のidをiとする
  appendTo("#sort");

  $("#result").val(i);

  // $('#data').attr('value', i);
    //#rootsに追加

}

);

$('#sort').sortable({

update: function(){
var log = $(this).sortable("toArray");
$("#log").html('<input type="text" id="datavalue" value='+ log +'>');

}
});

//削除
$('.trash_btn').on('click', function() {
$(this).parents('.field').remove();
});
});


</script>



</head>
<style>

ul.jquery-ui-sortable {
list-style-type: none;
margin: 0;
padding: 0;
width: 70%;
}
li.jquery-ui-sortable-item {
margin: 5px;
padding: 0.5em;
border: 1px darkgray solid;
border-radius: 5px;
background-color: #fcfcfc;
}
li.jquery-ui-sortable-item div {
padding: 0 0 0 1em;
font-size: 15px;
font-weight: bold;
cursor: move;
border-radius: 5px;
}
li.jquery-ui-sortable-item ul {
font-size: 13px;
}

</style>
<style type="text/css">

.hide {
  display: none;
}
.loading {
  position: fixed;
  top: 50%;
  left: 50%;
  right: 0;
  bottom: 0;
  height: 100%;
  width: 100%;
  background: rgba(0,0,0,.5);
  /* background-image: url(img/EARTH.jpg); */
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center center;

  background-size: 150px 150px;

   -webkit-transform: translate(-50%, -50%);
   -ms-transform: translate(-50%, -50%);
   transform: translate(-50%, -50%);
   z-index: 10;
}
.loading img{
  background: #fff;
  position: fixed;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  z-index: 10;
}

</style>


<body>

  <input type='hidden' id="member_id" value="<?php echo $member_id;?>">

<?php require 'navgetion/nav4.php';?>

  <nav class="d-none d-lg-block navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">
      <h1 style="font-size: 20px;">投稿を作成する</h1>
      <p>GetLeakは全世界すべての方が無料でアップロードすることが可能です。あなたの情報を公開してみよう!!</p>
  </nav>

  <div class=" d-block d-lg-none">
      <nav class="navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">
          <h1 style="font-size: 20px;">投稿を作成する</h1>
          <p>GetLeakは全世界すべての方が無料でアップロードすることが可能です。あなたの情報を公開してみよう!!</p>
      </nav>
  </div>
<div class="container">
<!-- Grid row -->

<div class="row">


<!-- Grid column -->
<div class="col-md-8">
<br>
  <?php if ($completion): ?>
<br>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong><?php echo $completion;?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php endif; ?>

<?php foreach ($errormsg as $msg): ?>
<div class="alert alert-danger" role="alert">
※<?=$msg?><br />
</div>
<?php endforeach; ?>

<p id="res"></p>



<form id="my_form">
<div class="card ">
<div class="card-header">
<nav>
<div class="nav nav-tabs md-tabs" id="nav-tab" role="tablist">
<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
aria-controls="nav-home" aria-selected="true">記事</a>
<a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-image" role="tab"
aria-controls="nav-home" aria-selected="true">画像・動画</a>
</div>
</nav>
</div>
<div class="card-body">
<div class="tab-content " id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<select class="custom-select browser-default" name="kategori" id="kokuseki"  maxlength="255"  value=""/>
<?php if($_POST['kategori']){ ?><OPTION value="<?php echo $_POST['kategori'];?>"><?php echo $_POST['kategori'];?></OPTION><?php } ?>

<?php   for ($i = 200; ; $i++) {
if ($i > 215) {break;}?>

<OPTION value="<?php echo $db_conf[$i]; ?>"><?php echo $db_conf[$i]; ?></OPTION>
<?php }?>

</select>

<br>  <br>
<input name="taitol"id="title" class="form-control form-control-lg" type="text"value="" placeholder="タイトルを入力して下さい"/>
<br>
    <input id="templete1" type="hidden" value="ヒント">

    <!-- Create the editor container -->
    <div id="editor1"></div>
<br>
    <input type="text"id="tag" name="tags"placeholder="キーワードを入力して下さい" value="" data-role="tagsinput" />
    <br><br>
    <button type="button" style="border-radius: 30px;"  id="start2">投稿する</button>
    <br>
</div>

<div class="tab-pane " id="nav-image" role="tabpanel" aria-labelledby="nav-home-tab">
  <input type='hidden' id="member_id" value="<?php echo $member_id;?>">
<div id="drag-area" style="border-style: dashed;background-color: #042943; color: #ffffff;">
<p>アップロードするファイルをドロップ</p>
<p>または</p>
<div class="btn-group">
 <input id="file_selecter" type="file" multiple="multiple" style="display:none;" name="files"/>
 <p id="btn">ファイルを選択</p>
</div>
</div>
<br>
<progress value="0" id="prog" max=100></progress>(<span id="pv" style="color:#00b200">0</span>%)

<script>
   $(function(){
     $('#sort').sortable();
   }
 );

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <div id="sort" class="parent">
   </div>

<p id="log" name="log[]"></p>


  </div>
</div>

</div>

</div>

</form>

</div>
<div class="col-md-4 d-none d-sm-block">

    <?php require_once('right-menu.php');?>
</div>

</div>
</div>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>

<script src="dist/bootstrap-tagsinput.min.js"></script>
<script src="dist/bootstrap-tagsinput/bootstrap-tagsinput-angular.min.js"></script>

  <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Promise" crossorigin="anonymous"></script>


  <script src="dist/quill.htmlEditButton.min.js"></script>
  <script>
      var Delta = Quill.import('delta');
      Quill.register("modules/htmlEditButton", htmlEditButton);

      const fullToolbarOptions = [
          [{ header: [1, 2, 3, false] }],
          ['bold', 'italic', 'underline', 'strike'],
          ['blockquote', 'code-block'],
          // [{'header': 1}, {'header': 2}],
          // [{'list': 'ordered'}, {'list': 'bullet'}],
          // [{'script': 'sub'}, {'script': 'super'}],
          // [{'indent': '-1'}, {'indent': '+1'}],
          // [{'direction': 'rtl'}],
          ['link', 'image', 'video', 'formula'],
          [{'color': []}, {'background': []}]
          // [{'font': []}],
          // [{'align': []}]
      ];

      var quill = new Quill("#editor1", {
          theme: "snow",
          modules: {
              toolbar: {
                  container: fullToolbarOptions
              },
              htmlEditButton: {}
          }
      });

      document.getElementById('btnContent').addEventListener('click', function() {
          console.log(quill.getContents());
      });

      document.getElementById('btnImage').addEventListener('click', function() {
          // このあたりを工夫すればクリップボードからの画像貼り付け等ができそう・・
          console.log(quill.getSelection(true).index);
          quill.insertEmbed(quill.getSelection(true).index, 'image', 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png');
      });

      let enableEditor = false;
      document.getElementById('btnDisable').addEventListener('click', function() {
          quill.enable(enableEditor);
          enableEditor = !enableEditor;
          console.log(enableEditor);
      });


      /**
       * ペーストのイベント追加例
       */
      quill.root.addEventListener("paste", function (t) {
          console.log('paste');
          console.log(t);
          return true;
      } , false);


  </script>
</body>
</html>
