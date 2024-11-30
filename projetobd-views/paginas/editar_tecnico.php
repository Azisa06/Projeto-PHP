<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/tecnicos.php';

    $id = $_GET['id'];
    if (!$id) { //se o usuário n informar o id, ele será redirecionado à página de serviços
        header('Location: tecnicos.php');
        exit();
    }

    $tecnico = buscarTecnicoPorId($id);
    if (!$tecnico) { //se o usuário n informar o serviço, ele será redirecionado à página de equipamentos
        header('Location: tecnicos.php');
        exit();
    }

    $erro = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            if(empty($nome) || empty($email)){
                $erro = "Preencha os campos obrigatórios!";
            } else{
                if (alterarTecnico($nome, $email, $id)){
                    header('Location: tecnicos.php');
                    exit();
                } else{
                    $erro = "Erro ao alterar o tecnico!";
                }
            }
        }catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Editar Técnico</h2> <!--to em dúvida se esse editar tem q ser dessa forma-->

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" >
        </div>
        <button type="submit" class="btn btn-primary">Atualizar dados</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>