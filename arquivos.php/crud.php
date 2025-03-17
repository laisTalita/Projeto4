<?php
include("conect.php");

function inserirChamado($nome, $titulo, $categoria, $data, $descricao)
{
    global $conn;
    if (isset($_SESSION['id'])) {
        $id_user = $_SESSION['id'];

        $stmt = $conn->prepare("INSERT INTO chamados (nome,titulo,categoria_id,data,descricao, id_usuario) VALUES (?, ?, ?, ? ,? ,?) ");

        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $titulo);
        $stmt->bindParam(3, $categoria);
        $stmt->bindParam(4, $data);
        $stmt->bindParam(5, $descricao);
        $stmt->bindParam(6, $id_user);
        $stmt->execute();
    } else {
        echo "Usuário não está logado.";
    }
}
function consultarChamado($busca = null)
{
    global $conn;

    if (isset($_SESSION['id'])) {
        $id_user = $_SESSION['id'];

        if ($busca) {
            $sql = ("SELECT * FROM chamados WHERE id_usuario =? AND (nome LIKE ? OR titulo LIKE ? OR DATE_FORMAT(data,'%d/%m/%Y') LIKE ? OR descricao LIKE ? OR categoria_id LIKE ?)");
            $busca = "%$busca%";
            $stmt = $conn->prepare($sql);
            
            $stmt->bindParam(1, $id_user, PDO::PARAM_INT);
            $stmt->bindParam(2, $busca, PDO::PARAM_STR);
            $stmt->bindParam(3, $busca, PDO::PARAM_STR);
            $stmt->bindParam(4, $busca, PDO::PARAM_STR);
            $stmt->bindParam(5, $busca, PDO::PARAM_STR);
            $stmt->bindParam(6, $busca, PDO::PARAM_STR);
        }
        else{
            $sql =("SELECT * FROM chamados WHERE id_usuario =?");
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$id_user);

        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        echo "erro";
    }
}
function excluirChamado($chamado_id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM chamados WHERE id = ?");
    $stmt->bindParam(1, $chamado_id, PDO::PARAM_INT);
    $stmt->execute();
}
function alterarChamado($nome, $titulo, $categoria, $data, $descricao,$id){
    global $conn;
    $stmt = $conn->prepare("UPDATE chamados SET nome =?,titulo=?,categoria_id =?, data=?, descricao =? WHERE id = ?");
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $titulo);
    $stmt->bindParam(3, $categoria);
    $stmt->bindParam(4, $data);
    $stmt->bindParam(5, $descricao);
    $stmt->bindParam(6, $id, PDO::PARAM_INT);
    $stmt->execute();
    }

?>