<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    if(isset($_SESSION["diffcode"])) {
        echo "Codul nu este corect. Incearca din nou";
        unset($_SESSION["diffcode"]);
    }
?>
<!DOCTYPE html>
<html lang="en">

<body onload="timer(<?php if ( isset($_SESSION["slowmode"])) {
    $timp = time();
    $slowmode = $_SESSION["slowmode"];
    echo $timp-$slowmode;
}
else
    echo 31;
?>)">
    <meta charset="utf-8">
    <title>Pregatiri Online</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="pregatire online" name="keywords">
    <meta content="Pregatiri Online" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="text-center pb-2">
        <div class="bg-primary py-5 px-4 px-sm-5" id="log">

            <h1 class="mb-4" > Pentru a continua, introdu codul primit in mail!</h1 >
            <form class="py-5" action = "../loginparser/codeverify.php" method = "post" >
                <div class="form-group" >
                    <input type = "text" name = "codver" class="form-control border-0 p-4" placeholder = "Cod verificare" required = "required" />
                </div >
                <div >
                    <button class="btn btn-dark btn-block border-0 py-3" type = "submit" name = "submitlogin" >Verificare</button >
                </div >
                <p><br></p>
                <div id="textcod">
                <h5 name = "test" > Nu ai primit codul? Apasa aici pentru a retrimite mail-ul!</h5 >
                </div>
            </form >
        </div>
    </div>
</div><script>
    function timer(time) {
        const divtext = document.getElementById('textcod');
        var copietime= time;
        divtext.innerHTML = `<h5 name = "test">Nu ai primit codul? Asteapta ` + String(30 - copietime) + ` secunde pentru a trimite alt cod.</h5 >`;
        if (30 - time >= 0) {
            setTimeout(function(){timer(time+1);}, 1000);
        } else {
            divtext.innerHTML = `<h5  onclick="document.location.href='../loginparser/codeforgot.php'" name = "test">Nu ai primit codul? Apasa aici pentru a retrimite un email!</h5 >`;
        }
    }
</script>
</body>
</html>