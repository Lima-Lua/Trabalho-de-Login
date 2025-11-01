<?php
session_start();

// Gera token aleatório de 6 dígitos
$token = rand(100000, 999999);

// Guarda na sessão (como se fosse “enviado” via WhatsApp)
$_SESSION['token'] = $token;
$_SESSION['expira'] = time() + 180; // 3 minutos de validade

// Simulação de número (poderia vir de um formulário anterior)
$telefone = "+55 81 99999-0000";
$_SESSION['telefone'] = $telefone;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Gerar Token</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
  <h2>Token Gerado</h2>
  <p>Token foi enviado para: <strong><?php echo $telefone; ?></strong></p>
  <p><em>(Simulação: este seria o token recebido no WhatsApp)</em></p>

  <div class="token-box">
    🔐 <strong><?php echo $token; ?></strong>
  </div>

  <a class="btn-green" href="verificar_token.php">Verificar Token</a>
</div>
</body>
</html>
