<?php
session_start();
$mensagem = "";

if (!isset($_SESSION['token'])) {
  $mensagem = "Nenhum token foi gerado ainda.";
} else {
  // Se o formulário for enviado
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tokenDigitado = $_POST['token'] ?? '';

    if (time() > $_SESSION['expira']) {
      $mensagem = "<span class='error'>Token expirado! Gere um novo.</span>";
      unset($_SESSION['token']);
    } elseif ($tokenDigitado == $_SESSION['token']) {
      $mensagem = "<span class='success'>✅ Token correto! Redirecionando...</span>";
      // Exemplo: após 2 segundos, redireciona
      echo "<meta http-equiv='refresh' content='2;url=redefinir_senha.php'>";
    } else {
      $mensagem = "<span class='error'>❌ Token incorreto!</span>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Verificar Token</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
  <h2>Verificar Token</h2>

  <?php if (isset($_SESSION['telefone'])): ?>
    <p>Um token foi enviado para: <strong><?php echo $_SESSION['telefone']; ?></strong></p>
  <?php endif; ?>

  <?php if ($mensagem): ?>
    <p><?php echo $mensagem; ?></p>
  <?php endif; ?>

  <?php if (isset($_SESSION['token'])): ?>
    <form method="POST">
      <input type="text" name="token" placeholder="Digite o token" required maxlength="6" pattern="\d{6}">
      <button type="submit" class="btn-green">Confirmar</button>
    </form>
    <p class="token-box">
      (Token atual: <strong><?php echo $_SESSION['token']; ?></strong>)
    </p>
  <?php endif; ?>

  <a class="link" href="gerar_token.php">🔁 Gerar novo token</a>
</div>
</body>
</html>
