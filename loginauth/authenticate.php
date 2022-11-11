<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["emailexistent"])) {
    echo "Deja ai un cont pe acest email. Apasa mai jos pe 'Ai deja un cont?...' pentru a te conecta la acesta.";
    unset($_SESSION["emailexistent"]);
}
else if(isset($_SESSION["slowmodeactiv"])) {
    $timp=time();
    $timp2=$_SESSION["slowmodeactiv"];
    echo "Te rog asteapta ".(30-($timp-$timp2))." secunde inainte sa iti creezi un cont.";
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

<div>
    <div>
        <div id="log">

            <h1> Autentificare!</h1 >
            <form action = "../loginparser/authswitch.php" method = "post" >
                <div>
                    <input type = "email" name = "mailauth" placeholder = "Email" required = "required" />
                </div >
                <div class="form-group" >
                    <input type = "text" name = "nameauth" placeholder = "Nume" required = "required" />
                </div >
                <div class="form-group" >
                    <input type = "password" name = "passauth" class="form-control border-0 p-4" placeholder = "Parola" required = "required"/>
                </div >
                <div class="form-group" >
                    <input type = "password" name = "passauth2" class="form-control border-0 p-4" placeholder = "Repeta parola" required = "required"/>
                </div >
                <!-- <div class="form-group" >
                     <select class="custom-select border-0 px-4" style = "height: 47px;" >
                         <option selected > Select A Service </option >
                         <option value = "1" > Service 1 </option >
                         <option value = "2" > Service 1 </option >
                         <option value = "3" > Service 1 </option >
                     </select >
                 </div > -->
                <div >
                    <button class="btn btn-dark btn-block border-0 py-3" type = "submit" name = "submitlogin" > Creaza cont</button >
                </div >
                <p><br></p>
                <h5  onclick="document.location.href='login.php'" name = "test" > Ai deja un cont? Da click aici!</h5 >

            </form >
            <button class="login-with-google-btn" onclick="document.location.href='redirect.php'" > Google Login </button >
        </div>
    </div>
</div>
</body>
</html>