<?php require_once("header.php"); ?>
<warpper>
    <main>
        <?php require_once("pankuzu.php"); ?>
        <?php
        try {
            require_once("common/common.php");
            $code = filter_input(INPUT_GET, 'p');

            $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
            $user = "root";
            $password = "root";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT title, img, time, honbun, com  FROM page WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
            echo $rec["title"];
            echo "<br>";
            echo $rec["time"];
            echo "<br>";
            if(empty($rec["img"]) === true) {
                echo  "<img src='setting/img/".$rec['img']."'>";
            }
            echo "<br>";
            echo $rec["honbun"];

            if(empty($rec["com"]) === "ari") {
                echo "<form action='toi.php' method='post'>";
                echo "お名前";
                echo "<br>";
                echo "<div class='toi'>";
                echo "<input type='text' name='name'>";
                echo "<br>";
                echo "mail";
                echo "<br>";
                echo "<input type='text' name='mail'>";
                echo "</div>";
                echo "<br>";
                echo "内容";
                echo "<br>";
                echo "<div class='toi2'>";
                echo "<textarea name='honbun'></textarea>";
                echo "</div>";
                echo "<br><br>";
                echo "<input type='submit' value='送信'>";
                echo "</form>";
            }
        } catch (Exception $e) {
            echo ("サーバエラー". $e->getMessage());
        }
        ?>
        <?php require_once("nav.php"); ?>
    </main>
    <?php require_once("side.php"); ?>
    <?php require_once("footer.php"); ?>