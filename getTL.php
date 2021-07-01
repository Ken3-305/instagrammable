<?php
//POSTリクエストの場合のみ受付
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //アクセストークン
    $access_token = "6891746260.2f84c86.7c84577624b44670beb691cce1644709";
    //JSONデータを取得して出力
    echo @file_get_contents("https://api.instagram.com/v1/users/self/media/recent/?access_token={$access_token}");
    exit;
}
 ?>
