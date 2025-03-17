<?php require_once("../arquivos.php/validador.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../estilo/style.css">
</head>
<body>

<main class="d-flex justify-content-center align-items-center vh-90">
    <div id="card_home" class="d-flex flex-wrap justify-content-around align-items-center w-75 p-5 ">
        <div class="card bg-white m-2" style="width: 22rem;">
            <i class="bi bi-pencil-square text-center p-1 bg-info text-white icone-home"></i>
            <div class="card-body p-4">
                <h5 class="card-title p-2">Abrir Anotação</h5>
                <a href="abrir_chamado.php" class="btn btn-dark w-50">Acessar</a>
            </div>
        </div>
        <div class="card bg-white m-2" style="width: 22rem; ">
            <i class="bi bi-search text-center p-1 bg-info text-white icone-home"></i>
            <div class="card-body p-4">
                <h5 class="card-title p-2">Pesquisar Compromisso</h5>
                <a href="consultar_chamado.php" class="btn btn-dark w-50">Acessar</a>
            </div>
        </div>
    </div>
</main>
<footer class="bg-dark text-light p-2 text-center"> Lais Talita</footer>
</body>
</html>