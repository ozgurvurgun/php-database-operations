<?php
require_once "db/database.class.php";
require_once "safe.php";

use \project\db\Database;

$db = new Database;

$operation = $_GET["page"];

switch ($operation) {
    case 'InsertMember': //sleep(1);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = security("MemberUsername");
            $password = security("MemberPassword");
            $email = security("MemberEmail");
            $name = security("MemberName");
            $lastname = security("MemberLastname");
            $city = security("MemberCity");
            $birthday = security("MemberBorn");
            $gender = security("MemberGender");
            @$confrim = security("confrim");
            if ($confrim != 'on') {
                $message = 'Lütfen sözleşmeyi onaylayın.:::warning';
            } else {
                if (
                    empty($username) or empty($password) or empty($email) or
                    empty($name) or empty($lastname) or
                    empty($birthday) or empty($gender)
                ) {
                    $message = 'Lütfen boş alanları doldurun.:::warning';
                } else {
                    if ($city == 0) {
                        $message = 'Lütfen şehir seçin.:::warning';
                    } else {
                        if (strlen($username) < 5 or strlen($username) > 35) {
                            $message = 'Kullanıcı adı 5 karakterden kısa, 35 karakterden uzun olamaz.:::warning';
                        } else {
                            if (strlen($password) < 8 && strlen($password) < 50) {
                                $message = 'Parolanız 8 karakterden kısa, 50 karakterden uzun olamaz.:::warning';
                            } else {
                                if (!preg_match('/^[a-zA-ZıİğĞöÖüÜşŞçÇ\s]+$/u', $name)) {
                                    $message = 'Adınızı abudik gubidik girmeyiniz.:::warning';
                                } else {
                                    if (!preg_match('/^[a-zA-ZıİğĞöÖüÜşŞçÇ\s]+$/u', $lastname)) {
                                        $message = 'Soy adınızı abudik gubidik girmeyiniz.:::warning';
                                    } else {
                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            $message = 'E-posta formatınız doğru değil. Lütfen kontrol edin.:::warning';
                                        } else {
                                            if (!preg_match('/^(?=.*[A-ZİĞÖÜŞÇ])(?=.*[a-zığöüşç])(?=.*[0-9]).{8,20}/u', $password)) {
                                                $message = 'Parolanız belirtilen formatta değil. Lütfen güvenliğiniz için tekrar kontrol edin.:::warning';
                                            } else {
                                                //encrypt
                                                $data = $password;
                                                $cipher = 'AES-128-ECB';
                                                $key = 'sementa.9568.dhnr';
                                                $password = openssl_encrypt($data, $cipher, $key);
                                                // decrypt
                                                // $data = 'encrypt edilmiş değeri buraya alırsan parolanın saf halini alırsın';
                                                // $cipher = 'AES-128-ECB';
                                                // $key = 'sementa.9568.dhnr';
                                                // $decoded = openssl_decrypt($data, $cipher, $key);

                                                $isUsername = $db->getColumn("SELECT MemberID FROM members WHERE MemberUsername=?", [$username]);
                                                $isEmail = $db->getColumn("SELECT MemberID FROM members WHERE MemberEmail=?", [$email]);
                                                if ($isUsername) {
                                                    $message = '"' . $username . '" kullanıcı adı kullanılıyor.:::warning';
                                                } elseif ($isEmail) {
                                                    $message = '"' . $email . '" email adresi kullanılıyor.:::warning';
                                                } else {
                                                    if ($_FILES["UserImageFile"]["name"] == '') {
                                                        $message = 'Lütfen resim seçiniz.:::warning';
                                                    } else {
                                                        $fileName = $_FILES["UserImageFile"]["name"];
                                                        $fileTMP = $_FILES["UserImageFile"]["tmp_name"];
                                                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                                                        $newName = rand() . '-' . $username . '.' . $ext;
                                                        $Path = 'uploads/' . $newName;
                                                        if (move_uploaded_file($fileTMP, $Path)) {
                                                            $add = $db->insert('INSERT INTO members(MemberUsername,MemberPassword,MemberEmail,
                                                            MemberName,MemberLastname,MemberCity,MemberBirthday,MemberGender,MemberPicture) 
                                                             VALUES (?,?,?,?,?,?,?,?,?)                                 
                                                            ', [$username, $password, $email, $name, $lastname, $city, $birthday, $gender, $newName]);
                                                            if ($add) {
                                                                $message = 'Kayıt başarı ile eklendi.:::success';
                                                            } else {
                                                                $message = 'Kayıt eklenirken bir hata oluştu.:::danger';
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        echo $message;
        break;
    case 'DeleteMember':
        $ID = $_GET["ID"];
        $delete = $db->delete("DELETE FROM members WHERE MemberID=?", [$ID]);
        if ($delete) {
            $message = "Kayıt silindi.:::success";
        } else {
            $message = "Kayıt silinemedi.:::danger";
        }
        echo $message;
        break;
    case 'fill':
        $ID = $_POST["TownValue"];
        $Option = '';
        $Option = '<option value="0">İlçenizi Seç</option>';
        $City = $db->getRows("SELECT * FROM town WHERE CityID=?", [$ID]);
        foreach ($City as $items) {
            $Option .= "<option value='" . $items->TownID . "'>" . $items->TownName . "</option>\n";
        }
        echo $Option;
        break;
}
