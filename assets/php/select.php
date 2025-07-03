<?php
include "conector.php";

/* Para inserir os dados do banco de dados na tabela */
$base = "";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT con_id, con_nome, con_telefone, con_email, con_nascimento, con_observacoes FROM tb_contatos WHERE con_id = :id";
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    $dados = $cmd->fetch();
     
    $base .= '
    <form action="" method="POST" id="form" class="form-group">
        <input type="hidden" id="id" name="id" value="">
            <div class="col first-col">
                <input type="hidden" class="form-control" name="id" id="id" value="'. $dados['con_id'] .'">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="'. $dados['con_nome'] .'">
            </div>
            <div class="col">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="'. $dados['con_telefone'] .'">
            </div>
        
            <div class="row pt-3">
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="exemplo@email.com" value="'. $dados['con_email'] .'">
            </div>
            <div class="col">
                <label for="nascimento" class="form-label">Nascimento</label>
               <input type="date" class="form-control" name="nascimento" id="nascimento" value="'. $dados['con_nascimento'] .'">
            </div>
            </div>

            <div class="row pt-4">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea class="form-control" id="observacoes" name="observacoes" rows="3">' . $dados['con_observacoes'] .'</textarea>
            </div>

            <div class="row pt-4">
            <div class="col">
                <input id="update" class="btn btn-success col-12 botao-envia update" type="submit" value="Salvar">
            </div>

            <div class="col">
                <input class="btn btn-danger col-12 cancelar" value="Cancelar">
            </div>
        </div>
    </form>
    ';
} elseif(isset($_POST['del'])) {
    $id = $_POST['del'];
    $sql = "DELETE FROM tb_contatos WHERE con_id = :id";
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();

    if($cmd->rowCount() >= 1) {
        $base .= "<p class='alert alert-success text-center'>Contato excluido com sucesso!</p>";

    } else {
        $base .= "<p class='alert alert-danger text-center'>Falha ao excluir contato.</p>";
    }
} else {
    $sql = "SELECT con_id, con_nome, con_telefone, con_email, con_nascimento, con_observacoes FROM tb_contatos";
    $cmd = $pdo->prepare($sql);
    $cmd->execute();
    $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);   

    foreach($dados as $dados_ct) {
        $base .= '
        <tr>
            <td scope="col">'. $dados_ct['con_nome'] .'</td>
            <td scope="col">'. $dados_ct['con_telefone'] .'</td>
            <td scope="col">'. $dados_ct['con_email'] .'</td>
            <td scope="col">'. $dados_ct['con_nascimento'] .'</td>
            <td scope="col">'. $dados_ct['con_observacoes'] .'</td>
            <td><input type="submit" name="editar" id="'. $dados_ct['con_id'] .'" value="Editar" class="btn btn-primary editar"></td>
            <td><input type="submit" name="excluir" id="'. $dados_ct['con_id'] .'" value="Excluir" class="btn btn-danger excluir"></td>
        </tr>
    ';
    }
    
}  

echo $base;

?>