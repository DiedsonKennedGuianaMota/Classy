<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
<main>
    <?php
    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "cadastro");
    
    // Verifica conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }
    
    // Pega os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $matricula = $_POST['matricula'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // criptografa a senha
    
    // Prepara e executa o INSERT
    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_tmp  = $_FILES['imagem']['tmp_name'];
    $caminho_destino = "imagens/" . basename($imagem_nome);


    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $imagem_nome = basename($_FILES['imagem']['name']);
    $imagem_temp = $_FILES['imagem']['tmp_name'];
    $caminho_destino = "imagens/" . $imagem_nome;
    }
    $sql = "INSERT INTO aluno (nome, email, matricula, telefone, senha, imagem)
        VALUES ('$nome', '$email', '$matricula', '$telefone', '$senha', '$imagem_nome')";

        
    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['nome']  = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['imagem'] = $imagem_nome;
        header("Location: home.php");
        exit(); 
    } else {
        echo "Erro: " . $conn->error;
    }
    
    $conn->close(); 
    
?>
</main>
</body>
</html>
