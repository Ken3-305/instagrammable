<?php
session_start();

function h ($str){
  return htmlspecialchars($str, ENT_QUOTES);
}

//エラーメッセージ初期化
$errorMes = "";

if (isset($_POST["signup"])) {  //入力されたかの判定
  $input_name = h($_POST["name"]);
  $input_pass = h($_POST["pass"]);

  $pdo = new PDO("sqlite:CMP.sqlite");
  $st = $pdo->prepare("SELECT name FROM userlist WHERE name=?");
  $st->execute(array($input_name));

  if ($row = $st->fetch()) { //入力されたユーザー名が既に使用されていないかどうかチェック
    $errorMes = "入力されたユーザー名は既に使用されています";
  } else {
    try { //signup処理
      session_regenerate_id();
      $st = $pdo->prepare("INSERT INTO userlist VALUES(?, ?, ?)");
      $st->execute(array(null, $input_name, $input_pass));
      $_SESSION["NAME"] = $input_name;
      header("Location:top.php");
      exit;
    } catch (Exception $e) {
      $errorMes = "作成に失敗しました";
    }
  }
}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet"href="style.css">
     <title>SIGNUP</title>
   </head>

   <body>
     <h1>Make Account</h1>
     <!-- エラーメッセージ -->
     <div class="errorMes"><font color="#ff0000"><?php echo h($errorMes); ?></font></div>

     <form class="login_from" method="post" name="loginFrom" action="signup.php" >
       <div class="container">
       <input type="text" name="name" placeholder="User Name" required class="write">
       <br><input type="password" name="pass" placeholder="PassWord" required class="write">
       <br><input id="submit_button" type="submit" value="MAKE" name="signup" >
       </div>
      </form>

     <a href="login.php" class="log">LOGIN</a>
   </body>
 </html>
