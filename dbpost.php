<?php
date_default_timezone_set('Europe/Istanbul');

$tarih = date('d.m.Y H:i:s');

$servername = "servername";

// Veritabanı Bilgileri
$dbname = "dbname";
$username = "dbuser";
$password = "dbpass";

$api_key_value = "0000000000000";

$api_key= $sic = $nem = $bas = "";

$id = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $sic = test_input($_POST["sic"]);
        $nem = test_input($_POST["nem"]);
        $bas = test_input($_POST["bas"]);
        
        // Bağlantı oluşturma
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Bağlantıyı kontrol etme
        if ($conn->connect_error) {
            die("Bağlantı Hatası : " . $conn->connect_error);
        } 
        //"UPDATE tab1 SET tarih='$tarih', sic='$sic', nem='$nem', bas='$bas' WHERE ID='$id'"
        $sql = "UPDATE tab1 SET tarih='$tarih', sic='$sic', nem='$nem', bas='$bas' WHERE ID='$id'";
        
        
        if ($conn->query($sql) === TRUE) {
            echo "Yeni kayıt başarıyla güncellendi";
        } 
        else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "API Key Hatalı.";
    }

}
else {
    echo "HTTP POST ile hiçbir veri gönderilmedi.";
}

?>
