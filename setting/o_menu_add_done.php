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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    try {
        require_once("../common/common.php");
        $post = sanitize($_POST);
        $name = $post["name"];

        if (empty($name) === true) {
            echo "メニューを入力してください<br>";
            echo "<a href='o_menu_add.php'>戻る</a>";
            exit();
        }

        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT name FROM o_menu WHERE1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($rec["name"]) === true) {
                break;
            }
            $o_name[] = $rec["name"];
        }
        if (empty($o_name) === false) {
            if (in_array($name, $o_name) === true) {
                echo "すでに登録されている項目です。 <br>";
                echo "<a href='o_menu_add.php'>戻る</a>";
                exit();
            }
        }
        $sql = "INSERT INTO o_menu(name) VALUES(?)";
        $stmt = $dbh->prepare($sql);
        $data[] = $name;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        echo ("サーバーに異常が発生しました");
        echo "<br>";
        echo "<a href='set_top.php'>cmsトップへ</a>";
        exit();
    }
    ?>

    <h2>親メニューを追加しました。<br></h2>
    <a href="o_menu_add.php">親メニューへ</a>
    <br>
    <a href="set_top.php">トップメニューへ</a>
</body>

</html>