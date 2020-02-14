<?php
  
    require '../../vendor/autoload.php';
    require '../Connection.php';
    require '../class/UsersClass.php';
    
    $classUsers = new UsersClass($pdo);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $nickname = $_POST['nickname'];
    $cover = $_FILES['cover'];
 
    if ($password != $password2) {
        //kalo password yang pertama ga sama dengan password yang kedua bakal ke sini
        header("Location:../../register.php?page=register&error=1");
    }else{
        $register = $classUsers->register($username, $password,  $password2, $nickname, $cover);

        if ($register == 'Success') {
            //kalo datanya berhasil masuk ke database bakal ke sini
            header("Location:../../login.php");
        }
        elseif ($register == 'Exist') {
            //kalo usernamenya sama bakal ke sini
            header("Location:../../register.php?page=register&error=2");
        }
        else {
            //kalo datanya gagal masuk bakal ke sini
            header("Location:../../register.php?page=register&error=0");
        }
    }

    
?>