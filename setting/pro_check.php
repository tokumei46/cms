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
    <link rel="stylesheet" href="../style.css">
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
            $honbun = $post["honbun"];

            if (empty($name) === true or empty($img["name"]) === true or empty($honbun) === true) {
                echo "プロフィール情報を全て入力しください<br>";
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

            $sql = "SELECT * FROM pro WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($rec["code"]) === true) {
                $sql = "INSERT INTO pro(name, img, honbun) VALUES(?,?,?)";
                $stmt = $dbh->prepare($sql);
                $data[] = $name;
                $data[] = $img["name"];
                $data[] = $honbun;
                $stmt->execute($data);
            } else {
                $sql = "UPDATE pro SET name=?, img=?, honbun=? WHERE code=?";
                $stmt = $dbh->prepare($sql);
                $data[] = $name;
                $data[] = $img["name"];
                $data[] = $honbun;
                $data[] = $rec["code"];
                $stmt->execute($data);
            }

            echo "<h2>管理人</h2>";
            echo "<div class='box'>";
            echo "<h3>" . $name . "</h3>";
            echo "<div class='img'>";
            echo "<img src='img/" . $img['name'] . "'>";
            echo "</div>";
            echo $honbun;
            echo "</div>";
        } catch (Exception $e) {
            echo ("サーバーに異常が発生しました". $e->getMessage());
            echo "<a href='set_top.php'>cmsトップへ</a>";
            exit();
        }
        ?>
        <br>
        <h3>上記内容で登録しました<br></h3>
        <br>
        <a href="pro.php">プロフィール作成画面に戻る</a>
        <br>
        <a href="set_top.php">トップメニューへ</a>
    </aside>
</body>

</html>