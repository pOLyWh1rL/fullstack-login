<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card mx-auto p-4" style="max-width:400px;">
    <h3 class="text-center">Register</h3>

    <form action="../actions/auth.php" method="POST">
      <input type="hidden" name="action" value="register">

      <input class="form-control mb-3" name="username" placeholder="Username" required>
      <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

      <button class="btn btn-primary w-100">Create Account</button>
    </form>
  </div>
</div>

</body>
</html>
