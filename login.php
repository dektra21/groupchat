<?php
$page = isset($_GET['page']) ? $_GET['page'] : NULL;

   if (isset($_SESSION['login'])){
    header("Location:index.php?page=dashboard");
    exit;
}
    $errorLogin = isset($_GET['error']) ? $_GET['error'] : NULL;
?>
<!DOCTYPE html>
<html lang="en" class="uk-background-primary">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/uikit.min.css" />
    <script src="assets/js/uikit.min.js"></script>
    <script src="assets/js/uikit-icons.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="icon" href="skensa.png">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>SKENSA-GroupChat - Log In</title>
    <style>
        body {
            overflow: hidden;
        }

        img {
            -webkit-filter: brightness(35%);
        }

        .uk-card-default {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 20px;
            transition: 1s;
        }

        .padding {
            padding-left: 50px;
            padding-right: 50px;
            padding-bottom: 50px;
            padding-top: 30px;
        }

        .uk-input {
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            border-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div class="uk-card uk-card-default uk-position-center padding  uk-animation-fade">
        <h1 align="center" style="font-family:'Poppins', sans-serif; color:white;"> <b>Log In</b> </h1>
        <?php if ($errorLogin == '0') : ?>
        <p style="color: red; font-style: italic;">Incorrect Username or Password!</p>
        <?php endif; ?>
        <form action="include/action/User-Login.php" method="post">
            <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon" style="margin-left: 15px;" uk-icon="user"></span>
                    <input class="uk-input" type="username" name="username" id="username" placeholder=" Enter Username...">
                </div>

                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon" style="margin-left: 15px;" uk-icon="lock"></span>
                    <input class="uk-input" type="password" name="password" id="password"
                        placeholder="Enter Password...">
                </div>
            </div>
            <div class="uk-margin">
                <button type="submit" style="border-radius:5px;" class="uk-button uk-button-primary uk-width-1-1"
                    style="font-family:'Poppins', sans-serif;"> <b>Login</b> </button>
            </div>
        </form>
        <div class="uk-text-small  uk-text-center">
            Not registered? <a href="register.php" class="uk-text-muted">Create an account</a>
        </div>
    </div>

</body>

</html>