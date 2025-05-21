<?php
$dizi_isimler=["friends","prison break","sherlock","teen wolf","the walking dead","from"];
$oyuncular=["Matthew Perry","Norman Reedus","Theo James","Dylan O'Brien","Mert Yazıcıoğlu","Yunus Emre Yıldırımer"];
$kitaplar=["Beyaz Geceler","Eylül","Sineklerin Tanrısı","Şeker Portakalı","Hayvan Çiftliği","Sol Ayağım"];
echo '
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF_8">
<title>İlgi Alanlarım</title>
<link rel="stylesheet" href="stil.css">
</head>
<body class="ilgialani">
<nav>
<nav>
<div class="navbar">
<a href="login.php">Giriş Sayfası</a>
            <a href="hakkinda.html">Hakkımda</a>
            <a href="ozgecmis.html">Öz Geçmiş</a>
            <a href="ilgialani.php">İlgi Alanım</a>
            <a href="mirasimiz.html">Mirasımız</a>
            <a href="sehrim.html">Şehrim</a>
            <a href="iletisim.html">İletişim</a>
            <a href="login.php">Çıkış Yap</a>
</div>
</nav>

<header>
<h1>İlgi Alanlarım</h1>
</header>
';

function yas_hesapla($dogum_tarihi){
    if(!$dogum_tarihi) return "Bilinmiyor";
    $dogum= new DateTime($dogum_tarihi);
    $bugun= new DateTime();
    $fark=$bugun->diff($dogum);
    return $fark->y. " yaşında";
}

echo "<div class='baslik'>Diziler</div>";
echo "<div class='container'>";

foreach($dizi_isimler as $dizi_adi){
$url="https://api.tvmaze.com/search/shows?q=".urlencode($dizi_adi);
$response=file_get_contents($url);
$data=json_decode($response,true);

if(!empty($data)){
    $show=$data[0]['show'];
    echo "<div class='card'>";
    echo "<strong>Dizi Adı:</strong> ",$show['name']."<br>";

    if(isset($show['image'])&& isset($show['image']['medium'])){
        $imageurl=$show['image']['medium'];
        echo "<img src='{$imageurl}' alt='Poster'><br>";
    }
    else{
        echo "Görsel yok.<br>";
    }
    if(!empty($show['genres'])){
        echo "<strong>Tür:</strong> ",implode(",", $show['genres'])."<br>";
    }
    if(!empty($show['summary'])){
        echo "<small>", substr(strip_tags($show['summary']),0,100). "...</small><br>";
    }
    echo "</div>";
}
else{
    echo "<div class='card'>\"$dizi_adi\" için sonuç bulunamadı.</div>";
}
}
echo "</div>";

echo "<div class='baslik'>Sanatçılar</div>
<div class='container'>";

foreach($oyuncular as $isim){
    $url="https://api.tvmaze.com/search/people?q=" . urlencode($isim);
    $response=file_get_contents($url);
    $data=json_decode($response,true);

    if(!empty($data)){
        $person=$data[0]['person'];
        $ozel_bilgiler=[
            "Yunus Emre Yıldırımer" =>["birthday" => "1982-02-05"]
        ];
        $dogum_tarihi=$person['birthday'] ?? ($ozel_bilgiler[$isim]['birthday'] ?? null);

        echo "<div class='card'>";
        echo "<strong> Adı Soyadı:</strong> " . $person['name'] . "<br>";
        echo "<strong> Yaşı:</strong> " . yas_hesapla($dogum_tarihi) . "<br>";
        echo "<strong> Doğum Günü:</strong> " . ($dogum_tarihi ??"Bilinmiyor"). "<br>";
        $img=$person['image']['medium']?? "https://via.placeholder.com/230x300?text=Yok";
        echo "<img src='{$img}'><br>";
        echo "</div>";
    }
}
echo "</div>";
echo "<div class='baslik'>Kitaplar</div>
<div class='container'>";

foreach($kitaplar as $kitap){
    $url="https://openlibrary.org/search.json?q=" . urlencode($kitap);
    $json=file_get_contents($url);
    $data=json_decode($json,true);

    if(!empty($data['docs'])){
        $book=$data['docs'][0];
        echo "<div class='card'>";
        echo "<h3>" . htmlspecialchars($book['title']?? "Başlık yok")."</h3>";
        if(!empty($book['cover_i'])){
            $cover_url="https://covers.openlibrary.org/b/id/" . $book['cover_i']."-M.jpg";
            echo "<img src='$cover_url' alt='Kapak'>";
        }
        else{
            echo "<p>Kapak resmi yok.</p>";
        }
        echo "<strong>Yazarı: </strong>". htmlspecialchars($book['author_name'][0]?? "Bilinmiyor")."<br>";
        echo "<strong>Yayın Yılı: </strong>". htmlspecialchars($book['first_publish_year']?? "Bilinmiyor") . "<br>";
        echo "</div>";
    }
    else{
        echo "<div class='card'>\"$kitap\" için sonuç bulunamadı.</div>";
    }
}
echo "</div>";
echo '</body></html>';
?>
