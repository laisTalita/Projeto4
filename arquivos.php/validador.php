<?php
session_start();
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])){
    header("Location:../index.php?login=erro2");
    exit();
}
include_once("crud.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark border-bottom -1 border-light">
        <a class="navbar-brand" href="#">
            <i class="bi bi-calendar text-info"></i>
            App Chronos
        </a>
        <ul class="navbar-nav">
            <li class="nav-item mr-3">
                <a class="nav-link" href="../sair.php"><i style="font-size:1.2em;" class="bi bi-box-arrow-right"></i> <span>SAIR</span> </a>
             </li>
        </ul>
    </nav>
  

</body>
</html>