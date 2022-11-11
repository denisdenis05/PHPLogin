<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>


<div class="container">
    <div class="text-center pb-2">
        <div class="bg-primary py-5 px-4 px-sm-5" id="log">

            <h1 class="mb-4" > LOGIN!</h1 >
            <form class="py-5" action = "../loginparser/loginswitch.php" method = "post" >
                <div class="form-group" >
                    <input type = "email" name = "maillogin" class="form-control border-0 p-4" placeholder = "Email" required = "required" />
                </div >
                <div class="form-group" >
                    <input type = "password" name = "passlogin" class="form-control border-0 p-4" placeholder = "Parola" required = "required"/>
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

                    <button class="btn btn-dark btn-block border-0 py-3" type = "submit" name = "submitlogin" > LOGIN</button >
                </div >
                <p><br></p>
                <h5  onclick="document.location.href='authenticate.php'" name = "test" > Nu ai un cont? Da click aici!</h5 >
                <h7  style="color:#ffffff" onclick="document.location.href='forgotpass.php'" name = "test" > Ti-ai uitat parola? Da click!</h7 >

            </form >
            <button class="login-with-google-btn" onclick="document.location.href='redirect.php'" > Google Login </button >

        </div>
    </div>
</div>
</body>
</html>