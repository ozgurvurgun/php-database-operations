<?php
require_once "db/database.class.php";
require_once "safe.php";

use \project\db\Database;

$db = new Database;

@$operation = $_GET["page"];
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
    case 'SaveMember':         

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
                $message = ':::Lütfen sözleşmeyi onaylayın.:::warning';
            } else {
                if (
                    empty($username) or empty($password) or empty($email) or
                    empty($name) or empty($lastname) or
                    empty($birthday) or empty($gender)
                ) {
                    $message = ':::Lütfen boş alanları doldurun.:::warning';
                } else {
                    if ($city == 0) {
                        $message = ':::Lütfen şehir seçin.:::warning';
                    } else {
                        if (strlen($username) < 5 or strlen($username) > 35) {
                            $message = ':::Kullanıcı adı 5 karakterden kısa, 35 karakterden uzun olamaz.:::warning';
                        } else {
                            if (strlen($password) < 8 && strlen($password) < 50) {
                                $message = ':::Parolanız 8 karakterden kısa, 50 karakterden uzun olamaz.:::warning';
                            } else {
                                if (!preg_match('/^[a-zA-ZıİğĞöÖüÜşŞçÇ\s]+$/u', $name)) {
                                    $message = ':::Adınızı abudik gubidik girmeyiniz.:::warning';
                                } else {
                                    if (!preg_match('/^[a-zA-ZıİğĞöÖüÜşŞçÇ\s]+$/u', $lastname)) {
                                        $message = ':::Soy adınızı abudik gubidik girmeyiniz.:::warning';
                                    } else {
                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            $message = ':::E-posta formatınız doğru değil. Lütfen kontrol edin.:::warning';
                                        } else {
                                            if (!preg_match('/^(?=.*[A-ZİĞÖÜŞÇ])(?=.*[a-zığöüşç])(?=.*[0-9]).{8,20}/u', $password)) {
                                                $message = ':::Parolanız belirtilen formatta değil. Lütfen güvenliğiniz için tekrar kontrol edin.:::warning';
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
                                                    $message = ':::"' . $username . '" kullanıcı adı kullanılıyor.:::warning';
                                                } elseif ($isEmail) {
                                                    $message = ':::"' . $email . '" email adresi kullanılıyor.:::warning';
                                                } else {

                                                    $add = $db->insert('INSERT INTO members(MemberUsername,MemberPassword,MemberEmail,
                                                                MemberName,MemberLastname,MemberCity,MemberBirthday,MemberGender) 
                                                                 VALUES (?,?,?,?,?,?,?,?)                                 
                                                                ', [$username, $password, $email, $name, $lastname, $city, $birthday, $gender]);
                                                    if ($add) {
                                                        $query = $db->getRows("CALL MEMBERS()");
                                                        $message="";
                                                        foreach ($query as $items) {
                                                            $message.='<tr id="'.$items->MemberID.'">
                                                            <th scope="row">'.$items->MemberID.'</th>
                                                            <td><img src="uploads/'.$items->MemberPicture.'" width="70px" height="70px"></td>
                                                            <td>'. $items->MemberUsername .'</td>
                                                            <td>'. $items->MemberName .'</td>
                                                            <td>'. $items->MemberLastname .'</td>
                                                            <td>'. $items->CityName.' </td>
                                                            <td>'. $items->MemberPassword .'</td>
                                                            <td>'. $items->MemberEmail .'</td>
                                                            <td>'. $items->MemberBirthday .'</td>
                                                            <td>'. $items->MemberAddtime .'</td>
                                                            <td>'; if ($items->MemberGender === "F")
                                                            $message.='Kadın';
                                                            else  $message.="ERKEK";
                                                            $message.=' </td>
                                                             <td><a href="edit.php?ID="'.$items->MemberID.'">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square text-info" viewBox="0 0 16 16">
                                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                    </svg>
                                                                </a></td>
                                                            <td><a href="javascript:void(0)" onclick="RemoveAll(\'DeleteMember\','.$items->MemberID.')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </a></td>
                                                        </tr>';
                                                        }
                                                        $message .= ':::Kayıt başarı ile eklendi.:::success';
                                                    } else {
                                                        $message .= ':::Kayıt eklenirken bir hata oluştu.:::danger';
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

