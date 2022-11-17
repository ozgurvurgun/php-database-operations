<?php
require_once "db/database.class.php";
require_once "safe.php";

use \project\db\Database;

$db = new Database;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>To Record</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mt-3 bg-light">
                    <div class="card-body">
                        <form method="POST" id="AddMemberForm">
                            <div class="form-group row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Kullanıcı Adı</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="MemberUsername" name="MemberUsername" maxlength="40">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Parola</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="MemberPassword" name="MemberPassword" maxlength="50">
                                    <small class="text-muted">Parolanız büyük harf, küçük harf ve rakam içermelidir. Parolanız 8 karakterden kısa, 50 karakterden uzun olamaz.</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="MemberEmail" name="MemberEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Adınız</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="MemberName" name="MemberName">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputLastname" class="col-sm-2 col-form-label">Soyadınız</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="MemberLastname" name="MemberLastname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputCity" class="col-sm-2 col-form-label">Şehriniz</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="MemberCity" name="MemberCity">
                                        <option value="0">Şehir Seç</option>
                                        <?php
                                        $city = $db->getRows("SELECT * FROM citys");
                                        foreach ($city as $item) { ?>
                                            <option value="<?= $item->CityID ?>"><?= $item->CityName ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputBorn" class="col-sm-2 col-form-label">Doğum tarihin</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="MemberBorn" name="MemberBorn">
                                </div>
                            </div>
                            <fieldset class="form-group row">
                                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Cinsiyetin</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="MemberGender" id="MemberGender1" value="F" checked>
                                        <label class="form-check-label" for="MemberGender1">
                                            Kadın
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="MemberGender" id="MemberGender2" value="M">
                                        <label class="form-check-label" for="MemberGender2">
                                            Erkek
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="MemberGender" id="MemberGender3" value="B">
                                        <label class="form-check-label" for="MemberGender3">
                                            Belirsiz
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="confrim" name="confrim">
                                        <label class="form-check-label" for="confrim">
                                            <a href="#">Üyelik ve gizlilik sözleşmesini </a>okudum ve kabul ediyorum.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <div id="result"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-success btn-lg" id="SaveButton" name="SaveButton" onclick="SendForm('AddMemberForm','InsertMember','admin.php');totalMembers('total-members')">Kaydet <span class="loadingAnimation"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kullanıcı Adı</th>
                                <th scope="col">Ad</th>
                                <th scope="col">Soyad</th>
                                <th scope="col">Şehir</th>
                                <th scope="col">Parola</th>
                                <th scope="col">Email</th>
                                <th scope="col">Doğum Tarihi</th>
                                <th scope="col">Kayıt Tarihi</th>
                                <th scope="col">Cinsiyet</th>
                                <th scope="col">Güncelle</th>
                                <th scope="col">Sil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div id="total-member" class="alert alert-success mt-3 mb-3"></div>
                            <?php
                            $query = $db->getRows("CALL MEMBERS()");
                            foreach ($query as $items) {
                                echo "\n"; ?>
                                <tr id="<?= $items->MemberID ?>">
                                    <th scope="row"><?= $items->MemberID ?></th>
                                    <td><?= $items->MemberUsername ?></td>
                                    <td><?= $items->MemberName ?></td>
                                    <td><?= $items->MemberLastname ?></td>
                                    <td><?= $items->CityName == NULL ? '<span id="warning"><b>Boş</b></span>' : $items->CityName; ?></td>
                                    <td><?= $items->MemberPassword ?></td>
                                    <td><?= $items->MemberEmail ?></td>
                                    <td><?= $items->MemberBirthday ?></td>
                                    <td><?= $items->MemberAddtime ?></td>
                                    <td><?php if ($items->MemberGender === 'F') {
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gender-female text-warning" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z"/>
                                          </svg>';
                                        } elseif ($items->MemberGender === 'M') {
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gender-male text-primary" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                                          </svg>';
                                        } else {
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gender-ambiguous" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1H11.5zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z"/>
                                          </svg>';
                                        }
                                        ?>
                                    <td><a href="edit.php?ID=<?= $items->MemberID ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square text-info" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a></td>
                                    <td><a href="javascript:void(0)" onclick="RemoveAll('DeleteMember','<?= $items->MemberID ?>');totalMembers('total-members')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg>
                                        </a></td>
                                    <!-- <td><?= ($items->MemberConfrim == 1) ? '<span id="active"><b>Aktif</b></span>' : '<span id="passive"><b>Pasif</b></span>'; ?></td> -->
                                </tr>
                            <?php echo "\n";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <?php require_once "footer.php" ?>
</body>

</html>