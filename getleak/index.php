<?php
session_start();

error_reporting(0);
require('dbconnect.php');
$db_conf = include_once 'config.php';
if (isset($_COOKIE['email']) && $_COOKIE['email'] !='') {
    $_POST['email'] = $_COOKIE['email'];
    $_POST['password'] = $_COOKIE['password'];
    $_POST['save'] = 'on';
}
if (!empty($_POST)) {
    if ($_POST['email'] !=='' && $_POST['password'] !=="") {
    $sql = sprintf('SELECT * FROM members WHERE email="%s"',
    mysql_real_escape_string($_POST['email'])
    );
$record = mysql_query($sql) or die(mysql_error());
if ($table = mysql_fetch_assoc($record)) {
if (password_verify($_POST['password'], $table['password'])) {
$_SESSION['id'] = $table['id'];
$_SESSION['time'] = time();
if ($_POST['save'] =='on') {
setcookie('email', $_POST['email'], time()+60*60*24*14);
setcookie('password', $_POST['password'], time()+60*60*24*14);
}$login = 'login';}}}}
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600000000000000000 > time()) {
    $_SESSION['time'] = time();
    $sql=sprintf('SELECT * FROM members WHERE id=%d',
        mysql_real_escape_string($_SESSION['id'])
    );
    $record = mysql_query($sql) or die(mysql_query());
    $member = mysql_fetch_assoc($record);
}
$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
$languages = array_reverse($languages);
$file= dirname($_SERVER["SCRIPT_NAME"]);
//$local = 'http://localhost';
$local = 'https://getleak.net';
$result = '';
foreach ($languages as $language) {
    if (preg_match('/^ja/i', $language)) {
        $result = 'ja';
    // } elseif (preg_match('/^en/i', $language)) {
    //     $result = 'en';
    // } elseif (preg_match('/^zh/i', $language)) {
    //     $result = 'zh';
    }else {
        $result = 'ja';
    }
}

