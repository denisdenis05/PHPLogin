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

    <!-- Font Awesome -->

    <!-- Libraries Stylesheet -->

    <!-- Customized Bootstrap Stylesheet -->
</head>

<body>
<center>
<div >
    <nav >
        <a href="index.php" >
            <h1><i class="fa fa-book"></i> Pregatiri Online</h1>
        </a>
        <button type="button" data-toggale="collapse" data-target="#navbarCollapse">
            <span></span>
        </button>
        <div id="navbarCollapse">
            <div>
                <div>
                    <?php if(isset($_SESSION["LOGINPFP"])): ?>
                    <a href="#" data-toggle="dropdown"> <img src="<?php echo $_SESSION["LOGINPFP"]; ?>" style="border-radius: 50%" alt="pfp" width="30" height="30"> Cont</a>
                    <?php endif; ?>
                    <?php if(!isset($_SESSION["LOGINPFP"])): ?>
                        <a href="#" data-toggle="dropdown">Cont</a>
                    <?php endif; ?>
                    <div >

                        <?php if(!isset($_SESSION["LOGINp"]) and !isset($_SESSION["auth"])) : ?>
                        <div id="log">

                            <h1 > LOGIN!</h1 >
                            <form  action = "loginparser/loginswitch.php" method = "post" >
                                <div >
                                    <input type = "email" name = "maillogin" placeholder = "Email" required = "required" />
                                </div >
                                <div  >
                                    <input type = "password" name = "passlogin"  placeholder = "Parola" required = "required"/>
                                </div >
                                
                                <div >

                                    <button  type = "submit" name = "submitlogin" > LOGIN</button >
                                </div >
                                <p><br></p>
                                <!--<h5  onclick="authchange()" name = "test" > Nu ai un cont? Da click aici!</h5 >-->
                                <h5  onclick="document.location.href='loginauth/authenticate.php'" name = "test" > Nu ai un cont? Da click aici!</h5 >
                                <h7  style="color:#ffffff" onclick="document.location.href='loginauth/forgotpass.php'" name = "test" > Ti-ai uitat parola? Da click!</h7 >

                            </form >
                            <button  onclick="document.location.href='redirect.php'" > Google Login </button >
                            <?php endif; ?>
                            <?php if(isset($_SESSION["LOGINp"])) : ?>
                            <div >
                                <?php
                                $nume=$_SESSION["LOGINNAME"];
                                ?>
                                <h2 style="color:white">Salut, <?php echo $nume; ?>!</h2>
                                <a href="cont.php" style="color:#2e294e"><b>Administreaza contul</b><br></a>
                                <a href="loginauth/disconnect.php" style="color:white">Deconecteaza-te</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
    </nav>
</div>
<!-- Navbar End -->


<!-- Header Start -->
<div>
    <div>
        <h1>Obtine usor</h1>
        <h1>Pregatire Online</h1>
        <h1>la materiile la care ai nevoie<br></h1>

        <div style="width: 100%; max-width: 600px;">
            <div>
                <input type="text" style="padding: 30px;" placeholder="Cauta materia care te intereseaza">
                <div>
                    <button>Cauta</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- About Start -->
<div>
    <div>
        <div>
            <div>
                <img src="img/about.jpg" alt="">
                <div>
                    <h3>Hai sa invatam!</h3>
                </div>
            </div>
            <div >
                <h6>mecanism</h6>
                <h1>Cum functioneaza?</h1>
                <p>'Pregatiri Online' va ofera resurse gratis pentru Evaluarea Nationala, Bacalaureat, dar si pentru cultura voastra generala. In cazul in care aveti nevoie de ajutor, puteti contacta un profesor online. Profesorii pot fi si elevi, astfel asiguram o atmosfera placuta.</p>
                <div>
                    <button type="button" data-toggle="modal"
                            data-src="https://www.youtube.com/embed/dQw4w9WgXcQ" data-target="#videoModal">
                        <span></span>
                    </button>
                    <h5>Vizioneaza videoclipul</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal -->
    <div  id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div role="document">
            <div >
                <div >
                    <button type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div >
                        <iframe  src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</center>

</body>

</html>