<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Full Stack MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body text-center p-5">
                        <h1 class="display-4 text-primary mb-3">Dashboard</h1>
                        <p class="lead">
                            Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! 
                            You are successfully logged in via PHP Sessions.
                        </p>
                        
                        <hr class="my-4" />
                        
                        <p class="text-muted mb-4">
                            This is a protected route. Only authenticated users can see this page.
                        </p>
                        
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="index.php?action=users" class="btn btn-outline-primary px-4 gap-3">
                                View All Users
                            </a>
                            
                            <a href="index.php?action=logout" class="btn btn-danger px-4">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>