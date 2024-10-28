<?php
// Conexão com o banco de dados
$servername = "localhost"; // Altere se necessário
$username = "root"; // Altere se necessário
$password = ""; // Altere se necessário
$dbname = "teste"; // Altere para o nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

    // Insere o usuário no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        header("Location: index.html");
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>      
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "work sans", sans-serif;
}

body {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url('./img/bg-outrascoisas.jpg');
    background-size: cover;
    background-position: center;
}

body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2); /* Cor preta com 50% de opacidade */
    z-index: 1; /* Certifica-se que o overlay fique atrás do conteúdo */
}

.container {
    position: relative;
    z-index: 2; /* Garante que o conteúdo fique acima do overlay */
}

.container{
    width: 380px;
    height: 500px;
    background-color: #69a0ece8;
    border: 2px solid rgba(2, 221, 250, 0.2);
    border-radius: 30px;
    color: white;
    padding: 20px 10px;
    box-shadow: 0 0 10px rba(255, 255, 255, .2);
    backdrop-filter: blur(50px);
}

.container h1{
    font-size: 45px;
    text-align: center;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
}

.input-box {
    position: relative;
    width: 100%;
    height: 50px;
    margin: 20px 0;
}

input{
    width: 100%;
    height: 100%;
    background-color: transparent;
    border: 2px solid;
    border-radius: 40px;
    outline: none;
    font-size: 16px;
    color: #fff;
    padding: 20px 45px 20px 20px;
    margin-top: 1rem;
}

.input-box input::placeholder{
    color: #fff;
}

.input-box i{
    position: absolute;
    right: 20px;
    top: 80%;
    transform: translateY(-50%);
    font-size: 20px;

}

.remember-forgot{
    display: flex;
    justify-content: space-between;
    margin: -15px 0 15px;
}

.remember-forgot{
    margin-left: 10px;
    margin-top: 3rem;
}

.remember-forgot label{
    accent-color: #fff;
    margin-right: 5px;
}

.remember-forgot a{
   text-decoration: none;
   color: #fff;
   margin-right: 15px;
}

.remember-forgot a:hover{
    text-decoration: underline;
}

.login{
    width: 100%;
    height: 50px;
    background-color: #fff;
    border: none;
    border-radius: 40px;
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
    margin-top: 20px;
}

.login:hover {
    background-color: transparent;
    border: 2px solid rgba(255, 255, 255, 0.4);
    color: #fff;
}
.register-link{
    font-size: 14px;
    text-align: center;
    margin: 20px 0 15px;
}

.register-link a{
    text-decoration: none;
    color: #fff;
    font-weight: 500;
}

.register-link a:hover{
    text-decoration: underline;
}
    </style>
</head>
<body>
    <div class="container">
    <h1>Cadastro de Usuário</h1>
    <form action="" method="post">
        <label for="nome">Nome:</label>
        <input class="input-box" type="text" name="nome" required><br>

        <label for="email">Email:</label>
        <input class="inpput-box" type="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input class="input-box" type="password" name="senha" required><br>

        <input class="inpput-box" type="submit" value="Cadastrar">
    </form>
    </div>
    

</body>
</html>