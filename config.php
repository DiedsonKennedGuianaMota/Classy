<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $conexao = mysqli_connect("localhost", "root", "", "FormularioAlunos");
    if(!$conexao){
        echo"Não conectado";
    }else{
        echo"Conectado ao Banco";
    }
    $matricula = $_POST['matricula'];
    $matricula = mysqli_real_escape_string($conexao, $matricula);
    $sql = "SELECT matricula FROM FormularioAlunos.Alunos WHERE matricula='$matricula'";
    $retorno = mysqli_querry($conexao,$sql);

    if(mysqli_num_rows($retorno)>0){
        echo"Usuário já cadastrado";
    }
    else{
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $matricula = $_POST['matricula'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];

        $sql = "INSERT INTO FormularioALunos.Alunos(nome,email,matricula,telefone,senha) values('$nome', '$email', '$matricula', '$telefone', '$senha')";
        $resultado = mysqli_querry($conexao,$sql);
        echo">>Usuário Cadastrado";
    }
    ?>
</body>
</html>