<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
   echo "ログインしていません<br>";
   echo "<a href='set_login.php'>ログイン画面へ</a>";
   exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>cmsログアウト</title>
      <link rel="stylesheet" href="../style.css">
   </head>
   <body>
      <p>ログアウトしました</p><br>
      <a href="set_login.php">ログイン画面へ</a>
   </body>
</html>