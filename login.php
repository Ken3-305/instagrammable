<?php
session_start();

function h ($str){
  return htmlspecialchars($str, ENT_QUOTES);
}

 //エラーメッセージ初期化
$errorMes = "";

if (isset($_POST["name"])) { //入力されているかチェック
  $input_name = h($_POST["name"]);
  $input_pass = h($_POST["pass"]);

  try { //ログイン処理
    $pdo = new PDO("sqlite:CMP.sqlite");
    $st = $pdo->prepare("SELECT * FROM userlist WHERE name = ?");
    $st->execute(array($input_name));


    if ($row = $st->fetch()) {  //入力された名前のアカウントがあったら
      if ($input_pass == $row["password"]) {  //パスワードの一致確認
        session_regenerate_id();

        $_SESSION["NAME"] = h($row["name"]);
        header("Location:top.php");
        exit;

      } else {  //パスワードが一致しなかったとき
        $errorMes = "入力情報に誤りがあります";
      }
    } else {  //入力されたアカウントがなかった時
      $errorMes = "登録されていません";
    }
  } catch (Exception $e) {  //ログインに失敗(システム的に)
    $errorMes = "ログインに失敗しました";
  }

}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet"href="style.css">
     <title>LOGIN</title>
   </head>

   <body>
     <h1>LOGIN</h1>

     <!-- エラーメッセージ -->
     <div class="errorMes"><font color="#ff0000"><?php echo h($errorMes); ?></font></div>

     <form class="login_from" method="post" name="loginFrom" action="login.php" >
       <div class="container">
       <input type="text" name="name" placeholder="User Name" value="<?php if(isset($_POST["name"]))echo h($_POST["name"]); ?>" required class="write">
       <br><input type="password" name="pass" placeholder="PassWord" required class="write">
       <br><input id="submit_button" type="submit" value="LOGIN" >
      </div>
      </form>

     <a href="signup.php" class="log">Make account</a>
   </body>
 </html>
