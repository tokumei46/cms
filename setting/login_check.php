<?php
try {
    require_once("../common/common.php");
    
    $post = sanitize($_POST);
    $name = $post["name"];
    $pass = $post["pass"];
    $pass2 = $post["pass2"];

    if(empty($name) === true or empty($pass) === true or $pass != $pass2) {
        echo "ログイン情報が間違っています<br>";
        echo "<form>";
        echo "<input type='button' onclick='history.back()' value='戻る'>";
        echo "</form>";
        exit();
    }

    $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
    $user = "root";
    $password = "root";
    $dbh = new PDO($dsn, $user, $password);
    $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT name FROM login WHERE name=? && password=?";
    $stmt = $dbh -> prepare($sql);
    $data[] = $name;
    $data[] = $pass;
    $stmt -> execute($data);

    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec["name"]) === true) {
        echo "ログイン情報が間違えています<br>";
        echo "<form>";
        echo "<input type='button' onclick='history.back()' value='戻る'>";
        echo "</form>";
        exit();
    }
    session_start();
    $_SESSION["login"] = 1;
    $_SESSION["name"] = $rec["name"];
    header("Location:set_top.php");
}
catch(Exception $e) {
    echo ("障害が発生しています<br>". $e->getMessage);
}
