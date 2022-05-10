<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
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
   <title>親カテゴリー</title>
   <link rel="stylesheet" href="../style.css">
</head>

<body>
   <?php
   try {
      $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
      $user = "root";
      $password = "root";
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT name FROM o_menu WHERE1";
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      $dbh = null;
      echo "親メニュー一覧<br>";

      while (true) {
         $rec = $stmt->fetch(PDO::FETCH_ASSOC);
         if (empty($rec["name"]) === true) {
            break;
         }
         $o_name[] = $rec["name"];
         echo "." . $rec["name"] . "<br>";
      }
      if (empty($o_name) === true) {
         echo "なし<br>";
      }
   } catch (Exception $e) {
      echo ("サーバーに異常が発生しました" . $e->getMessage);
      echo "<a href='set_top.php'>cmsトップへ</a>";
      exit();
   }
   ?>
   <br>
   <form action="o_menu_add_done.php" method="post">
      <p>親メニュー追加</p>
      <input type="text" name="name">
      <br><br>
      <input type="button" onclick="history.back()" value="戻る">
      <input type="submit" value="OK">
   </form>
</body>

</html>