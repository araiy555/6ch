<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
<body>
<?php
require_once("phpQuery-onefile.php");
 
// HTML�f�[�^���擾����
$HTMLData = file_get_contents('https://news.yahoo.co.jp/');
// HTML���I�u�W�F�N�g�Ƃ��Ĉ���
$phpQueryObj = phpQuery::newDocument($HTMLData);
 
// h1�^�O��Ђ��[����Ԃ��
foreach($phpQueryObj['body'] as $val) {
  // �A�����s����Ɠ{��ꂿ�Ⴄ�̂łƂ肠����5�b�ҋ@
  sleep(5);
 
  // pq()���\�b�h�ŃI�u�W�F�N�g�Ƃ��čĐݒ肵����ɉ�����href���擾
  $title = pq($val)->find('a')->text();
  $url = pq($val)->find('a')->attr('href');
  echo 'IT�E�Ȋw�j���[�X - Yahoo!�j���[�X�F' . $title . PHP_EOL;
  echo 'https://news.yahoo.co.jp/hl?c=c_sci�F'. $url . PHP_EOL;
	echo "<br><br>";
  getChiledPage($url);
 
  echo PHP_EOL.PHP_EOL;
}

foreach ($phpQueryObj->find('img') as $img){
    $src = $img->getAttribute('src');
    echo $src,'<br>';   

}

// h1�^�O��Ђ��[����Ԃ��
foreach($phpQueryObj['href'] as $val) {
  // �A�����s����Ɠ{��ꂿ�Ⴄ�̂łƂ肠����5�b�ҋ@
  sleep(5);
 
  // pq()���\�b�h�ŃI�u�W�F�N�g�Ƃ��čĐݒ肵����ɉ�����href���擾
  $title = pq($val)->find('a')->text();
  $url = pq($val)->find('a')->attr('href');
  echo 'IT�E�Ȋw�j���[�X - Yahoo!�j���[�X�F' . $title . PHP_EOL;
  echo 'https://news.yahoo.co.jp/hl?c=c_sci�F'. $url . PHP_EOL;
	echo "<br><br>";
  getChiledPage($url);
 
  echo PHP_EOL.PHP_EOL;
}

/**
* ������닣�������Ⴄ�ƌ��Ȃ̂Ŋ֐���
* �����o�����擾���ďo��
* @param string $url �q�y�[�W��URL
*/
function getChiledPage($url) {
  // �y�[�W���擾���ăI�u�W�F�N�g���I
  $phpQueryObj = phpQuery::newDocument(file_get_contents($url));
 
  // ���[�v�łԂ��
  foreach($phpQueryObj['href'] as $i => $val) {
    $komidashi = pq($val)->text();
    echo '�����o��['. $i .']�F' . $komidashi . PHP_EOL;
  }
}
?>

</body>
</html>