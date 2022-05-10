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
        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT name FROM o_menu WHERE1";
        $stmt = $dbh -> prepare($sql);
        $stmt -> execute();

        $dbh = null;

        while(true) {
            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
            if(empty($rec["name"]) === true) {
                break;
            }
            $o_name[] = $rec["name"];
        }
        if(empty($o_name) === true) {
            echo "親メニューがありません<br>";
            exit();
        }

        echo "親メニューを選択してください<br>";
        echo "<form action='k_menu_add_done.php' method='post'>";        
        echo "<select name='oya'>";

        $max = count($o_name);
        for($i = 0; $i < $max; $i++) {
            echo "<option value='".$o_name[$i]."'>".$o_name[$i]."</option>";
            echo "<br>";
        }
        echo "</select>";
        echo "<br>";
    }
    catch(Exception $e) {
        echo "サーバーにエラーが発生しました<br>";
        echo "<a href=''>cmsトップへ</a>";
        exit();
    }
    ?>
    <br>

    <h2>子メニュー追加</h2>
    <input type="text" name="name">
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
</form>
</body>
</html>