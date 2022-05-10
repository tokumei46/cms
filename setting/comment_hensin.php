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
    <main>
        <?php
        $id = filter_input(INPUT_GET, "id");
        $code = filter_input(INPUT_GET, "code");
        $title = filter_input(INPUT_GET, "title");
        $honbun = filter_input(INPUT_GET, "honbun");

        echo "下記コメントに対して返信します<br>";
        echo "記事タイトル:" . strip_tags($title) . "についてのコメント<br>";
        echo "<br>";

        echo "<h3>コメントを返信</h3>";
        echo "<div class='comment'>";
        echo "<form action='comment_hensin_done.php' method='post'>";
        echo "<input type='text' name='name' value='管理人'><br>";
        echo "コメント<br>";
        echo "<textarea name='hensin'></textarea><br>";
        echo "<input type='hidden' name='id' value='" . $id . "'>";
        echo "<input type='hidden' name='code' value='" . $code . "'>";
        echo "<input type='submit' value='送信'>";
        echo "<input type='button' onclick='history.back()' value='戻る'>";
        echo "</form>";
        echo "</div>";
        echo "<br><br>";
        ?>
    </main>
</body>

</html>