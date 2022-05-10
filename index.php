<?php require_once("header.php"); ?>
<warapper>
    <main>
        <?php require_once("pankuzu.php"); ?>

        <?php
        try {
            require_once("common/common.php");

            if (empty($_GET["page"]) === true) {
                $page = 1;
            } else {
                $get = sanitize($_GET);
                $page = filter_input(INPUT_GET, "page");
            }
            $now = $page - 1;
            $card_max = 5;

            $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
            $user = "root";
            $password = "root";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT title FROM blog WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($rec["title"]) === true) {
                    break;
                }
                $title[] = $rec["title"];
            }

            if (isset($title) === true) {
                $card_all = count($title);
                $page_max = ceil($card_all / $card_max);
            }

            if ($page === 1) {
                $sql =  "SELECT code, category, img, title, time FROM blog ORDER BY code DESC LIMIT $now, $card_max";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
            } else {
                $now = $now * $card_max;
                $sql = "SELECT code, category, img, title, time FROM blog ORDER BY code DESC LIMIT $now, $card_max";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
            }
            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($rec["title"]) === true) {
                    break;
                }
                echo "<a href='setting/set_top.php'>トップへ戻る</a>";
                echo "<div id='blog_card'>";
                echo "<a class='card' href='single.php?n=" . $rec['code'] . "'>";
                echo "<div id='main_img'>";
                echo "<img src='setting/img/" . $rec['img'] . "'>";
                echo "</div>";
                echo "<div id='main_text'>";
                echo "カテゴリ　" . $rec["category"] . "<br>";
                echo "更新日　" . $rec["time"] . "<br>";
                echo "<div class='card_title'>";
                echo strip_tags($rec["title"]) . "</div><br>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
            }
            echo "<div class='pag'>";
            for($i = 1; $i <= $page_max; $i++) {
                if($i == $page) {
                    echo "<div class='posi'>".$page."</div>";
                } else {
                    echo "<div class='posi'><a href='index.php?page=".$i."'>";
                    echo $i."</a></div>";
                }
            }
            echo "</div>";
            {
                echo "<br><br>";
                echo "記事はありません。";
            }
                    
            $dbh = null;
        }
        catch (Exception $e) {
            echo ("エラー発生<br>" . $e->getMessage());
            echo "<a href='set_top.php'>cmsトップへ</a>";
        }
        ?>
        <?php require_once("nav.php"); ?>
    </main>
    <?php require_once("side.php"); ?>
    <?php require_once("footer.php"); ?>