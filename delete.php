<?php
require_once "db/database.class.php";
require_once "safe.php";

use \project\db\Database;

$db = new Database;
$message = NULL;
$ID = intval($_GET["ID"]);
$delete = $db->delete('DELETE FROM members WHERE MemberID=?', [$ID]);
?>
<head>
    <meta charset="UTF-8">
    <title>RecorD Delete</title>
</head>

<body>
    <script>
        alert("Kayıt silindi. Tamam butonuna tıklayıp Üyeler sayfasına gidin.");
    </script>
</body>
<?php
header("Refresh:0;url=members.php");
