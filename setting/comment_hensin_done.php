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
    <?php
    try {

        $name= filter_input(INPUT_POST, "name");
        $hensin = filter_input(INPUT_POST, "hensin");
        $id = filter_input(INPUT_POST, "id");
        $code = filter_input(INPUT_POST, "code");

        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE honcm SET re=? WHERE id=? && code=?";
        $stmt = $dbh -> prepare($sql);
        $data[] = "OK";
        $data[] = $id;
        $data[] = $code;
        $stmt -> execute($data);
        $data = array();

        $sql = "INSERT INTO honcm(name, honbun, id, re, time) VALUES(?,?,?,?,NOW())";
        $stmt = $dbh -> prepare($sql);
        $data[] = $name;
        $data[] = $hensin;
        $data[] = $id;
        $data[] = "--";
    }
    catch (Exception $e) {
        echo ("只今障害が発生しています<br>". $e->getMessage());
        echo "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    }
    ?>
    <h3>コメントを返信しました<br></h3>
    <a href="set_top.php">トップへ戻る</a>
</body>
</html>