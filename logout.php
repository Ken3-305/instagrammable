<?php
session_start();

if (isset($_SESSION["NAME"])) {
  $mes = "ログアウトしました。";
  // セッションの変数のクリア
  unset($_SESSION["NAME"]);
} else {
  $mes = "セッションがタイムアウトしました。";
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet"href="style.css">
    <title>ログアウト</title>
  </head>
  <body>
    
    <h1>LOGOUT</h1>
    <div class="errorMes">
      <?php echo htmlspecialchars($mes, ENT_QUOTES); ?>
    </div>
    
     <a href="login.php" class="log">LOGIN</a>
    
    
  </body>
</html>
