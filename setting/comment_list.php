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
        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM honcm WHERE1 ORDER BY code DESC";
        $stmt = $dbh -> prepare($sql);
        $stmt -> execute();

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

        if(empty($rec["name"]) === true) {
            echo "コメントがありません<br>";
            echo "<form>";
            echo "<input type='button' onclick='history.back()' value='戻る'>";
            echo "</form>";
            exit();
        }
        echo "コメント一覧<br>";
        echo $rec["title"]."　に対するコメント<br>";
        echo $rec["time"];
        echo "<br>";
        echo $rec["name"];
        echo "<br>";
        echo $rec["honbun"];
        echo "<br>";
        if(empty($rec["re"]) === true) {
            echo "<strong>未返信です</strong><br>";
            echo "<a href='comment_hensin.php?id=".$rec['id']."&code=".$rec['code']."&title=".$rec['title']."&honbun=".$rec['honbun']."'>";
            echo "返信する</a>";
        } else {
            echo  "<strong>送信済みです</strong><br>";
        }
        echo "<br>";

        while(true) {
            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
            if(empty($rec["name"]) === true) {
                break;
            }
            echo $rec["title"]."　に対するコメント<br>";
            echo $rec["time"];
            echo "<br>";
            echo $rec["name"];
            echo "<br>";
            echo $rec["honbun"];
            echo "<br>";
            if(empty($rec["re"]) === true) {
            echo "<strong>未返信です</strong><br>";
            echo "<a href='comment_hensin.php?id=".$rec['id']."&code=".$rec['code']."&title=".$rec['title']."&honbun=".$rec['honbun']."'>";
            echo "返信する</a>";    
            } else {
            echo "<strong>返信済です</strong><br>";
            }
            echo "<br><br>";
        }
        $dbh = null;
        }
    catch(Exception $e) {
        echo "サーバーに異常が発生しています<br>";
        echo "<a href='set_top.php'>cmsトップへ</a>";
    }
    ?>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</body>
</html>