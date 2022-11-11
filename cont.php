<?php
start();
function start(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        if(isset($_SESSION["filetoolarge"])) {
            echo "Te rog incarca o imagine de maxim 512kb.";
            unset($_SESSION["filetoolarge"]);
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
    <center>
<?php if(isset($_SESSION["LOGINNAME"])): ?>
<div class="container text-center py-5">
    <h1 class=text-white display-3 mb-5">Salut, <?php echo $_SESSION["LOGINNAME"];?>!</h1>
    <h3 class="text-primary mb-4">Administrare cont</h3>
</div>
<div class="container-fluid py-5">
    <div class="container">
        <div>
    <h5 onclick="document.location.href='adminpage.php'"><?php
if(isset($_SESSION["LOGINADMIN"]))
    echo "Bravo frate ai cont de administrator, da click ca sa intrii in control panel";
?> <br><br></h5>
        </div>
    </div>

    <div class="container" id="pfpcontainer">
        <h5 id="test">Imagine de profil <img src="<?php echo $_SESSION["LOGINPFP"]; ?>" style="border-radius: 50%" alt="pfp" width="30" height="30"> </h5>
        <input type="file" id="inputpfpimage" accept="image/*"/>
        <input type="submit" onclick="changepfp()" value="Incarca imaginea" name="submit">
    </div>
 <p><br></p>
    <div class="container" id="passwordcontainer">
        <h5 id="test">Parola</h5>
        <p onclick="location.href='loginauth/forgotpass.php'">Click aici pentru a iti schimba parola</p>
    </div>

</div>
<script>

    async function changepfp() {
        const inputImg = document.getElementById("inputpfpimage");
        const divtext = document.getElementById('test');
        var selectedFile = inputImg.files[0];
        if (selectedFile.size < 524288) {
            var reader = new FileReader();

            reader.onload = function () {
                //console.log(reader.result);
                form = document.createElement('form');
                form.setAttribute('method', 'POST');
                form.setAttribute('action', 'loginparser/changepfp.php');
                myvar = document.createElement('input');
                myvar.setAttribute('name', 'mydata');
                myvar.setAttribute('type', 'hidden');
                myvar.setAttribute('value', reader.result);
                form.appendChild(myvar);
                document.body.appendChild(form);
                form.submit();
            };

            reader.readAsDataURL(selectedFile);
        } else {
            text = document.createElement('p');
            text.setAttribute('style', 'color:red');
            text.innerText = "Imaginea incarcata e prea mare! Te rog incarca o imagine de maxim 512kb";
            const divcontainer = document.getElementById('pfpcontainer');
            divcontainer.appendChild(text);
        }
    }
</script>
<?php endif; ?>
<?php if(!isset($_SESSION["LOGINNAME"])): ?>
    <h1 onclick="location.href='index.php'">Nu te-ai conectat. Click aici pentru a merge la pagina principala.</h1>
<?php endif; ?>
</center>
</body>
</html>