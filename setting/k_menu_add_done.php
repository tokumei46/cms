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
    <title>子カテゴリー</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    try {
        
        require_once("../common/common.php");
        $post = sanitize($_POST);
        $name = $post["name"];
        $o_menu = $post["oya"];

        if (empty($name) === true) {
            echo "メニュー名を入力してください。<br>";
            echo "<a href='k_menu_add.php'>戻る</a>";
            exit();
        }
        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT name FROM k_menu WHERE1";
        $stmt = $dbh -> prepare($sql);
        $stmt->execute();

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($rec["name"]) === true) {
                break;
            }
            $k_name[] = $rec["name"];
        }
        if (empty($k_name) === false) {
            if (in_array($name, $k_name) === true) {
                echo "すでに登録されている項目です<br>";
                echo "<a href='k_menu_add.php'>戻る</a>";
                exit();
            }
        }
        $sql = "SELECT code FROM o_menu WHERE name=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $o_menu;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $o_code = $rec["code"];
        $data = array();

        $sql = "INSERT INTO k_menu(name, o_code) VALUES(?,?)";
        $stmt = $dbh->prepare($sql);
        $data[] = $name;
        $data[] = $o_code;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        echo ("サーバーに異常が発生しました" . $e->getMessage());
        echo "<a href='set_top.php'>cmsトップへ</a>";
    }
    ?>
    <h2>子メニューを追加しました。<br></h2>
    <a href="k_menu_add.php">子メニューへ</a>
    <br>
    <a href="set_top.php">トップメニューへ</a>
</body>
</html>