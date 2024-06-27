<?php
session_start();
include_once "connect.php";

if (!empty($_GET["id"])) {
  $id = $_GET["id"];

  $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $nome = $row["nome"];
      $email = $row["email"];
      $password = $row["password"];
      $nivel_acesso = $row["nivel_acesso"];
    }
  } else {
    header("Location: dash-adm.php");
    exit();
  }
} else {
  header("Location: dash-adm.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css"/>

  <title>Editar Produto</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>

<body>
  <div class="form-container">
    <div class="form-header">
      <h2>Editar</h2>
    </div>
    <form class="users-form" action="saveEdit.php?id=<?php echo $id; ?>" method="post">
      <div class="form-group">
        <input type="text" id="name" name="nome" class="input-field" placeholder="Nome" required value="<?php echo $nome; ?>">
      </div>
      <div class="form-group">
        <input type="email" id="email" name="email" class="input-field" placeholder="email" required value="<?php echo $email; ?>">
      </div>
      <div class="form-group">
        <input type="text" id="password" name="password" class="input-field" step="0.01" placeholder="password" required value="<?php echo $password; ?>">
      </div>
      <div class="form-group">
        <select name="nivel_acesso" id="role" required>
          <option value="2" <?php echo $nivel_acesso == 2 ? "selected" : ""; ?>>Cliente</option>
          <option value="1" <?php echo $nivel_acesso == 1 ? "selected" : ""; ?>>Admin</option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="submit-button">Salvar</button>
      </div>
    </form>
  </div>
</body>

</html>