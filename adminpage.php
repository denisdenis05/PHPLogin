<?php
start();
function start(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        if(isset($_SESSION["diffpass"])) {
            echo "Parolele nu coincid. Incearca din nou";
            unset($_SESSION["diffpass"]);
        }
        if(isset($_SESSION["contschimbat"])) {
            echo "Parola a fost schimbata cu succes.";
            unset($_SESSION["contschimbat"]);
        }
        if(isset($_SESSION["contcreat"])) {
            echo "Contul a fost creat cu succes.";
            unset($_SESSION["contcreat"]);
        }
        if(isset($_SESSION["shortpass"])) {
            echo "Parola trebuie sa contina minim 8 caractere, incearca din nou.";
            unset($_SESSION["shortpass"]);
        }
        if(isset($_SESSION["wrongpass"])) {
            echo "Email sau parola incorecta. Incearca din nou!";
            unset($_SESSION["wrongpass"]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pregatiri Online</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="pregatire online" name="keywords">
    <meta content="Pregatiri Online" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
<?php if(isset($_SESSION["LOGINADMIN"])) : ?>

<div class="container text-center py-5">
    <h1 class=text-white display-3 mb-5">Salut, <?php echo $_SESSION["LOGINNAME"];?>!</h1>
    <h3 class="text-primary mb-4">Control panel (pentru admini evident)</h3>
</div>
<div class="container-fluid py-5">
    <div class="container">
        <div>
            <h5>Setari:</h5>
        </div>
    </div>
</div>

    <div class="container" id="dbtabel">
        <h5 id="titludb">Setari baza date</h5>
        <p onclick="location.href='admindatabase.php'">Da click pentru a vedea baza de date. (s-ar putea sa se miste greu pe dispozitive mobile)</p>
    </div>

<?php endif; ?>
<?php if(!isset($_SESSION["LOGINADMIN"])) : ?>
<div class="container text-center py-5">
    <h1 class=text-white display-3 mb-5">N-ai acces!</h1>
</div>
<?php endif; ?>
</body>
</html>