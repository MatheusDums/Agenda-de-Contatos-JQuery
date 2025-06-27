<?php
/* https://www.youtube.com/watch?v=cAcbp1BXTX0 */
/* conectando ao banco de dados (igual ao conector.php)*/
$servidor = "localhost";
$banco = "agenda-jquery";
$usuario = "root";
$senha = "";

$pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
/* teste conexão */
$existe = $pdo->query("SELECT * FROM tb_contatos WHERE con_nome = 'Matheus Dums'")->fetch();
echo $existe['con_nome'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
    <title>Agenda de Contatos - JQuery</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center p-3">Agenda de contatos Bud - JQuery</h1>
        <div class="row">
            <div class="formulario">
                <form action="" method="POST" id="form" class="form-group">
                <input type="hidden" id="id" value="">

                <div class="col">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome">
                </div>
                <div class="col">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" placeholder="Telefone">
                </div>
            

                <div class="row pt-3">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="exemplo@email.com">
                    </div>
                    <div class="col">
                        <label for="nascimento" class="form-label">Nascimento</label>
                        <input type="date" class="form-control" id="nascimento">
                    </div>
                </div>

                <div class="row pt-4">
                    <label for="observacoes" class="form-label">Observações</label>
                    <textarea class="form-control" id="observacoes" rows="3"></textarea>
                </div>

                <div class="row pt-4">
                    <div class="col">
                    <button id="salvarCadastro" class="btn btn-success col-12">Salvar</button>
                </div>
                <div class="col">
                    <a class="btn btn-danger col-12" href="#">Cancelar</a>
                </div>
                </div>
                
            </form>
        </div>

        <h2 class="text-center p-3">Agenda de Contatos</h2>

        <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Email</th>
                <th scope="col">Nascimento</th>
                <th scope="col">Observações</th>
                <th scope="col" colspan="2">Ação</th>
            </tr>
        </thead>

        <tbody class="text-center table_body">
            
        </tbody>

        <div id="messages"></div>
        </table>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        $('#salvarCadastro').on('click',function() {
            alert('ok')
            $.ajax({
                url: 'adicionar.php',
                type: 'POST',
                data:{
                    nome: $('#nome').val(),
                    telefone: $('telefone').val(),
                    email: $('#email').val(),
                    nascimento: $('#nascimento').val(),
                    observacoes: $('#observacoes').val()
                },
                sucess: function(data){
                    $('.table_body').html(data)
                },
                error: function(data) {
                    $('.table_body').html('Não conseguimos encontrar nenhum dado')
                }
                
            })
        })
    })


    </script>
</body>
</html>  