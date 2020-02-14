<?php
    class UsersClass {
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }
        public function register($username, $password,  $password2, $nickname, $cover) {
            //ngecek username nya dlu, udah ada apa belom
            
            $checkRegister = $this->pdo->query("SELECT username FROM users WHERE username = '$username'");
            
        
            if ($checkRegister->rowCount() > 0){
                return 'Exist';
            }
            else{ 
                //enkripsiin password
                $password = password_hash($password, PASSWORD_DEFAULT);
             
                $foldercover = '../../assets/cover/';
                // $extension = end($array);
                $uploadcover = move_uploaded_file($cover['tmp_name'], $foldercover.$cover['name']);
                $date =  date('Y-m-d H:i:s');
                $status = '1';

                //nambahin user baru ke database
                $result  = $this->pdo->prepare("INSERT INTO users(
                    username, 
                    password, 
                    password2, 
                    nickname, 
                    cover,
                    created,
                    status)
                VALUES (:username, :password, :password2, :nickname, :cover, :created, :status)"); 

                $result->bindParam(':username', $username);
                $result->bindParam(':password', $password);
                $result->bindParam(':password2', $password2);
                $result->bindParam(':nickname', $nickname);
                $result->bindParam(':cover', $cover['name']);
                $result->bindParam(':status', $status);
                $result->bindParam(':created', $date);

                if($result->execute()) {
                    return 'Success';
                }
                else {
                    return 'Failed';
                }
            }
         
        } 
        public function login($username, $password) {
            $checkUser = $this->pdo->query("SELECT * FROM users WHERE username = '$username'");
            if ($checkUser->rowCount() > 0) {
                //cek password euy
                $row = $checkUser->fetch(PDO::FETCH_OBJ);

                if (password_verify($password, $row->password)){
                    $_SESSION["id"]    = $row->id;
                    $_SESSION["login"] = true;

                    return true;
                }
            }

            return false;
        }
        public function list($id)
        {
            $query = $this->pdo->query("SELECT * FROM users WHERE id <> '$id'");
            if($query->rowCount() > 0) {
                while($rows = $query->fetch(PDO::FETCH_OBJ))
                    $data[] = $rows;
                return $data;
            }

            return false;
        }
        public function loginUser($id){
            $checkUser = $this->pdo->query("SELECT * FROM users WHERE id = '$id'");
            if ($checkUser->rowCount() > 0) {
                $row = $checkUser->fetch(PDO::FETCH_OBJ);
                return $row;
            }
            return false;
        }
        public function userid($id)
        {
            $query = $this->pdo->query("SELECT * FROM users WHERE id = '$id' LIMIT 1");
            if($query->rowCount() > 0) {
              $rows = $query->fetch(PDO::FETCH_OBJ);
                return $rows;
            }

            return false;
        }
    }
    ?>