<!DOCTYPE html>
<html>
<head>
    <title>ChipTech | Login</title>
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/bootstrap.min.css">
    <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
    <style>
        body {  
            background-image: url('../assets/images/Login-Signup-Images/LoginBg.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>

    
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card bg-dark bg-opacity-50 text-light px-5" style="max-width: 400px; border-radius: 1rem;">
            <div class="card-body">
                <div class="text-center">
                    <img src="../assets/images/logo/logo.png" class="img-fluid" alt="Chiptech Logo" style="width: 100px;">
                    <h1 class="mt-3">E-Commerce</h1>
                    <p>Remember everything is important.</p>
                </div>
                <div class="mt-4 d-grid gap-2">
                    <button class="btn btn-primary btn-block" style="border-radius: 1rem;">
                        <img src="../assets/images/Login-Signup-Images/GoogleIcon.png" alt="Google Icon" width="20px" class="me-2"> Sign in with Google
                    </button>
                </div>
                <form>
                    <div class="form-group mt-4">
                        <label for="inputEmail">Email address</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                    <div class="form-group form-check mt-2">
                        <input type="checkbox" class="form-check-input" id="rememberCheck">
                        <label class="form-check-label" for="rememberCheck">Remember me</label>
                    </div>
                    <div class="text-center mt-3">
                        <a href="Home.html" class="btn btn-primary">Sign in</a>
                    </div>
                    <div class="text-center mt-5">
                        <p>Don't have an account? <a href="signup.php">Create account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
      
      
      
      
    
</body>
</html>