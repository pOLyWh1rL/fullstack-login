<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Welcome, <?php echo $_SESSION['user']; ?> 👋</h2>
  <a href="users.php" class="btn btn-info">View Users</a>
  <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

</body>
</html>
