<?php
$error=isset($_GET['error'])? $_GET['error']:'';
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <?php if($error=='empty'):?>
        <div class="alert alert-warning text-center" role="alert" style="margin-bottom:1rem;">
        Kullanıcı adı veya şifre alanlarını boş bırakmayın!
        </div>
        <?php elseif ($error=='invalid'): ?>
            <div class="alert alert-danger text-center" role="alert" style="margin-bottom:1rem;">
                Kullanıcı adı veya şifre hatalı!
        </div>
        <?php endif; ?>
        
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div class="container" style="max-width: 500px;">
            <div class="bg white p-4 rounded shadow text-center">
                <form action="sunucu.php" method="POST" id="loginForm">
                    <h1 class="h3 mb-3 fw-normal text-center">Giriş Yap</h1>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="kullaniciAdi" name="kullaniciAdi" placeholder="name@example.com">
                        <label for="kullaniciAdi">E-posta adresi</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Şifre">
                        <label for="password">Şifre</label>
                    </div>
                    <button class="btn btn-primary w-100 py-2" type="submit">Giriş Yap</button>
                </form>
            </div>
        </div>
    </main>
    <script>
        document.getElementById("loginForm").addEventListener("submit",function(e){
            const email=document.getElementById("kullaniciAdi").value.trim();
            const password=document.getElementById("password").value.trim();
            const emailKontrol=/^[a-zA-Z0-9._%+-]+@sakarya\.edu.tr$/;
            if(email==="" || password==="" ){
                alert("Kullanıcı adı ve şifre boş geçilemez.");
                e.preventDefault();
                return;
            }
            if(!emailKontrol.test(email)){
                alert("Geçerli bir Sakarya Üniversitesi e-posta adresi giriniz.");
                e.preventDefault();
                return;
            }
        }); 
    </script>
    <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>