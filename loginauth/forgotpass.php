<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["slowmodeactiv"])) {
    $timp=time();
    $timp2=$_SESSION["slowmodeactiv"];
    echo "Te rog asteapta ".(30-($timp-$timp2))." secunde inainte sa iti resetezi parola din nou.";
    unset($_SESSION["slowmodeactiv"]);
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

<div class="container">
    <div class="text-center pb-2">
        <div class="bg-primary py-5 px-4 px-sm-5" id="log">

            <h1 class="mb-4" > Pentru a recupera parola, introdu adresa ta de mail!</h1 >
            <form class="py-5" action = "../loginparser/codeforgot.php" method = "post" >
                <div class="form-group" >
                    <input type = "email" name = "mailforgot" class="form-control border-0 p-4" placeholder = "Email" required = "required" />
                </div >
                <div >
                    <button class="btn btn-dark btn-block border-0 py-3" type = "submit" name = "submitlogin" >Recuperare</button >
                </div >
                <p><br></p>
                <!--<h5  onclick="document.location.href='login.php'" name = "test" > Nu ai primit codul? Apasa aici pentru a retrimite mail-ul!</h5 >-->

            </form >
        </div>
    </div>
</div>
</body>
</html>