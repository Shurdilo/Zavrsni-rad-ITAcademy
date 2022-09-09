<?php 
$activePage = basename($_SERVER['PHP_SELF'], ".php");

switch ($activePage) {
    case "index":
        $titlePage = "| Početna";
        break;
    case "portfolio":
        $titlePage = "| Portfolio";
        break;
    case "orders":
        $titlePage = "| Naruči";
        break;
    case "contact":
        $titlePage = "| Kontakt";
        break;
    case "profile":
        $titlePage = "| Profil";
        break;
    case "changepassword":
        $titlePage = "| Promjena lozinke";
        break;
    case "login":
        $titlePage = "| Prijava";
        break;
    case "registration":
        $titlePage = "| Registracija";
        break;
    default:
        $titlePage = "";
  }
?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wizard Print <?php echo $titlePage ?></title>
<link rel=icon href="img/favicon.ico">

<!-- Icons -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Styles -->
<link rel="stylesheet" href="css/root.css">