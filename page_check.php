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
        $title = filter_input(INPUT_POST, 'title');
        $honbun = filter_input(INPUT_POST, 'honbun');
        $img = filter_input(INPUT_POST, 'img');
        $com = filter_input(INPUT_POST, 'com');

        if (empty($title) === true or empty($honbun) === true or empty($com)=== true) {
            echo "必須項目を入力してください<br>";
            echo "<br><br>";
            echo "<form>";
            echo "<a href='edit_page.php'>戻る</a>";
            exit();
        }
        echo $title;
        if (empty($img) === true) {
            echo "<img class='bunimg' src='setting/img/" . $img . "'>";
        }
        echo $honbun;
        ?>
        <br>
        <h3>上記内容で登録しますか？</h3>
        <form action="setting/pagedone.php" method="post">
            <input type="hidden" name="com" value="<?php echo $_POST['com']; ?>">
            <input type="hidden" name="title" value="<?php echo $title; ?>">
            <input type="hidden" name="honbun" value="<?php echo $honbun; ?>">
            <input type="hidden" name="img" value="<?php echo $img; ?>">
            <input type="submit" value="OK">
        </form>
    </main>
</body>

</html>