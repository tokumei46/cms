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
    $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
    $user = "root";
    $password = "root";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT name FROM img WHERE1";
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();

    while(true) {
        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        if(empty($rec["name"]) === true) {
            break;
        }
        echo "<img src='img/".$rec['name']."'>";
        echo $rec["name"];
        echo "<br>";
    }
    ?>
</body>
</html>