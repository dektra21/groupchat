<?php
$page = isset($_GET['page']) ? $_GET['page'] : NULL;
$error = isset($_GET['error']) ? $_GET['error'] : NULL;
?>

<!DOCTYPE html>
<html lang="en" class="uk-background-primary">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/uikit.min.css" />
    <link rel="icon" href="skensa.png">
    <script src="assets/js/uikit.min.js"></script>
    <script src="assets/js/uikit-icons.min.js"></script>
    <title>SKENSA-GroupChat - Register</title>
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
            padding-top: 20px;
        }

        .uk-input {
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            border-color: rgba(0, 0, 0, 0.5);
        }

        .padding2 {
            padding-right: 100px;
        }

        .uk-margin {
            margin: 1px;
        }
    </style>
</head>

<body>
    <div>


        <div class="uk-card uk-card-default uk-position-center padding  uk-animation-fade">
            <h1 align="center" style="font-family:'Poppins', sans-serif; color:white;"> <b>Register</b> </h1>

            <form action="include/action/users-register.php" method="post" enctype="multipart/form-data">

                <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon" style="margin-left: 15px;" uk-icon="user"></span>
                        <input class="uk-input" type="text" name="username" id="username"
                            placeholder="Enter Username...">
                    </div>

                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon" style="margin-left: 15px;" uk-icon="lock"></span>
                        <input class="uk-input" type="password" name="password" id="password"
                            placeholder="Enter Password...">
                    </div>
                </div>

                <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon" style="margin-left: 15px;" uk-icon="lock"></span>
                        <input class="uk-input" type="password" name="password2" id="password2"
                            placeholder="Re-Enter Password...">
                    </div>

                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon" style="margin-left: 15px;" uk-icon="user"></span>
                        <input class="uk-input" type="text" name="nickname" id="nickname"
                            placeholder="Enter Your Nickname...">
                    </div>
                </div>


                <div class="uk-margin">
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon " uk-icon="image"></span>
                        <input class="uk-input" type="file" name="cover" id="cover" placeholder="Select Cover" required>
                    </div>
                </div>

                <div class="uk-margin">
                    <button type="submit" style="border-radius:5px;" class="uk-button uk-button-primary uk-width-1-1"
                        style="font-family:'Poppins', sans-serif;"> <b>Register</b> </button>
                </div>


            </form>
        </div>

    </div>

    <?php
        if($page == 'register') :
            if($error == '0') : 
                //kalo data gagal masuk
                echo "
                    <script>
                        alert('Data Failed to Enter');
                    </script>
                ";
            elseif($error == '2') :
                //kalo email nya udah ada
                echo "
                    <script>
                        alert('Username is already Exist');
                    </script>
                 ";
            else :
                //kalo password yg pertama beda sama yg kedua
                echo "
                    <script>
                        alert('Password is Different');
                    </script>
                ";
            endif;
        endif;
    ?>

</body>

</html>