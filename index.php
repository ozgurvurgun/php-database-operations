<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>DOCUMENT</title>
</head>

<body style="padding: 30px;">
    <?php
    // echo "<pre>";
    // print_r(PDO::getAvailableDrivers()); //pdo sürücülerini verir
    // echo "</pre>";

    require_once "db/database.class.php";

    use \project\db\Database;

    $db = new Database;

    // $getQueryDb = $db->CreateDB("CREATE DATABASE IF NOT EXISTS ECEdb");
    // if ($getQueryDb) {
    //     echo "<h2>veritabanı olulturuldu.</h2>";
    // } else {
    //     echo "<h2>veritabanı oluşturulamadı.</h2>";
    // }

    // $getQueryTb = $db->CreateTable("CREATE TABLE IF NOT EXISTS uyeler(
    //     MemberID int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     MemberUsername varchar(60) NOT NULL UNIQUE KEY,
    //     MemberName varchar(60) NOT NULL,
    //     MamberLastname varchar(60) NOT NULL,
    //     MemberEmail varchar(90) NOT NULL UNIQUE KEY,
    //     MemberConfrim tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
    //     AddTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)
    //     ENGINE=InnoDB DEFAULT CHARACTER SET UTF8 COLLATE utf8_general_ci");
    // if ($getQueryTb) {
    //     echo "<h2>tablo olulturuldu.</h2>";
    // } else {
    //     echo "<h2>tablo oluşturulamadı.</h2>";
    // }

    //VERİYİ HANGİ ŞEKİLDE ÇAĞIRMAK İSTİOYRSAK İKİNCİ PARAMETRE DE BELİRTEBİLİRİZ
    //OBJE OLARAK KULLANIM DAHA PRATİK GİBİ
    ?>
    <h1 class="text-warning mb-3">Üyeler</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kullanıcı Adı</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">Parola</th>
                    <th scope="col">Email</th>
                    <th scope="col">Doğum Tarihi</th>
                    <th scope="col">Kayıt Tarihi</th>
                    <th scope="col">Hesap Durumu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //SQL INJECTION ENGELLEME
                $ID = 1;
                $ID2 = 9;
                // $query = $db->getTable("SELECT * FROM members WHERE  MemberID > ? and MemberID < ? ", [$ID, $ID2]);//BU DEĞERLERİ PARAMETRE OLARAK GONDERMEK ZORUNDA DEĞİLİM bindParam metodunu kullanabilirim
                $records = $db->getColumn("SELECT COUNT(MemberID) FROM members");
                echo '<div class="alert alert-success">Toplam kayıtlı üye sayısı: ' . $records . '</div>';
                $query = $db->getRows("SELECT * FROM members WHERE MemberConfrim IN(0,1) ORDER BY MemberAddtime ASC");
                foreach ($query as $items) {
                    echo "\n"; ?>
                    <tr>
                        <th scope="row"><?= $items->MemberID ?></th>
                        <td><?= $items->MemberUsername ?></td>
                        <td><?= $items->MemberName ?></td>
                        <td><?= $items->MemberLastname ?></td>
                        <td><?= $items->MemberPassword ?></td>
                        <td><?= $items->MemberEmail ?></td>
                        <td><?= $items->MemberBrithday ?></td>
                        <td><?= $items->MemberAddtime ?></td>
                        <td><?= ($items->MemberConfrim == 1) ? '<span id="active"><b>Aktif</b></span>' : '<span id="passive"><b>Pasif</b></span>'; ?></td>
                    </tr>
                <?php echo "\n";
                } ?>
            </tbody>
        </table>
    </div>
    <h1 class="text-warning mb-3 mt-5">Ürünler</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Üye Adı</th>
                    <th scope="col">Üye Soyadı</th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Ürün Fiyatı</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $records = $db->getColumn("SELECT COUNT(ProductID) FROM products");
                echo '<div class="alert alert-success">Toplam kayıtlı ürün sayısı: ' . $records . '</div>';
                $query = $db->getRows("SELECT 
                members.MemberID,
                members.MemberName,
                members.MemberLastname,
                products.ProductName,
                products.ProductPrice
                FROM members
                INNER JOIN products ON members.MemberID=products.UserID
                ");
                foreach ($query as $items) {
                    echo "\n"; ?>
                    <tr>
                        <th scope="row"><?= $items->MemberID ?></td>
                        <td><?= $items->MemberName ?></td>
                        <td><?= $items->MemberLastname ?></td>
                        <td><?= $items->ProductName ?></td>
                        <td><?= $items->ProductPrice ?></td>
                    </tr>
                <?php
                    echo "\n";
                } ?>
            </tbody>
        </table>
    </div>





    <h1 class="text-warning mb-3 mt-5">Yorumlar</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Üye Adı</th>
                    <th scope="col">Üye Soyadı</th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Ürün Fiyatı</th>
                    <th scope="col">Yorumlar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $records = $db->getColumn("SELECT COUNT(CommentID) FROM comments");
                echo '<div class="alert alert-success">Toplam kayıtlı yorum sayısı: ' . $records . '</div>';
                $query = $db->getRows("SELECT 
                members.MemberName,
                members.MemberLastname,
                products.ProductName,
                products.ProductPrice,
                comments.CommentID,
                comments.CommentMessage
                FROM members
                INNER JOIN products ON members.MemberID=products.UserID 
                INNER JOIN comments ON members.MemberID=comments.UserID 
                AND products.ProductID=comments.ProductID
                ");
                foreach ($query as $items) {
                    echo "\n"; ?>
                    <tr>
                        <th scope="row"><?= $items->CommentID ?></td>
                        <td><?= $items->MemberName ?></td>
                        <td><?= $items->MemberLastname ?></td>
                        <td><?= $items->ProductName ?></td>
                        <td><?= $items->ProductPrice ?></td>
                        <td><?= $items->CommentMessage ?></td>
                    </tr>
                <?php
                    echo "\n";
                } ?>
            </tbody>
        </table>
    </div>


</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>