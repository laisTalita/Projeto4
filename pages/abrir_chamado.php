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
    <?php
    if (isset($_POST["enviar"])) {
        inserirChamado($_POST["nome"],$_POST["titulo"], $_POST["categoria"], $_POST["data"],$_POST["descricao"]);
    }
    ?>
    <main id="main_abrirChamado" class="d-flex justify-content-center align-items-center w-100 vh-100">
        <div class="card w-75 principal">
            <div class="card-header bg-secondary">
                Anotação
            </div>
            <div class="card-body">
                <form class="w-100" action="<?= $_SERVER['PHP_SELF']?>" method="POST" >
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control" placeholder="Digite o nome" required>
                    </div>
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" name="titulo" class="form-control" placeholder="Título" required>
                    </div>
                    <div class="form-group">
                        <label class="visually-hidden" for="inlineFormSelectPref">Categoria</label>
                        <select class="form-select" id="inlineFormSelectPref" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <?php
                            $query = $conn->query("SELECT id, nome FROM categorias ORDER BY nome ASC");
                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($registros as $row) {
                                ?>
                                <option value="<?php echo $row['id'] ?>">
                                    <?php echo $row['nome']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" name="data">
                    </div>
                    <div class="form-floating">
                        <label for="floatingTextarea">Descrição</label>
                        <textarea name="descricao" class="form-control"></textarea>
                    </div>
                    <div class="w-100 d-flex justify-content-around align-items-center mt-2 ">
                        <button onclick="history.go(-1)" class="btn btn-info w-25 ">Voltar</button>
                        <button type="submit" name="enviar" class="btn btn-danger w-25">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                <div>
                    <?php
                    date_default_timezone_set('America/Sao_Paulo');
                    echo date('d / m / Y');
                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-dark text-light p-2 text-center"> Lais Talita</footer>

</body>
</html>