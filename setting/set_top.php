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
      <title>cms</title>
      <link rel="stylesheet" href="../style.css">
   </head>
   <body>
      <a href='../index.php'>投稿一覧</a>
      <strong>カテゴリー追加</strong><br>
      <a href="o_menu_add.php">親カテゴリ追加</a>
      <br>
      <a href="k_menu_add.php">子カテゴリ追加</a>
      <br><br>
      <strong>記事投稿</strong><br>
      <a href="../edit_single.php">新規記事作成</a>
      <br><br>
      <strong>メニュー追加</strong><br>
      <a href="../edit_page.php">固定ページ作成</a>
      <br><br>
      <strong>プロフィール</strong><br>
      <a href="pro.php">プロフィール作成</a>
      <br><br>
      <strong>スポンサー</strong><br>
      <a href="sp.php">スポンサーリンク作成</a>
      <br><br>
      <strong>コメントチェック</strong><br>
      <a href="comment_check.php">コメント認証・削除</a>
      <br>
      <a href="comment_list.php">コメントリスト・返信</a>
      <br><br>
      <strong>ログアウト</strong><br>
      <a href="logout.php">ログアウト</a>
   </body>
</html>