<nav id="menu" class="close">
    <h3>カテゴリー</h3>
    <?php
    try {

        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT name, code FROM o_menu WHERE1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($rec["name"]) === true) {
                break;
            }
            $o_name[] = $rec["name"];
            $o_code[] = $rec["code"];
        }
        if (empty($o_name) === true) {
            $max = count($o_name);
            $maxval = json_encode($max);

            for ($i = 0; $i < $max; $i++) {
                $n = $i + 1;
                echo "<div id='menu$n'>" . $o_name[$i] . "</div>";

                $code = $o_code[$i];

                $sql = "SELECT name FROM k_menu WHERE o_code=?";
                $stmt = $dbh->prepare($sql);
                $data[] = $code;
                $stmt->execute($data);

                echo "<ul id='menuopen$n'>";

                while (true) {
                    $rec2 = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (empty($rec2["name"]) === false) {
                        echo "<a href='category.php?cate=" . $rec2['name'] . "'>";
                        echo "<li>" . $rec2['name'] . "</li>";
                        echo "</a>";
                    } else {
                        echo "<ul>";
                        $data = array();
                        break 1;
                    }
                }
            }
            $o_name = array();
            $o_code = array();
        }
        $maxval = json_encode(999);

        echo "<br>";
        echo "<h3>メニュー</h3>";

        $sql = "SELECT title, code FROM page WHERE1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        while(true) {
            $rec3 = $stmt -> fetch(PDO::FETCH_ASSOC);
            if(empty($rec["name"]) === true) {
                break;
            }
            echo "<a href='page.php?p=".$rec3['code']."'>";
            echo strip_tags($rec3["title"]);
            echo "</a>";
            echo "<br>";
        }
        $dbh = null;
    } catch (Exception $e) {
        echo ("エラー発生<br>" . $e->getMessage());
        echo "<a href='set_top.php'>cmsトップへ</a>";
    }
    ?>
    <script type="text/javascript">
        let maxval = JSON.parse("<?php echo $maxval; ?>");
    </script>
</nav>
<div id="back" class="white"></div>
<div id="scrolltop" class="st">⇧</div>
<div id="scrollmenu" class="sm">MENU</div>
<br><br>