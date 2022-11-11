<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kullanıcı Adı</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">Parola</th>
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
                $user = "baris_vurgun";
                $pass = md5(md5(md5(sha1("12345678"))));
                $email = "barishack@gmail.com";
                $name = "Barış";
                $lastname = "VURGUN";
                $birthday = "01.01.1986";
                $confrim = 1;

                $addMember = $db->insert('INSERT INTO members SET
                MemberUsername=?,
                MemberPassword=?,
                MemberEmail=?,
                MemberName=?,
                MemberLastname=?,
                MemberBrithday=?,
                MemberConfrim=?
                ', [$user, $pass, $email, $name, $lastname, $birthday, $confrim]);
                if ($addMember) {
                    echo'<div class="alert alert-success">'.$addMember.'. Kayıt Başarılı.</div>';
                }
                else{
                    echo'<div class="alert alert-danger">Bir hata oluştu kayıt yapılamadı.</div>';
                }

                $query = $db->getRows("SELECT * FROM members");
                foreach ($query as $items) {
                    echo "\n"; ?>
                    <tr>
                        <th scope="row"><?= $items->MemberID ?></th>
                        <td><?= $items->MemberUsername ?></td>
                        <td><?= $items->MemberName ?></td>
                        <td><?= $items->MemberLastname ?></td>
                        <td><?= $items->MemberPassword ?></td>
                        <td><?= $items->MemberBrithday ?></td>
                        <td><?= $items->MemberAddtime ?></td>
                        <td><?= ($items->MemberConfrim == 1) ? '<span style="color:green">Aktif</span>' : '<span style="color:red">Pasif</span>'; ?></td>
                    </tr>
                <?php echo "\n";
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>