<?php
try {
    require_once("common/common.php");

    if (empty($_GET["n"]) === true && empty($_GET["cate"]) === true && empty($_GET["p"]) === true) {
        echo "<a href='index.php'>";
        echo "home";
        echo "</a>";
    } else {
        $get = sanitize($_GET);
        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($get["n"]) === true) {
            $sql = "SELECT title, category FROM blog WHERE code=?";
            $stmt = $dbh->prepare($sql);
            $data[] = $get["n"];
            $stmt->execute($data);
            $data = array();

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $category = $rec["category"];
            $title = $rec["title"];

            $sql = "SELECT o_code FROM k_menu WHERE name=?";
            $stmt = $dbh->prepare($sql);
            $data[] = $category;
            $stmt->execute($data);
            $data = array();

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $o_code = $rec["o_code"];

            $sql = "SELECT name FROM o_menu WHERE code=?";
            $stmt = $dbh->prepare($sql);
            $data[] = $o_code;
            $stmt->execute($data);
            $data = array();

            $dbh = null;

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $oya = $rec["name"];
            echo "<a href='index.php'>";
            echo "home";
            echo "</a>";
            echo "　>　";
            echo "<a href='category.php?cate=" . $category . "'>";
            echo $oya . ":" . $category;
            echo "</a>";
            echo "　>　";
            echo strip_tags($title);

            $o_code = array();
            $title = array();
        } else if (isset($get["cate"]) === true) {
            $sql = "SELECT o_code FROM k_menu WHERE name=?";
            $stmt = $dbh->prepare($sql);
            $data[] = $get["cate"];
            $stmt->execute($data);
            $data = array();

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $o_code = $rec["o_code"];

            $sql = "SELECT name FROM o_menu WHERE code=?";
            $stmt = $dbh->prepare($sql);
            $data[] = $o_code;
            $stmt->execute($data);
            $data = array();

            $dbh = null;

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $oya = $rec["name"];
            echo "<a href='index.php'>";
            echo "home";
            echo "</a>";
            echo "　>　";
            echo "<a href='category.php?cate=" . $get['cate'] . "'>";
            echo $oya . ":" . $get["cate"];
            echo "</a>";

            $o_menu = array();
        } else {
            $sql = "SELECT title FROM page WHERE code=?";
            $stmt = $dbh->prepare($sql);
            $data[] = $get["p"];
            $stmt->execute($data);
            $data = array();

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<a href='index.php'>";
            echo "home";
            echo "</a>";
            echo "　>　";
            echo strip_tags($rec["title"]);
        }
    }
} catch (Exception $e) {
    echo ("エラー発生<br>" . $e->getMessage());
    echo "<a href='set_top.php'>cmsトップへ</a>";
}
?>
