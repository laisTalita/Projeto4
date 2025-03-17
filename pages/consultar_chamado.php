<?php require_once("../arquivos.php/validador.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../estilo/style0.2.css">
</head>

<body>
<style>
    #icones-consultar_chamado button:hover {
        background-color: lightgray;
        cursor: pointer;
    }
    .card_principal {
        height: 70vh;
        min-width: 300px;
        background-color: transparent;
    }
    .card-body {
        overflow-y: auto;
        padding: 10px;
    }
</style>
    <main id="main_abrirChamado" class="d-flex justify-content-center align-items-center w-100 vh-100">
        <div class="card w-75 card_principal">
            <div class="card-header bg-dark text-light d-flex justify-content-between">
                <div class="d-none d-md-block "><h5>Consulta de chamado</h5></div>
                <div class=" rounded-4 w-auto">
                    <i class="bi bi-search fw-bold text-white pl-1"></i>
                    <input type="text" name="busca" id="busca" class="w-50 h-100 p-1" placeholder="Buscar..">
                    <button onclick="buscar()" class="h-100 bg-dark text-light p-1 px-1 bot_busca">Buscar</button> 
                </div>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['busca'])) {
                    $busca = $_GET['busca'];
                    $chamados =consultarChamado(busca: $busca) ; 
                }else{
                    $chamados =consultarChamado() ; 
                }
                if (!empty($chamados)) {
                    foreach ($chamados as $chamado) { ?>
                        <div class="card w-90 mt-5 mb-2">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $chamado['titulo']; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Chamado - Categoria
                                    <?php echo $chamado['categoria_id']; ?></h6>
                                <p> <?= "Nome: ". $chamado['nome']?></p>
                                <p class="card-text">
                                    <?php echo $chamado['descricao']; ?>
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-between ">
                                <?php echo $chamado['data']; ?>
                                <div id="icones-consultar_chamado">
                                    <?php
                                    if (isset($_POST['excluirChamado']) && isset($_POST['chamado_id'])) {
                                        $id_chamado = $_POST['chamado_id'];
                                        excluirChamado($id_chamado);
                                    }
                                    ?>
                                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="d-inline">
                                        <input type="hidden" name="chamado_id" value="<?php echo $chamado['id']; ?>">
                                        <button name="excluirChamado" class="d-inline p-1 border shadow-sm btn btn-danger "
                                            type="submit">
                                            <i class="bi bi-trash3 m-1" style="font-size:1.3em"></i>
                                        </button>
                                    </form>
                                    <a href="alteraForm.php?id=<?php echo $chamado['id']?>">
                                        <button class="d-inline p-1 border shadow-sm  btn btn-success">
                                        <i class="bi bi-pencil text-white m-1" style="font-size:1.3em"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php } } ?>
            </div>
            <div class="card-footer text-center">
                <a href="home.php"><button class="btn btn-info text-center botao">Voltar</button></a>
            </div>
        </div>
    </main>
    <footer class="bg-dark text-light p-2 text-center"> Lais Talita</footer>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

      <script>
        function buscar() {
            let busca = document.getElementById('busca').value
            let urlBase = window.location.pathname;
            window.location.href = `${urlBase}?busca=${encodeURIComponent(busca)}`;
        }
        document.getElementById('busca').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                buscar();
            }
        });
    
      </script>
</body>


</html>