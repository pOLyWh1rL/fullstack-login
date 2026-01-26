<?php
session_start();
require "../config/db.php";

$result = $conn->query("SELECT id, username, created_at FROM users");
?>
<!DOCTYPE html>
<html>
<head>
<title>User List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h3>Registered Users</h3>

  <table class="table table-bordered">
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Created</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['username'] ?></td>
      <td><?= $row['created_at'] ?></td>
    </tr>
    <?php } ?>
  </table>
</div>

</body>
</html>
