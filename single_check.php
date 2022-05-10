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
    <link rel="stylesheet" href="setting/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        $cate = filter_input(INPUT_POST,'cate');
        $title = filter_input(INPUT_POST,'title');
        $honbun = filter_input(INPUT_POST,'honbun');
        $img = filter_input(INPUT_POST,'img');

        if (empty($title) === true or empty($honbun) === true or empty($img) === true) {
            echo "必須項目を入力してください<br>";
            echo "<br><br>";
            echo "<form>";
            echo "<input type='button' onclick='history.back()' value='戻る'>";
            echo "</form>";
            exit();
        }
        echo $title;
        echo "<img class='bunimg' src='setting/img/" . $img . "'>";
        echo $honbun;

    ?>
    <br>
    <h3>上記内容で登録しますか？<br></h3>
    <form action="setting/blogdone.php" method="post">
        <input type="hidden" name="cate" value="<?php print $cate; ?>">
        <input type="hidden" name="title" value="<?php print $title; ?>">
        <input type="hidden" name="honbun" value="<?php print $honbun; ?>">
        <input type="hidden" name="img" value="<?php print $img; ?>">
        <input type="submit" value="OK">
    </form>
</body>

</html>