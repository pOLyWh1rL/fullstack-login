<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card mx-auto p-4" style="max-width:400px;">
    <h3 class="text-center">Login</h3>

    <form action="../actions/auth.php" method="POST">
      <input type="hidden" name="action" value="login">

      <input class="form-control mb-3" name="username" required>
      <input class="form-control mb-3" type="password" name="password" required>

      <button class="btn btn-success w-100">Login</button>
    </form>
  </div>
</div>

</body>
</html>