if (isset($_GET['filter'])) {
  $filter = $_GET['filter'];
}else {
  $filter = 'normal';
}
if ($result == 'ja') {
    if (isset($_GET['category']) && $_GET['category']) {
        $value = $_GET['category'];
    }
    if (isset($value) && $value) {

        if ($value == 'person') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=person&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=person&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=person&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=person');
                }
            }
        }
        if ($value == 'original') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=original&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=original&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=original&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=original');
                }
            }
        }
        if ($value == 'news') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=news&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=news&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=news&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=news');
                }
            }
        }
        if ($value == 'video') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=video&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=video&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=video&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=video');
                }
            }
        }
        if ($value == 'book') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=book&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=book&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=book&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=book');
                }
            }
        }
        if ($value == 'comic') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=comic&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=comic&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=comic&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=comic');
                }
            }
            exit;
        }
        if ($value == 'novel') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=novel&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=novel&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=novel&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=novel');
                }
            }
        }
        if ($value == 'picture') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=picture&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=picture&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=picture&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=picture');
                }
            }
        }
        if ($value == 'magazine') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazine&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazine&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazine&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazine');
                }
            }
        }
        if ($value == 'movie') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=movie&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=movie&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=movie&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=movie');
                }
            }
        }
        if ($value == 'music') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=music&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=music&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=music&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=music');
                }
            }
        }
        if ($value == 'anime') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=anime&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=anime&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=anime&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=anime');
                }
            }
        }
        if ($value == 'game') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=game&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=game&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=game&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=game');
                }
            }
        }
        if ($value == 'society') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=society&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=society&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=society&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=society');
                }
            }
        }
        if ($value == 'Entertainment') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Entertainment&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Entertainment&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Entertainment&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Entertainment');
                }
            }
        }
        if ($value == 'science') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=science&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=science&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=science&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=science');
                }
            }
        }
        if ($value == 'Gourmet') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Gourmet&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Gourmet&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Gourmet&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Gourmet');
                }
            }
        }
        if ($value == 'Sport') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Sport&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Sport&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Sport&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Sport');
                }
            }
        }
        if ($value == 'New') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=New&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=New&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=New&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=New');
                }
            }
        }
        if ($value == 'climax') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=climax&page='.$_GET['page'].'&login='.$member['id'].'&filter='.$filter.'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=climax&login='.$member['id'].'&filter='.$filter.'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=climax&page='.$_GET['page'].'&filter='.$filter.'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=climax&filter='.$filter.'');
                }
            }
        }
        if ($value == 'populer') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=populer&page='.$_GET['page'].'&login='.$member['id'].'&filter='.$filter.'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=populer&login='.$member['id'].'&filter='.$filter.'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=populer&page='.$_GET['page'].'&filter='.$filter.'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=populer&filter='.$filter.'');
                }
            }
        }
        if ($value == '男性') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=男性&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=男性&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=男性&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=男性');
                }
            }
        }
        if ($value == '女性') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=女性&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=女性&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=女性&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=女性');
                }
            }
        }
        if ($value == 'ascending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=ascending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=ascending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=ascending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=ascending');
                }
            }
        }
        if ($value == 'descending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=descending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=descending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=descending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=descending');
                }
            }
        }
        if ($value == 'ImageAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=ImageAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=ImageAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=ImageAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=ImageAscending');
                }
            }
        }
        if ($value == 'Imagedescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Imagedescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Imagedescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Imagedescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Imagedescending');
                }
            }
        }
        if ($value == 'videoAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=videoAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=videoAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=videoAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=videoAscending');
                }
            }
        }
        if ($value == 'videodescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=videodescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=videodescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=videodescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=videodescending');
                }
            }
        }
        if ($value == 'bookAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=bookAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=bookAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=bookAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=bookAscending');
                }
            }
        }
        if ($value == 'bookdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=bookdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=bookdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=bookdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=bookdescending');
                }
            }
        }

        if ($value == 'cartoon') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=cartoondescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=cartoondescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=cartoondescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=cartoondescending');
                }
            }
        }

        if ($value == 'comicAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=comicAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=comicAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=comicAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=comicAscending');
                }
            }
        }
        if ($value == 'comicdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=comicdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=comicdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=comicdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=comicdescending');
                }
            }
        }
        if ($value == 'novelAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=novelAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=novelAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=novelAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=novelAscending');
                }
            }
        }
        if ($value == 'noveldescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=noveldescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=noveldescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=noveldescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=noveldescending');
                }
            }
        }
        if ($value == 'animeAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=animeAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=animeAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=animeAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=animeAscending');
                }
            }
        }
        if ($value == 'animedescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=animedescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=animedescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=animedescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=animedescending');
                }
            }
        }
        if ($value == 'magazineAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazineAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazineAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazineAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazineAscending');
                }
            }
        }
        if ($value == 'magazinedescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazinedescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazinedescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazinedescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=magazinedescending');
                }
            }
        }
        if ($value == 'pictureAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=pictureAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=pictureAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=pictureAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=pictureAscending');
                }
            }
        }
        if ($value == 'picturedescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=picturedescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=picturedescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=picturedescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=picturedescending');
                }
            }
        }
        if ($value == 'societylAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=societyAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=societyAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=societyAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=societyAscending');
                }
            }
        }
        if ($value == 'societydescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=societydescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=societydescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=societydescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=societydescending');
                }
            }
        }
        if ($value == 'EntertainmentAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=EntertainmentAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=EntertainmentAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=EntertainmentAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=EntertainmentAscending');
                }
            }
        }
        if ($value == 'Entertainmentdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Entertainmentdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Entertainmentdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Entertainmentdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Entertainmentdescending');
                }
            }
        }
        if ($value == 'scienceAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=scienceAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=scienceAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=scienceAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=scienceAscending');
                }
            }
        }
        if ($value == 'sciencedescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=sciencedescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=sciencedescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=sciencedescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=sciencedescending');
                }
            }
        }
        if ($value == 'GourmetAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=GourmetAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=GourmetAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=GourmetAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=GourmetAscending');
                }
            }
        }
        if ($value == 'Gourmetdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Gourmetdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Gourmetdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Gourmetdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Gourmetdescending');
                }
            }
        }
        if ($value == 'SportAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=SportAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=SportAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=SportAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=SportAscending');
                }
            }
        }
        if ($value == 'Sportdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Sportdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Sportdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=Sportdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=Sportdescending');
                }
            }
        }
        if ($value == 'gameAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=gameAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=gameAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=gameAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=gameAscending');
                }
            }
        }
        if ($value == 'gamedescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=gamedescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=gamedescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=gamedescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=gamedescending');
                }
            }
        }
        if ($value == 'movieAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=movieAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=movieAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=movieAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=movieAscending');
                }
            }
        }
        if ($value == 'moviedescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=movieAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=movieAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=moviedescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=moviedescending');
                }
            }
        }
        if ($value == 'musicAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=musicAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=musicAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=musicAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=musicAscending');
                }
            }
        }
        if ($value == 'musicdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=musicdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=musicdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=musicdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=musicdescending');
                }
            }
        }
        if ($value == 'newsAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=newsAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=newsAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=newsAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=newsAscending');
                }
            }
        }
        if ($value == 'newsdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=newsdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=newsdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=newsdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=newsdescending');
                }
            }
        }

        if ($value == 'populerAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=populerAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=populerAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=populerAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=populerAscending');
                }
            }
        }
        if ($value == 'populerdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=populerdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=populerdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=populerdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=populerdescending');
                }
            }
        }
        if ($value == 'climaxAscending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=climaxAscending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=climaxAscending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=climaxAscending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=climaxAscending');
                }
            }
        }
        if ($value == 'climaxdescending') {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=climacdescending&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=climaxdescending&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category=climaxdescending&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category=climaxdescending');
                }
            }
        }
        //国籍
        for ($i = 1; ; $i++) {
            if ($i > 64) {
                break;
            }
            if ($value == $db_conf[$i]) {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=nationality&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=nationality&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=nationality&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=nationality');
                }
            }
        }
    }
        for ($i = 100; ; $i++) {
            if ($i > 128) {
                break;
            }
            if ($value == $db_conf[$i]) {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=job&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=job&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=job&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=job');
                }
            }
        }
        }
        for ($i = 129; ; $i++) {
            if ($i > 136) {
                break;
            }
            if ($value == $db_conf[$i]) {
            if ($login) {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=age&page='.$_GET['page'].'&login='.$member['id'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=age&login='.$member['id'].'');
                }
            } else {
                if ($_GET['page']) {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=age&page='.$_GET['page'].'');
                } else {
                    include(''.$local.''.$file.'/taitol.login.php?category='.$db_conf[$i].'&no=age');
                }
            }
        }
        }
        header('Location: http://getleak.net/');
        exit;
    } else {
        if (isset($login) && $login) {
            if ($_GET['page']) {
                require(''.$local.''.$file.'/taitol.login.php?page='.$_GET['page'].'&login='.$member['id'].'');
            } else {
                include(''.$local.''.$file.'/taitol.login.php?login='.$member['id'].'');
            }
        } else {
            if (isset($_GET['page']) && $_GET['page']) {
                require(''.$local.''.$file.'/taitol.php?page='.$_GET['page'].'');
            } else {
                include(''.$local.''.$file.'/taitol.php');
            }
        }
    }
}

?>
