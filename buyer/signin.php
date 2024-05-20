<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- fontawesome -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

    <!-- bootstrap -->
    <link href="../assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- custom -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<section class="vh-100 d-flex align-items-center justify-content-center" style="background-color: #fafafa;">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 text-center">
                    <img src="../assets/images/logo/logo.png" class="img-fluid" alt="Sample image" height="300px" width="600px">
                </div>
                
                <div class="col-md-6">
                    <div class="card text-dark rounded-0 mb-4" >
                        <div class="card-body p-md-2 my-2">
                            <p class="text-center h1 fw-bold mb-4">Log in</p>

                            <form action="../operations/login.php" method="post" class="mx-1 mx-md-4">

                                <div class="mb-4">
                                    <i class="fas fa-envelope fa-lg fa-fw"></i>
                                    <label class="form-label fs-6" for="form3Example3c"><i class="bi bi-envelope-at-fill"></i> Your Email</label>
                                    <input type="email" id="form3Example3c" class="form-control rounded-0" name="email" autocomplete="off" placeholder="Enter your username" style="border-radius:5px ;" />
                                </div>

                                <div class="mb-4">
                                    <i class="fas fa-lock fa-lg fa-fw"></i>
                                    <label class="form-label fs-6" for=""><i class="bi bi-file-lock2-fill"></i> Password</label>
                                    <input type="password" id="" class="form-control rounded-0" name="password" autocomplete="off" placeholder="Enter your password" style="border-radius:5px ;" />
                                </div>

                                <div class="d-grid gap-2 mb-3">
                                    <input type="submit" name="login" class="btn btn-danger text-light rounded-0" value="Login"/>
                                </div>

                            </form>

                            <p class="text-center">Don't have an account? <a href="signup.php" class="text-danger" style="font-weight:600; text-decoration:none;">Create Account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</body>
<!-- bootstrap -->
<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
</html>