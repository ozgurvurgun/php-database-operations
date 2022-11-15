<?php
require_once "db/database.class.php";

use \project\db\Database;

$db = new Database;
$ID = $_GET["ID"];
$members = $db->getRow("SELECT * FROM members WHERE MemberID=?", [$ID]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Recor Update</title>
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
                                <label for="inputPassword" class="col-sm-2 col-form-label">Parola</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword" name="MemberPassword" maxlength="30" value="<?= $members->MemberPassword; ?>">
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
                                    <input type="date" class="form-control" id="inputBorn" name="MemberBorn" value="<?= $members->MemberBrithday; ?>">
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
                                        <input class="form-check-input" type="radio" name="MemberGender" id="MemberGender3" value="M" <?= ($members->MemberGender != "M" && $members->MemberGender !="F") ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="MemberGender3">
                                            Belirsiz
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-danger">Güncelle</button>
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