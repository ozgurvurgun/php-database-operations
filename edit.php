<?php
require_once "db/database.class.php";
require_once "safe.php";

use \project\db\Database;

$db = new Database;
$message = NULL;
$ID = intval($_GET["ID"]);
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Submit"])) {
    $username = security("MemberUsername");
    $email = security("MemberEmail");
    $name = security("MemberName");
    $lastname = security("MemberLastname");
    $city = security("MemberCity");
    $birthday = security("MemberBorn");
    $gender = security("MemberGender");
    @$confrim = security("confrim");
    if (
        empty($username) or empty($email) or
        empty($name) or empty($lastname) or
        empty($birthday) or empty($gender)
    ) {
        $message = '<div class="alert alert-warning">Lütfen boş alanları doldurun.</div>';
    } else {
        if ($city == 0) {
            $message = '<div class="alert alert-warning">Lütfen şehir seçin.</div>';
        } else {
            if (strlen($username) < 5 or strlen($username) > 35) {
                $message = '<div class="alert alert-warning">Kullanıcı adı 5 karakterden kısa, 35 karakterden uzun olamaz.</div>';
            } else {

                if (!preg_match('/^[a-zA-ZıİğĞöÖüÜşŞçÇ\s]+$/u', $name)) {
                    $message = '<div class="alert alert-warning">Adınızı abudik gubidik girmeyiniz.</div>';
                } else {
                    if (!preg_match('/^[a-zA-ZıİğĞöÖüÜşŞçÇ\s]+$/u', $lastname)) {
                        $message = '<div class="alert alert-warning">Soy adınızı abudik gubidik girmeyiniz.</div>';
                    } else {
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $message = '<div class="alert alert-warning">E-posta formatınız doğru değil. Lütfen kontrol edin.</div>';
                        } else {

                            $isUsername = $db->getColumn("SELECT MemberID FROM members WHERE MemberUsername=? AND MemberID !=?", [$username, $ID]); //bu kullanıcı varmı ?, bu eposta varmı? , if bloğu kayıt yapmaya çalışırken izin vermiyor. o yüzden kullanıcının id sini hariç tutuyorum.
                            $isEmail = $db->getColumn("SELECT MemberID FROM members WHERE MemberEmail=? AND MemberID !=?", [$email, $ID]);
                            if ($isUsername) {
                                $message = '<div class="alert alert-warning">"' . $username . '" kullanıcı adı kullanılıyor.</div>';
                            } elseif ($isEmail) {
                                $message = '<div class="alert alert-warning">"' . $email . '" email adresi kullanılıyor.</div>';
                            } else {
                                $add = $db->update('UPDATE members SET 
                                            MemberUsername=?,
                                            MemberEmail=?,
                                            MemberName=?,
                                            MemberLastname=?,
                                            MemberCity=?,
                                            MemberBirthday=?,
                                            MemberGender=? 
                                            WHERE MemberID=?                      
                                            ', [$username, $email, $name, $lastname, $city, $birthday, $gender, $ID]);
                                if ($add) {
                                    $message = '<div class="alert alert-success">Kayıt güncelleme işlemi başarılı.</div>';
                                } else {
                                    $message = '<div class="alert alert-warning">Değişiklik yapılmadı, aynı verileri güncellemeye çalıştınız.</div>';
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


$members = $db->getRow("SELECT * FROM members WHERE MemberID=?", [$ID]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>RecorD Update</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mt-3">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Kullanıcı Adı</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputUsername" name="MemberUsername" maxlength="40" value="<?= $members->MemberUsername; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" name="MemberEmail" value="<?= $members->MemberEmail; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Adınız</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="MemberName" value="<?= $members->MemberName; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputLastname" class="col-sm-2 col-form-label">Soyadınız</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputLastname" name="MemberLastname" value="<?= $members->MemberLastname; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputCity" class="col-sm-2 col-form-label">Şehriniz</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputCity" name="MemberCity">
                                        <option value="0">Şehir Seç</option>
                                        <?php
                                        $city = $db->getRows("SELECT * FROM citys");
                                        foreach ($city as $item) { ?>
                                            <option value="<?= $item->CityID ?>" <?= ($members->MemberCity == $item->CityID) ? "selected" : ""; ?>><?= $item->CityName ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputBorn" class="col-sm-2 col-form-label">Doğum tarihin</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="inputBorn" name="MemberBorn" value="<?= $members->MemberBirthday; ?>">
                                </div>
                            </div>
                            <fieldset class="form-group row">
                                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Cinsiyetin</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="MemberGender" id="MemberGender1" value="F" <?= ($members->MemberGender == "F") ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="MemberGender1">
                                            Kadın
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="MemberGender" id="MemberGender2" value="M" <?= ($members->MemberGender == "M") ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="MemberGender2">
                                            Erkek
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="MemberGender" id="MemberGender3" value="B" <?= ($members->MemberGender != "M" && $members->MemberGender != "F") ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="MemberGender3">
                                            Belirsiz
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <div><?= $message ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-danger" name="Submit">Güncelle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>





<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>