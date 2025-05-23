<?php
session_start();

$kayitlikullaniciadi= "b241210100@sakarya.edu.tr";
$kayitlipassword="rüveyda";

if($_SERVER["REQUEST_METHOD"] == "POST"){   
    $kullaniciAdi=isset($_POST['kullaniciAdi'])? trim($_POST['kullaniciAdi']):'';
    $password=isset($_POST['password'])? trim($_POST['password']):'';
  
    if($kullaniciAdi===''||$password===''){
        header("Location:login.php?error=empty");
        exit();
        }
    if(mb_strtolower($kullaniciAdi,'UTF-8')===mb_strtolower($kayitlikullaniciadi,'UTF-8') && $password===$kayitlipassword){
        $_SESSION['kullanici']=$kayitlikullaniciadi;
        header("Location: hakkinda.html");
        exit();
    }
    else{
        header("Location: login.php?error=invalid");
        exit();
    }
}
?>