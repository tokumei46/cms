<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    echo "ログインしていません<br>";
    echo "<a href='setting/set_login.php'>ログイン画面へ</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>cms</title>
    <link rel="stylesheet" href="setting/style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h2>プロフィールを入力してください<br></h2>
    <h3>管理人名<br></h3>
    <form action="pro_check.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" require>
        <br>
        <h3>画像</h3>
        <input type="file" name="img">
        <br>
        <h3>紹介文</h3>
        <input type="textarea" name="honbun">
        <br><br>
        <input type="submit" value="OK">
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</body>
</html>