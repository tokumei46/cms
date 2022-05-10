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
    <main>
        <?php
        try {
            $title = filter_input(INPUT_POST, "title");
            $honbun = filter_input(INPUT_POST, "honbun");
            $img = filter_input(INPUT_POST, "img");
            $com = filter_input(INPUT_POST,"com");

            $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
            $user = "root";
            $password = "root";
            $dbh = new PDO($dsn, $user, $password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO page(title, honbun, img, com, time) VALUE(?,?,?,?,NOW())";
            $stmt = $dbh -> prepare($sql);
            $data[] = $title;
            $data[] = $honbun;
            $data[] = $img;
            $data[] = $com;
            $stmt -> execute($data);
        }
        catch(Exception $e) {
            echo ("エラー発生<br>" . $e->getMessage());
            echo "<a href='set_top.php'>cmsトップへ</a>";
        }
        ?>
        <h3>登録しました。</h3>
        <br><br>
        <a href="../edit_page.php">固定ページに戻る</a>
        <br>
        <a href="set_top.php">トップメニューへ</a>
    </main>
</body>
</html>