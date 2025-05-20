<?php
// Inicia a sessão se precisar usar sessões
session_start();

// Conexão com o banco
$mysqli = new mysqli("localhost", "root", "", "cadastro");

if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

// Recebe o email do formulário
$email = $_POST['email'];

// Consulta para verificar se o e-mail existe
$stmt = $mysqli->prepare("SELECT id FROM aluno WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    $_SESSION['usuario_id'] = $usuario['id'];
    echo "Email encontrado! Login permitido.";
    header("Location: home.php");
    exit();
} else {
    echo "Email não cadastrado.";
    header("Location: index.html");
    exit();
}

$stmt->close();
$mysqli->close();
?>