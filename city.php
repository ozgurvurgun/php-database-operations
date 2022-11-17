<?php
error_reporting(0);
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
                        <form method="POST" id="AddMemberForm" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="MemberCity" class="col-sm-2 col-form-label">Şehriniz</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="MemberCity" name="MemberCity">
                                        <option value="0">Şehriniz</option>
                                        <?php
                                        $city = $db->getRows("SELECT * FROM citys");
                                        foreach ($city as $item) { ?>
                                            <option value="<?= $item->CityID ?>"><?= $item->CityName ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="MemberTown" class="col-sm-2 col-form-label">İlçeniz</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="MemberTown" name="MemberTown">
                                            <option value="0">İlçe Seç</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <div id="result"></div>
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success btn-lg" id="SaveButton" name="SaveButton">Kaydet <span class="loadingAnimation"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <?php require_once "footer.php" ?>
</body>

</html>