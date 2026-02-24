<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Users - Full Stack MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        
        <?php if(isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
            <div class="alert alert-success">User successfully updated!</div>
        <?php endif; ?>
        <?php if(isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
            <div class="alert alert-success">User successfully deleted!</div>
        <?php endif; ?>
        <?php if(isset($_GET['error']) && $_GET['error'] === 'cannot_delete_self'): ?>
            <div class="alert alert-danger">Action blocked: You cannot delete your own admin account.</div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Registered Users (Admin View)</h3>
                <a href="index.php?action=dashboard" class="btn btn-light btn-sm">Back to Dashboard</a>
            </div>
            
            <div class="card-body">
                <?php if (empty($users)): ?>
                    <div class="alert alert-info">No users found in the database.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th> </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td>
                                            <?php if($user['role'] === 'admin'): ?>
                                                <span class="badge bg-danger">Admin</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">User</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="index.php?action=edit&id=<?php echo $user['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="index.php?action=delete&id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>