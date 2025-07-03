<?php
include "conector.php";
$erro = array();
$saida = "";

if(isset($_POST['id'])) { /* caso reconheça que tem um id, atualiza, se não segue pro código de baixo e cria um contato no db */
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $nascimento = addslashes($_POST['nascimento']);
    $observacoes = addslashes($_POST['observacoes']);
    $id = $_POST['id'];

    $sql = "UPDATE tb_contatos SET con_nome = :nm,  con_telefone = :tf, con_email = :em, con_nascimento = :ns, con_observacoes = :ob 
        WHERE con_id = :id";
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":nm", $nome);
    $cmd->bindValue(":tf", $telefone);
    $cmd->bindValue(":em", $email);
    $cmd->bindValue(":ns", $nascimento);
    $cmd->bindValue(":ob", $observacoes);
    $cmd->bindValue(":id", $id);
    $cmd->execute();

    if($cmd->rowCount() >= 1) {
        $saida .= "<p class='alert alert-success text-center'><strong>$nome</strong> Atualizado com sucesso!</p>";

    } else {
        $saida .= "<p class='alert alert-danger text-center'>Falha ao atualizar contato.</p>";
    }


} else { /* cadastra no banco de dados */
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $nascimento = addslashes($_POST['nascimento']);
    $observacoes = addslashes($_POST['observacoes']);

    if(empty($nome)) { /* verifica se um campo tá vazio, parece muito com o required do html, mas aqui ele apresenta o erro na tela */
        $erro['e'] = "Digite o seu nome";
    }elseif(empty($telefone)) {
        $erro['e'] = "Digite o seu telefone";
    }elseif(empty($email)) {
        $erro['e'] = "Digite o seu email";
    }elseif(empty($nascimento)) {
        $erro['e'] = "Digite a sua data de nascimento";
    }elseif(empty($observacoes)) {
        $erro['e'] = "Digite as suas observacoes";
    } else {
        $sql = "INSERT INTO tb_contatos (con_nome, con_telefone, con_email, con_nascimento, con_observacoes) 
            VALUE(:nm, :tf, :em, :ns, :ob)";
        $cmd = $pdo->prepare($sql);
        $cmd->bindValue(":nm", $nome);
        $cmd->bindValue(":tf", $telefone);
        $cmd->bindValue(":em", $email);
        $cmd->bindValue(":ns", $nascimento);
        $cmd->bindValue(":ob", $observacoes);
        $cmd->execute();
        if($cmd->rowCount() >= 1) {
            $saida .= "<p class='alert alert-success text-center'><strong>$nome</strong> cadastrado com sucesso!</p>";

        } else {
            $saida .= "<p class='alert alert-danger text-center'>Falha no cadastro.</p>";
        }
    }
}

if(isset($erro['e'])) { /* caso esteja um campo sem preencher, irá aparecer o erro */
    $saida .= "<p class='alert alert-danger text-center'>" . $erro['e'] . "</p>";
} 

echo $saida; /* para enviar ao jquery */
?>