<?php
session_start();
include_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $nivel_acesso = $_POST["nivel_acesso"];

  $verifica_email = "SELECT * FROM usuarios WHERE email = '$email'";
  $result_validate = mysqli_query($conexao, $verifica_email);

  if (mysqli_num_rows($result_validate) > 0) {
    echo "<p class='temEmail' >EMAIL JA CADASTRADO!</p>";
  } else {
    $query = "INSERT INTO usuarios (nome, email, password, nivel_acesso) VALUES ('$nome', '$email', '$password', '$nivel_acesso')";
    $result = mysqli_query($conexao, $query);

    if ($result) {
      header("Location: dash-adm.php");
      exit();
    } else {
      echo "<p>Erro ao atualizar os dados!</p>";
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="add.css"/>
  <title>Cadastro de usuários</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>

<body>
  <div class="form-container">
    <div class="form-header">
      <h2>Adicionar usuário</h2>
    </div>
    <form class="product-form" action="add.php" method="post">
      <div class="form-group">
        <input type="text" id="name" name="nome" class="input-field" placeholder="Nome" required>
      </div>
      <div class="form-group">
        <input type="text" id="email" name="email" class="input-field" placeholder="email" required>
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" class="input-field" step="0.01" placeholder="password" required>
      </div>
      <div class="form-group">
        <select name="nivel_acesso" id="role" required>
          <option value="2">Cliente</option>
          <option value="1">Admin</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit" class="submit-button">Adicionar</button>
      </div>
    </form>
  </div>
</body>

</html>