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
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    try {
        $code = filter_input(INPUT_GET, "code");
        $id = filter_input(INPUT_GET, "id");

        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET["flag"]) === true) {
            $sql = "DELETE FROM karicm WHERE id=? && code=?";
            $stmt = $dbh -> prepare($sql);
            $data[] = $id;
            $data[] = $code;
            $stmt -> execute($data);

            $dbh = null;
            echo "コメントを削除しました<br>";
            echo "<a href='set_top.php'>TOPへ戻る</a>";
            exit();
        }
        $sql = "SELECT * FROM karicm WHERE id=? && code=?";
        $stmt = $dbh -> prepare($sql);
        $data[] = $id;
        $data[] = $code;
        $stmt -> execute($data);
        $data = array();

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

        $name = $rec["name"];
        $honbun = $rec["honbun"];
        $title = $rec["title"];
        $time = $rec["time"];
        $re = $rec["re"];

        $sql = "INSERT INTO honcm(name, honbun, id, re, title, time) VALUES(?,?,?,?,?,NOW())";
        $stmt = $dbh -> prepare($sql);
        $data[] = $name;
        $data[] = $honbun;
        $data[] = $id;
        $data[] = $re;
        $data[] = $title;
        $stmt -> execute($data);
        $data = array();

        $sql = "DELETE FROM karicm WHERE id=? && code=?";
        $stmt = $dbh -> prepare($sql);
        $data[] = $id;
        $data[] = $code;
        $stmt -> execute($data);

        $dbh = null;
        
        echo "コメントを承認しました<br>";
        echo "<a href='set_top.php'>TOPへ戻る</a>";
    }
    catch(Exception $e) {
        echo ("異常が発生しました<br>". $e->getMessage());
        echo "<a href='set_top.php'>cmsトップへ</a>";
    }
    ?>
</body>
</html>