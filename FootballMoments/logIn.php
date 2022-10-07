<?php
require_once( "Lib/lib.php" );
require_once( "defaultLang.php" );
?>

<!DOCTYPE html>
<html lang=<?php echo $_SESSION["language"]; ?>>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Football Moments / <?php echo $_SESSION["lang"]["logIn"]; ?></title>
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/login.css">
        <script type="text/javascript" src="scripts/forms.js"></script>
    </head>
    <body>
        <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div class="container">
                <div class="card login-card">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="assets/images/login.png" alt="login" class="login-card-img">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="brand-wrapper">
                                    <img src="assets/images/logo.png" id="logo" >
                                </div>
                                <h1>FOOTBALL MOMENTS</h1>
                                <p class="login-card-description"><?php echo $_SESSION["lang"]["sign"]; ?></p>
                                <form 
                                    action="processLogin.php"
                                    name="FormLogin"
                                    method="post" 
                                    onsumbit="FormLoginValidator">
                                    <div class="form-group">
                                        <label for="username" class="sr-only"><?php echo $_SESSION["lang"]["username"]; ?></label>
                                        <input type="username" name="username" id="username" class="form-control" placeholder="Username" maxlength="5" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password" class="sr-only"><?php echo $_SESSION["lang"]["password"]; ?></label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="***********" maxlength="8" required>
                                    </div>
                                    <input type="submit" name="login" id="login" class="btn btn-block login-btn mb-4" type="button" value="<?php echo $_SESSION["lang"]["logIn"]; ?>">
                                </form>
                                <p class="login-card-footer-text"><?php echo $_SESSION["lang"]["missingAccount"] . ' '; ?><a href="registration.php" class="text-reset"><?php echo $_SESSION["lang"]["registerHere"]; ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </body>
</html>
