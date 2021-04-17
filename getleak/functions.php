function show_posts($userid){
    $posts = array();
 
    $sql = "select body, stamp from posts
     where user_id = '$userid' order by stamp desc";
    $result = mysql_query($sql);
 
    while($data = mysql_fetch_object($result)){
        $posts[] = array(   'stamp' => $data->stamp, 
                            'userid' => $userid, 
                            'body' => $data->body
                    );
    }
    return $posts;
 
}
function show_users(){
    $users = array();
    $sql = "select id, username from users where status='active' order by username";
    $result = mysql_query($sql);
 
    while ($data = mysql_fetch_object($result)){
        $users[$data->id] = $data->username;
    }
    return $users;
}