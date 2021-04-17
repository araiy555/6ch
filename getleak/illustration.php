<?php
session_start();
require('dbconnect.php');
// ログイン状態チェック
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
	$_SESSION['time'] = time();
	$sql=sprintf('SELECT * FROM members WHERE id=%d',
	mysql_real_escape_string($_SESSION['id']));
	$record = mysql_query($sql) or die(mysql_query());
	$member = mysql_fetch_assoc($record);
}else{
	header('Location: ../create.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php  require_once 'HTML/fabikon.php'; ?>

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


	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="dist/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.css">
	<link rel="stylesheet" href="assets/app.css">
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-42755476-1', 'bootstrap-tagsinput.github.io');
	ga('send', 'pageview');
	</script>



	<script type="text/javascript">
	<!--

		// XMLHttpRequestオブジェクトの生成
		function createXmlHttpRequest(){

			if(window.XMLHttpRequest){

				return new XMLHttpRequest();

			}else if(window.ActiveXObject){

				try {
						return new ActiveXObject("MSXML2.XMLHTTP.6.0");
				} catch (e) {
					try {
						 return new ActiveXObject("MSXML2.XMLHTTP.3.0");
					} catch (e2) {
						try {
								return new ActiveXObject("MSXML2.XMLHTTP");
						} catch (e3) {
							 return null
						}
					}
				}

			}else {
					return null
			}
		}

		// サーバーへHttpリクエストの送信
		function sendHttpRequest(files){

				// XMLHttpRequestオブジェクトの生成
				var xmlhttp = createXmlHttpRequest();

				// イベントの設定
				xmlhttp.onreadystatechange = function() {
					// レスポンスの処理が完了後、コールバック関数へ渡す
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							// コールバック
							XmlHttpCallback(xmlhttp);
					}
				}

				// フォームデータの生成(HTML5)
				var fd = new FormData();
				for (var i=0; i< files.length; i++) {
						fd.append("upfile[]",files[i]);
				}

				xmlhttp.open('POST', 'upload.php?drop=1', true);

				// サーバにHTTPリクエストを送信
				xmlhttp.send(fd);
		}

		// コールバック関数(クライアント側への表示)
		function XmlHttpCallback(xmlhttp){
				var result = document.getElementById("result");
				result.innerHTML = xmlhttp.responseText;
		}

		// *** アップロード用ドラッグ&ドロップ
		function onUpload_DragOver(event){
				// イベントのキャンセル
				event.preventDefault();
		}

		function onUpload_Drop(event){
				if (event.dataTransfer.files.length !=0){
						// まとめて送信する
						sendHttpRequest(event.dataTransfer.files);
				}
				// イベントのキャンセル
				event.preventDefault();
		}
	// -->



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
	</style>
	<div id="loader-bg">
	<img src="img/ajax-loader (4).gif">
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script>
	jQuery(window).on("load", function() {
	jQuery('#loader-bg').hide();
	});
	</script>











</head>


	<body class="grey lighten-4">

		<?php  require_once 'nav/nav2.php'; ?>

		  <div class="container">
				<br>
		<!-- Grid row -->
		<div class="row">


      <div class="tab-content pt-5" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <p>Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
            veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non
            irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim
            occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit.
            Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit
            occaecat anim ullamco ad duis occaecat ex.</p>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <p>Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna
            duis labore cillum sint adipisicing exercitation ipsum. Nostrud ut anim non exercitation velit laboris
            fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna consequat voluptate minim amet
            aliquip ipsum aute laboris nisi. Labore labore veniam irure irure ipsum pariatur mollit magna in
            cupidatat dolore magna irure esse tempor ad mollit. Dolore commodo nulla minim amet ipsum officia
            consectetur amet ullamco voluptate nisi commodo ea sit eu.</p>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
          <p>Sint sit mollit irure quis est nostrud cillum consequat Lorem esse do quis dolor esse fugiat sunt do. Eu
            ex commodo veniam Lorem aliquip laborum occaecat qui Lorem esse mollit dolore anim cupidatat. Deserunt
            officia id Lorem nostrud aute id commodo elit eiusmod enim irure amet eiusmod qui reprehenderit nostrud
            tempor. Fugiat ipsum excepteur in aliqua non et quis aliquip ad irure in labore cillum elit enim.
            Consequat aliquip incididunt ipsum et minim laborum laborum laborum et cillum labore. Deserunt
            adipisicing cillum id nulla minim nostrud labore eiusmod et amet. Laboris consequat consequat commodo non
            ut non aliquip reprehenderit nulla anim occaecat. Sunt sit ullamco reprehenderit irure ea ullamco Lorem
            aute nostrud magna.</p>
        </div>
      </div>

			  <div class="col-9">

					<form action="syoseki.toukou.php"onsubmit="return false;" method="post" enctype="multipart/form-data">
						<div class="card ">
								<div class="card-header">
                  <nav>
                    <div class="nav nav-tabs md-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home" aria-selected="true">記事</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Profile</a>

                    </div>
                  </nav>

                </div>
								<div class="card-body">

			    <div class="tab-content" id="nav-tabContent">
			      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

									<select class="custom-select browser-default" name="kategori" id="kokuseki"  maxlength="255"  value="<?php echo htmlspecialchars($_POST['kategori'],ENT_QUOTES,'UTF-8'); ?>"/>

										<OPTGROUP label="カテゴリ">
									<OPTION value="書籍">書籍</OPTION>
										<OPTION value="成人">成人向け</OPTION>
										<OPTION value="書籍">書籍</OPTION>

										</OPTGROUP>
									</select>
							</br>
							</br>



								<!-- Large input -->
								<input name="taitol"class="form-control form-control-lg" type="text" placeholder="タイトル"　value="<?php echo htmlspecialchars($_POST['taitol'],ENT_QUOTES,'UTF-8'); ?>"/>


							<br>

											<!--Textarea with icon prefix-->
											<div class="md-form">
													<i class="fa fa-pencil prefix"></i>
													<textarea type="text" name="kiji" id="form10" class="md-textarea form-control" rows="3" value="<?php echo htmlspecialchars($_POST['kiji'],ENT_QUOTES,'UTF-8'); ?>"/></textarea>
													<label for="form10">説明文</label>
											</div>







							<br>
							<input type="text" name="tags"placeholder="タグ" value="" data-role="tagsinput" />
							<br>

										<!-- Button trigger modal-->
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPush">投稿</button>

										<!--Modal: modalPush-->
										<div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										    <div class="modal-dialog modal-notify modal-info" role="document">
										        <!--Content-->
										        <div class="modal-content text-center">
										            <!--Header-->
										            <div class="modal-header d-flex justify-content-center">
										                <p class="heading">メッセージ</p>
										            </div>
										            <!--Body-->
										            <div class="modal-body">

										                <i class="fa fa-bell fa-4x animated rotateIn mb-4"></i>

										                <p>アップロードします、本当によろしいですか？</p>

										            </div>

										            <!--Footer-->
										            <div class="modal-footer flex-center">
																	<input type="button" class="btn btn-primary"value="はい" onclick="submit();">
																 <input type="button" class="btn btn-outline-primary waves-effect" value="いいえ" data-dismiss="modal">   </div>
										        </div>
										        <!--/.Content-->
										    </div>
										</div>

			      </div>
			      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
							<div ondragover="onUpload_DragOver(event)" ondrop="onUpload_Drop(event)">
							<input name="upfile[]" type="file" accept='image/*' multiple="multiple" />
						</div>

			      </div>
			      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
			        Ut ut do pariatur aliquip aliqua aliquip exercitation do nostrud commodo reprehenderit aute ipsum
			        voluptate. Irure Lorem et laboris nostrud amet cupidatat cupidatat anim do ut velit mollit consequat
			        enim tempor. Consectetur est minim nostrud nostrud consectetur irure labore voluptate irure. Ipsum id
			        Lorem sit sint voluptate est pariatur eu ad cupidatat et deserunt culpa sit eiusmod deserunt.
			        Consectetur et fugiat anim do eiusmod aliquip nulla laborum elit adipisicing pariatur cillum.
			      </div>
			      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
			        Irure enim occaecat labore sit qui aliquip reprehenderit amet velit. Deserunt ullamco ex elit nostrud
			        ut dolore nisi officia magna sit occaecat laboris sunt dolor. Nisi eu minim cillum occaecat aute est
			        cupidatat aliqua labore aute occaecat ea aliquip sunt amet. Aute mollit dolor ut exercitation irure
			        commodo non amet consectetur quis amet culpa. Quis ullamco nisi amet qui aute irure eu. Magna labore
			        dolor quis ex labore id nostrud deserunt dolor eiusmod eu pariatur culpa mollit in irure.
			      </div>
			    </div>
			  </div>
</div>
</div>
		</form>



<div class="col-md-3">
	<br>
	<div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

		<!-- Accordion card -->
		<div class="card">

			<!-- Card header -->
			<div class="card-header" role="tab" id="headingOne1">
				<a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
					aria-controls="collapseOne1">
					<h5 class="mb-0">
						Collapsible Group Item #1 <i class="fas fa-angle-down rotate-icon"></i>
					</h5>
				</a>
			</div>

			<!-- Card body -->
			<div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
				<div class="card-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
					wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
					eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
					assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
					nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
					farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
					labore sustainable VHS.
				</div>
			</div>

		</div>
		<!-- Accordion card -->

		<!-- Accordion card -->
		<div class="card">

			<!-- Card header -->
			<div class="card-header" role="tab" id="headingTwo2">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
					aria-expanded="false" aria-controls="collapseTwo2">
					<h5 class="mb-0">
						Collapsible Group Item #2 <i class="fas fa-angle-down rotate-icon"></i>
					</h5>
				</a>
			</div>

			<!-- Card body -->
			<div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
				<div class="card-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
					wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
					eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
					assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
					nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
					farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
					labore sustainable VHS.
				</div>
			</div>

		</div>
		<!-- Accordion card -->

		<!-- Accordion card -->
		<div class="card">

			<!-- Card header -->
			<div class="card-header" role="tab" id="headingThree3">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
					aria-expanded="false" aria-controls="collapseThree3">
					<h5 class="mb-0">
						Collapsible Group Item #3 <i class="fas fa-angle-down rotate-icon"></i>
					</h5>
				</a>
			</div>

			<!-- Card body -->
			<div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionEx">
				<div class="card-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
					wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
					eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
					assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
					nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
					farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
					labore sustainable VHS.
				</div>
			</div>


	</div>
</div>

</div>

		  <!-- JQuery -->
		  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		  <!-- Bootstrap tooltips -->
		  <script type="text/javascript" src="js/popper.min.js"></script>
		  <!-- Bootstrap core JavaScript -->
		  <script type="text/javascript" src="js/bootstrap.min.js"></script>
		  <!-- MDB core JavaScript -->
		  <script type="text/javascript" src="js/mdb.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
			<script src="dist/bootstrap-tagsinput.min.js"></script>
			<script src="dist/bootstrap-tagsinput/bootstrap-tagsinput-angular.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.js"></script>
			<script src="assets/app.js"></script>
			<script src="assets/app_bs3.js"></script>
</body>
</html>
