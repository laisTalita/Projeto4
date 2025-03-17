<?php
include_once('arquivos.php/conect.php');
if (isset($_POST["login"])) {
    echo ($_POST['login']);
}
if (isset($_POST['login_but'])) {
    $senha =$_POST['senha'];
    $email= $_POST['email'];

    $stmt = $conn->prepare("SELECT email FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() >0) {
        echo "usuario já consta no sistema!";
    }
    else{
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmtCriar = $conn->prepare("INSERT INTO usuario (email,senha) VALUES (:email,:senha)");
        $stmtCriar->bindParam(':email', $email);
        $stmtCriar->bindParam(':senha', $senhaHash);
        if ($stmtCriar->execute()) {
        echo "conta criada com sucessso";
        }else{
            echo "erro";
        }
    }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo/style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark border-bottom -1 border-light">
        <a class="navbar-brand" href="#">
            <i class="bi bi-calendar text-info"></i>
            App Chronos
        </a>
    </nav>
    <main class="d-flex justify-content-center align-items-center text-center"> 

        <div id="login" class=" rounded-lg d-flex  align-items-center justify-content-center ">
            <div id="img" class="rounded-lg"></div>
            <div id="logar" class="card border-0 login">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title text-center text-dark ">Login</h4>
                    <form action="arquivos.php/verificaLogin.php" method="POST">                        
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text"><i class="bi bi-person-fill text-dark "></i></span>
                            <input type="email" name="email" id="email" class="form-control py-4" aria-describedby="emailHelp" placeholder="E-mail">
                        </div>
                        <div class="input-group mb-4 ">
                            <span class="input-group-text"><i class="bi bi-lock-fill text-dark "></i>
                            </span>
                            <input type="password" name="senha" id="senha" class="form-control py-4" maxlength="30" minlength="3" placeholder="Senha">
                        </div>     
                        <?php if (isset($_GET['login']) && $_GET['login']=='erro') { ?>
                            <div class="text-danger">Erro: Credenciais inválidas</div>

                        <?php }?>
                        <?php if (isset($_GET['login']) && $_GET['login']=='erro2') { ?>
                            <div class="text-danger">Faça login pra continuar</div>
                        <?php }?>

                        <button id="botao" name="entrar" type="submit" class="btn btn-info w-75">Entrar</button>
                        <br>
                        <a href="#" onclick="trocardiv('criar')" class="text-dark">Criar Conta</a>
                    </form>
                </div>
            </div>
            <div id="criar" class="card border-0 oculto login" >
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title text-center text-dark ">Criar Conta</h4>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">                        
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text"><i class="bi bi-person-fill text-dark "></i></span>
                            <input type="email" name="email" id="email" class="form-control py-4" aria-describedby="emailHelp" placeholder="E-mail">
                        </div>
                        <div class="input-group mb-4 ">
                            <span class="input-group-text"><i class="bi bi-lock-fill text-dark "></i>
                            </span>
                            <input type="password" name="senha" id="senha" class="form-control py-4" maxlength="30" minlength="3" placeholder="Senha">
                        </div>
                        <button class="btn btn-info w-75" name="login_but" type="submit">Criar</button>     
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        function trocardiv(id){
            document.querySelectorAll('.login').forEach(element => {
                element.classList.add("oculto")
            });
            document.getElementById(id).classList.remove("oculto")
        }
    </script>
</body>
</html>