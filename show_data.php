<?php
$servername = "servername";
$database = "dbname";
$username = "dbuser";
$password = "dbpass";

$sql_baglantisi = mysqli_connect($servername, $username, $password, $database);

$db_sql = $sql_baglantisi->query("SELECT * FROM tab1");

$db_cek=mysqli_fetch_array ($db_sql);

$tarih 	= $db_cek["tarih"]; // tarih
$sic 	= $db_cek["sic"]; // sicaklik
$nem 	= $db_cek["nem"]; // nem
$bas 	= $db_cek["bas"]; // basinc

echo <<<EOF

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Adapazari, Sakarya - MyWeatherStation v1 - YigitOnem</title>
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="assets/fonts/font.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js""></script>

    <script src=" assets/js/slider.js" type="text/javascript">
    </script>

    <style>
        body {
            background-color: #6ab3c4;
        }
        
        .sp-body {
            width: 720px;
            height: 100%;
            position:relative;
            z-index: -9999999;
            margin-left: auto;
            margin-right: auto;
        }

        .hava-anlik-durum-wrapper {
            width: 720px;
            height: 620px;
            top: 0px;
            left: 0px;
        }

        .hava-anlik-durum-bg {
            width: 720px;
            height: 620px;
            top: 0px;
            left: 0px;
            background-image: url(assets/images/slider/s0.jpg);
            position: absolute;
            z-index: -99999999;
        }

        .hava-anlik-durum {
            max-width: 720px;
            text-align: center;
            color: #FFF;
            text-shadow: 7px 7px 8px #000;
        }

        .hava-anlik-durum .konum {
            font-size: 32px;
            margin-top: 32px;
        }

        .hava-anlik-durum .son-olcum {
            font-size: 22px;
        }

        .hava-anlik-durum .sicaklik {
            font-size: 110px;
            margin-top: 60px;
        }

        .hava-anlik-durum .hissedilen {
            font-size: 26px;
            margin-top: -36px;
            margin-bottom: 60px;
        }

        .hava-anlik-durum .nem {
            font-size: 24px;
        }

        .hava-anlik-durum .basinc {
            font-size: 24px;
        }

        .hava-anlik-durum .ruzgar {
            font-size: 24px;
        }

        .hava-anlik-durum .baslik {
            font-size: 24px;
            
        }

        .hava-tahmin-bg {
            width: 720px;
        }

        .yazi-beyaz {
            color: #FFF;
        }

        .tahmin-yazi {
            font-size: 24px;
            text-shadow: 5px 5px 6px #000;
        }

        .yazi-sol {
            text-align: left;
        }
        /*
        .hava-tahmin-item {
            width: 90px;
        }

        .hava-tahmin-item .sicaklik{
            width: 90px;
        }*/
    </style>

</head>

<body>
    <div class="sp-body">
        <div class="hava-anlik-durum-wrapper">
            <div class="hava-anlik-durum-bg">
                <div class="hava-anlik-durum">
                    <p class="konum">Maltepe Mah. Adapazarı, Sakarya</p>
                    <p class="son-olcum">Ölçüm Zamanı : $tarih </p>
                    <p class="sicaklik"> $sic C</p>
                    <p class="hissedilen">Hissedilen : $sic C </p>
                    <p class="hissedilen"> </p>

                    <div class="row">
                        <div class="col-sm-4">
                            <p class="baslik">Nem</p>
                            <p class="nem">% $nem </p>
                        </div>
                        <div class="col-sm 4">
                            <p class="baslik">Basınç</p>
                            <p class="basinc"> $bas hPa</p>
                        </div>
                        <div class="col-sm 4">
                            <p class="baslik">Rüzgar</p>
                            <p class="ruzgar">0 km/h</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hava-tahmin-bg yazi-beyaz tahmin-yazi">
            <hr>
            <div class="row  text-center">
                <div class="col-sm-3"> <b> Gün </b> </div>
                <div class="col-sm-3"> En Düşük (C) </div>
                <div class="col-sm-3"> En Yüksek (C) </div>
                <div class="col-sm-3"></div>
            </div>

            <div class="row  text-center">
                <div class="col-sm-3">Pazartesi</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3"> <img src="./assets/icon/png/bulut.png"> </div>
            </div>

            <div class="row  text-center">
                <div class="col-sm-3">Salı</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3"> <img src="./assets/icon/png/bulut.png"> </div>
            </div>

            <div class="row  text-center">
                <div class="col-sm-3">Çarşamba</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3"> <img src="./assets/icon/png/bulut.png"> </div>
            </div>

            <div class="row text-center">
                <div class="col-sm-3">Perşembe</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3"> <img src="./assets/icon/png/bulut.png"> </div>
            </div>

            <div class="row text-center">
                <div class="col-sm-3">Cuma</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3">0</div>
                <div class="col-sm-3"> <img src="./assets/icon/png/bulut.png"> </div>
            </div>
        </div>

        <hr>
        <div class="col">
            <br>
            <h6 class="text-center">*Sıcaklık ve Nem verilerini <b>kendi istasyonumuzdan</b> elde edilmektedir.</h6>
            <h6 class="text-center">*Basınç, rüzgar ve günlük tahminler <b>Meteoroloji Genel Müdürlüğü</b> sitesinden alınmaktadır.</h6>
            <br>
            
            <h6 class="text-center d-block"> C# - C++ - HTML - CSS - PHP - SQL </h6>
        </div>
    </div>

</body>

</html>

EOF;
?>
