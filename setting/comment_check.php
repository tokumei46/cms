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

        $sql = "SELECT * FROM karicm WHERE1";
        $stmt = $dbh -> prepare($sql);
        $stmt -> execute();

        $rec =  $stmt-> fetch(PDO::FETCH_ASSOC);
        if(empty($rec["name"]) === true) {
            echo "承認待ちのコメントがありません<br>";
            echo "<input type='button' onclick='history.back()' value='戻る'>";
            echo "</form>";
            exit();
        }
            echo "以下のコメントが認証待ちになっています。<br><br>";
            echo $rec["title"]."　に対するコメント<br>";
            echo $rec["time"];
            echo "<br>";
            echo $rec["name"];
            echo "<br>";
            echo $rec["honbun"];
            echo "<br><br>";
            echo "<a href='comment_done.php?id=".$rec['id']."&code=".$rec['code']."'>";
            echo "認証する</a>";
            echo "<br><br>";
            echo "<a href='comment_done.php?id=".$rec['id']."&code=".$rec['code']."&flag=1'>";
            echo "削除する</a>";
            echo "<br><br>";

            while(true) {
                $rec = $stmt -> fetch(PDO::ATTR_AUTOCOMMIT);
                if(empty($rec["name"]) === true) {
                    break;
                }
                echo $rec["name"]."　に対するコメント<br>";
                echo $rec["time"];
                echo "<br>";
                echo $rec["name"];
                echo "<br>";
                echo $rec["honbun"];
                echo "<br><br>";
                echo "<a href='comment_done.php?id=".$rec['id']."&code=".$rec['code']."'>";
                echo "認証する</a>";
                echo "<br><br>";
                echo "<a href='comment_done.php?id=".$rec['id']."&code=".$rec['code']."&flag=1'>";
                echo "削除する</a>";
                echo "<br><br>";
            }
            $dbh = null;
    }
    catch(Exception $e) {
        echo ("異常があります<br>". $e->getMessage());
        echo "<a href='set_top.php'>cmsトップへ</a>";
    }
    ?>

    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</body>
</html>