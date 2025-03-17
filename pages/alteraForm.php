<?php
include_once("../arquivos.php/validador.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../estilo/style0.2.css">
</head>

<body>
    <main id="main_abrirChamado" class="d-flex justify-content-center align-items-center w-100 vh-100">
        <div class="card w-75 principal">
            <div class="card-header text-center bg-secondary">
                <i class="bi bi-pencil" style="font-size:1.3em"></i>
            </div>
            <div class="card-body">
                <?php

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $stmt = $conn->prepare('SELECT * FROM chamados WHERE id =?');
                    $stmt->bindParam(1, $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                }

                if (isset($_POST['salvar'])) {
                    $id = $_POST['id'];
                    $alterar = alterarChamado(
                        $_POST['nome'],
                        $_POST['titulo'],
                        $_POST['categoria'],
                        $_POST['data'],
                        $_POST['descricao'],
                        $id
                    );
                    header("Location: consultar_chamado.php");
                    exit();
                }
                ?>
                <form class="w-100" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control"
                            value="<?= isset($_POST['nome']) ? $_POST['nome'] : $result['nome'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" name="titulo" class="form-control"
                            value="<?= isset($_POST['titulo']) ? $_POST['titulo'] : $result['titulo'] ?> ">
                    </div>
                    <div class="form-group">
                        <label class="visually-hidden" for="inlineFormSelectPref">Categoria</label>
                        <select class="form-select" id="inlineFormSelectPref" name="categoria">
                            <?php
                            $query = $conn->query("SELECT id, nome FROM categorias ORDER BY nome ASC");
                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($registros as $row) { ?>
                                <option
                                    value="<?= $row['id'] ?><? $row['id'] == $result['categoria_id'] ? 'selected' : '' ?>">
                                    <?php echo $row['nome']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" name="data"
                            value="<?= isset($_POST['data']) ? $_POST['data'] : date('Y-m-d', strtotime($result['data'])) ?>">
                    </div>
                    <div class="form-floating text-left">
                        <label for="floatingTextarea ">Descrição</label>
                        <textarea name="descricao" class="form-control">
                            </textarea>
                    </div>
                    <div class="w-100 d-flex justify-content-center my-2 ">
                        <button type="submit" name="salvar" class="btn btn-danger botao">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<footer class="bg-dark text-light p-2 text-center"> Lais Talita</footer>
</html