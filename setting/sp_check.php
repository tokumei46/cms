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
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <aside>
        <?php
        try {
            require_once("../common/common.php");
            $post = sanitize($_POST);

            $name = $post["name"];
            $img = $_FILES["img"];
            $url = $post["url"];

            if (empty($name) === true or empty($img["name"]) === true or empty($url) === true) {
                echo "スポンサー情報を入力してください<br>";
                echo "<form>";
                echo "<input type='button' onclick='history.back()' value='戻る'>";
                echo "</form>";
                exit();
            }
            move_uploaded_file($img["tmp_name"], "./img/" . $img["name"]);

            $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
            $user = "root";
            $password = "root";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO sp(name, img, url) VALUES(?,?,?)";
            $stmt = $dbh->prepare($sql);
            $data[] = $name;
            $data[] = $img["name"];
            $data[] = $url;
            $stmt->execute($data);

            $sql = "SELECT name, img, url FROM sp WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            echo "<h2>管理者</h2>";

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($rec["name"]) === true) {
                    break;
                }
                echo "<div class='box'>";
                echo "<h3>" . $rec["name"] . "</h3>";
                echo "<div class='img'>";
                echo "<a href='" . $rec['url'] . "'>";
                echo "<img src='img/" . $rec['img'] . "'>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
            }
        } catch (Exception $e) {
            echo ("サーバーに不具合があります<br>". $e->getMessage());
            echo "<a href='set_top.php'>cmsトップへ</a>";
            exit();
        }
        ?>
        <br>
        <h3>上記内容で登録しました<br></h3>
        <a href="sp.php">スポンサー作成画面へ戻る</a>
        <br>
        <a href="set_top.php">トップメニューへ</a>
    </aside>
</body>

</html>