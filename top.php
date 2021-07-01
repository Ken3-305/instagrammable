<?php
session_start();
if (!isset($_SESSION["NAME"])) {
  header("Location:login.php");
  exit;
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet"href="style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <title>なんでもインスタ映え</title>
  </head>
  <body>


    <h1>Instagramalization</h1>
    <h2>～なんでもインスタ映え～</h2>

    <a href="logout.php" class="log"> LOGOUT</a>
    <br>
    <div class="container">

    <ul class="doing">
      <li><a href="photoEditor1.html" class="btn"> Filter</a></li>
       <br><p>写真を好きなテイストに変えることが出来るよ！</p>
      <li><a href="paint.html" class="btn"> Paint</a></li>
      <br><p>写真に自由にお絵かきできるよ！</p>
    </ul>

  </div>
  <ul class="link">
    <!-- <li><a href="https://www.instagram.com/cmp2_8/?hl=ja" class="fl_inst">
      <span class="insta"><i class="fa fa-instagram"></i></span> Instagram</a>
    </li><br> -->
     <li><a href="https://twitter.com/cmp2_8" class="fl_tw">
      <span class="twicon"><i class="fa fa-twitter"></i></span> Twitter</a>
  </li>
  </ul>

  <!-- Instagramタイムライン -->
  <div class="instagram-timeline">
    <div class="instagram-profile" id="js-insta-profile">
    </div>
    <ul id="js-instagram">
    </ul>
  </div>
  <!-- Instagramタイムラインここまで -->
  </body>
  <script>
  // Instagramのタイムランを埋め込むJS
  function getJsonInsta(json){
    var instTimeline = document.getElementById('js-instagram');
    var profArea = document.getElementById('js-insta-profile');
    var username = 'cmp2_8';
    var profile = json.data[0].user;
    var url = 'https://www.instagram.com/'+profile.username+'/';
    var profData = html = '';
    profData += "<a href='"+url+"' target='_blank'><img src='"+profile.profile_picture+"' alt=''></a>"
    profData += "<a href='"+url+"' target='_blank'>@"+profile.username+"</a>";
    for(var i=0;i<json.data.length;i++) {
      var item = json.data[i];
      var imgurl = item.images.low_resolution.url; //画像のURLを取得
      var link = item.link; //リンクを取得
      html += "<li><a href='" + link + "' target='_blank'><img src='" + imgurl + "'></a></li>";
    }
    //profArea.innerHTML = profData;
    instTimeline.innerHTML = html;
  }
  (function(){
    var accessToken = '6891746260.2f84c86.7c84577624b44670beb691cce1644709';
    var script = document.createElement('script');
    script.src = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='+accessToken+'&callback=getJsonInsta';
    document.body.appendChild(script);
  }());
  </script>
</html>
