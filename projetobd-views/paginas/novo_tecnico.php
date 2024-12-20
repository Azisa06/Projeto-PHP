<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/tecnicos.php';

    $erro = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            if(empty($nome) || empty($email) || empty($senha)){
                $erro = "Informe os valores obrigatórios!";
            } else{
                if (novoTecnico($nome, $email, $senha)){
                    header('Location: tecnicos.php');
                    exit();
                } else{
                    $erro = 'Erro ao inserir produto!';
                }
            }
        }catch (Exception $e){
            $erro = "Erro: " .$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Cadastrar Novo Técnico</h2>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar técnico</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>