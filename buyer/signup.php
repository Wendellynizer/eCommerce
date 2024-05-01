<!DOCTYPE html>
<html>

<head>
    <title>ChipTech | Sign up</title>
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url('../assets/images/login-Signup-Images/LoginBg.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>


    <div class="container d-flex align-items-center justify-content-center " style="height: 120vh;">
        <div class="card bg-dark bg-opacity-50 text-light px-5 " style="max-width: 400px; border-radius: 1rem;">
            <div class="card-body">
                <div class="text-center">
                    <img src="../assets/images/logo/Logo.png" class="img-fluid" alt="Chiptech Logo" style="width: 100px;">
                    <h1 class="mt-3">Eccomerce</h1>
                </div>
                <hr>
                <div class="text-center fs-4">
                    <p>Sign up</p>
                </div>

                <form action="../operations/register.php" method="POST">
                    <div class="form-group ">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                    </div>


                    <div class="text-center mt-3 w-100">
                        <button type="submit" href="#" class="btn btn-primary w-100">Continue</<button>
                    </div>

                    <div class="text-center mt-5">
                        <p>Already have an account? <a href="login.php">Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-secondary" role="alert">
                        Account created successfuly!
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="Login.html" class="btn btn-primary" style="background-color: black;">Okay</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>