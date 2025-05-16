<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

$kayitlikullaniciadi= "b241210100@sakarya.edu.tr";
$kayitlipassword="rüveyda";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $kullaniciAdi=isset($_POST['kullaniciAdi'])? trim($_POST['kullaniciAdi']):'';
    $password=isset($_POST['password'])? trim($_POST['password']):'';

    if(mb_strtolower($kullaniciAdi,'UTF-8')===mb_strtolower($kayitlikullaniciadi,'UTF-8') && $password===$kayitlipassword){
        $_SESSION['kullanici']=$kayitlikullaniciadi;
        header("Location: hakkinda.html");
        exit();
    }
    else{
        header("Location: login.html?error=1");
        exit();
    }
    else{
        header("Location: login.html");
        exit();
    }
}
ob_end_flush();
?>