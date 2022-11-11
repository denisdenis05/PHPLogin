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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php if(isset($_SESSION["LOGINADMIN"])) : ?>
    <!-- Topbar Start -->
    <!-- <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>info@example.com</small>
                </div>
            </div>
           <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>-->
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand ml-lg-3">
                <h1 class="m-0 display-5 text-uppercase text-primary"><i class="fa fa-book"></i> Pregatiri Online</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Acasa</a>
                    <a href="about.php" class="nav-item nav-link">Despre</a>
                    <a href="price.php" class="nav-item nav-link">Servicii</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <div class="container text-center py-5">
        <h1 class=text-white display-3 mb-5">Salut, <?php echo $_SESSION["LOGINNAME"];?>!</h1>
        <h3 class="text-primary mb-4">Setari baza date</h3>
    </div>
    <div class="container" id="dbtabel">
        <h5 id="titludb">Setari baza date</h5>
        <table style="width:100%">
            <tr>
                <th>Id</th>
                <th>Nume</th>
                <th>Mail</th>
            </tr>
            <tr>
                <td id="id1">1</td>
                <td id="nume1">1</td>
                <td id="mail1">1</td>
            </tr>
            <tr>
                <td id="id2">1</td>
                <td id="nume2">1</td>
                <td id="mail2">1</td>
            </tr>
            <tr>
                <td id="id3">1</td>
                <td id="nume3">1</td>
                <td id="mail3">1</td>
            </tr>
            <tr>
                <td id="id4">1</td>
                <td id="nume4">1</td>
                <td id="mail4">1</td>
            </tr>
            <tr>
                <td id="id5">1</td>
                <td id="nume5">1</td>
                <td id="mail5">1</td>
            </tr>
        </table>
        <span onclick="previouspage()">Pagina anterioara</span> <span> | | </span> <span onclick="nextpage()">Pagina urmatoare</span>
        <p></p>
        <input type="number" min="1" id="searchbyid" placeholder="Cauta dupa id"/>
        <p></p>
        <input type="text" id="searchbyemail" placeholder="Cauta dupa mail"/> <input type="submit" onclick="searchbyemail()" value="Cauta" name="submit">
        <p>evita sa folosesti cautarea dupa email, ia multe resurse si mna</p>
        <script>
            const obj=`<?php include("config.php"); $result = $conn->query("SELECT id, name, email, admin FROM login"); while($row = $result->fetch_assoc()){ $res[$row["id"]]=$row;}    echo json_encode($res);?>`;
            let i=1;
            var results = JSON.parse(obj);
            const keys = Object.keys(results);
            let max=0;
            for (var p = 0; p < keys.length; p++)
                if(keys[p]>max)
                    max=keys[p];
            if(max%10<6)
                max=parseInt(max/10)*10+1;
            else if(max%10>6)
                max=parseInt(max/10)*10+6;

            updatepage();

            const idinput= document.getElementById("searchbyid");
            idinput.addEventListener('change', (e) => {
                console.log(e.target.value);
                if(e.target.value>max+4)
                {
                    const warning=document.getElementById('idwarning');
                    if(warning)
                        warning.parentNode.removeChild(warning);
                    text = document.createElement('p');
                    text.setAttribute('style', 'color:red');
                    text.setAttribute('id', 'idwarning');
                    text.innerText = "Nu exista mai mult de "+(max+4)+" id-uri!";
                    const divcontainer = document.getElementById('dbtabel');
                    divcontainer.appendChild(text);
                }
                else
                {
                    const warning=document.getElementById('idwarning');
                    let n=e.target.value;
                    if(warning)
                        warning.parentNode.removeChild(warning);
                    if(n%10<6)
                        n=parseInt(n/10)*10+1;
                    else if(n%10>6)
                        n=parseInt(n/10)*10+6;
                    i=n;
                    updatepage();
                }
            });

            function searchbyemail()
            {
                const mail=document.getElementById('searchbyemail').value;
                let ok=0;
                for(let k=1;k<=max+4;k++)
                {
                    if(results[k]["email"].localeCompare(mail)==0)
                    {
                        ok=1;
                        if(k%10<6)
                            k=parseInt(k/10)*10+1;
                        else if(k%10>6)
                            k=parseInt(k/10)*10+6;
                        i=k;
                        updatepage();
                    }
                }
                if(ok==0)
                {
                    text = document.createElement('p');
                    text.setAttribute('style', 'color:red');
                    text.setAttribute('id', 'mailwarning');
                    text.innerText = "Nu am gasit mail-ul '"+mail+"' !!";
                    const divcontainer = document.getElementById('dbtabel');
                    divcontainer.appendChild(text);
                }

            }

            function updatepage()
            {
                console.log(i);
                counter=1;
                for(let j=i;j<i+5;j++)
                {
                    if(j in results)
                        update(counter,j,1);
                    else
                        update(counter,j,0);
                    counter=counter+1;
                }
            }

            function previouspage() {
                if (i > 5) {
                    i = i - 5;
                    updatepage();
                }
            }

            function nextpage()
            {
                if(i+5<=max) {
                    i = i + 5;
                    updatepage();
                }
            }

            function update(counter,k,check) {
                console.log("id" + counter);
                if (check == 1) {
                    (document.getElementById("id" + counter)).innerText = k;
                    (document.getElementById("nume" + counter)).innerText = results[k]["name"];
                    (document.getElementById("mail" + counter)).innerText = results[k]["email"];
                }
                else
                {
                    (document.getElementById("id" + counter)).innerText = "-";
                    (document.getElementById("nume" + counter)).innerText = "-";
                    (document.getElementById("mail" + counter)).innerText = "-";
                }
            }

        </script>
    </div>

<?php endif; ?>
<?php if(!isset($_SESSION["LOGINADMIN"])) : ?>
    <div class="container text-center py-5">
        <h1 class=text-white display-3 mb-5">N-ai acces!</h1>
    </div>
<?php endif; ?>
</body>
</html>