<?php 
class User {
    protected $pdo;

    function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function checkInput($var){
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stristr($var);
        return $var;
    }
    public function login($email, $password){
        $q= "SELECT * FROM users WHERE email= :email AND password= :password";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute([':email' => $email, ':password' => md5($password)]);

        $user= $stmt->fetch(PDO::FETCH_OBJ);
        $count= $stmt->rowCount();

        if($count > 0){
            $_SESSION['user_id']= $user->user_id;
            header('Location: '.$user->lever.'');
        }else{
            return false;
        }
    }

    public function register($email,$screenName,$password){
        $q= "INSERT INTO user (email,password,screenName,profileImage,profileCover) VALUE(:email,:password,:screenName,profileImage,profileCover)";
        $stmt= $this->pdo->prepare($q);
        $stmt->execute([bindstaff]);

        $user_id= $this->pdo->lastInsertId();
        $_SESSION['user_id']= $user_id;
    }

    public function userData($user_id){
        $q= "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($table, $fields = array()){
        $colums = implode(',', array_keys($fields));
        $values = ':' .implode(', :', array_keys($fields));
        $q = "INSERT INTO {$table} ({$colums}) VALUES({$values})";
        if($stmt= $this->pdo->prepare($q)){
            foreach ($fields as $key => $data) {
                $stmt->bindValue(':' .$key, $data);
            }
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
    }

    public function update($table, $user_id, $fields=array()){
        $colums ='';
        $i  = 1;

        foreach ($fields as $name => $value) {
            $colums .= "{$name} = :{$name}";
            if($i < count($fields)){
                $colums .= ', ';
            }
        }
        $q = "UPDATE {$table} SET {$colums}";
        if($stmt = $this->pdo->prepare($q)){
            foreach ($fields as $key => $value) {
                $stmt->bind(':' .$key, $value);
            }
            $stmt->execute();
        }
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
        header('Location: ../index.php');
    }

    public function checkEmail($email){
        $q= "SELECT email FROM user WHERE email= :email";
        $stmt = $this->pdo->prepare($q);
        $stmt->execute([':email' => $email]);
        $count= $stmt->rowCount();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }

    public function userIdByUsername($username){
        $q = "SELECT user_id FROM users WHERE username = :username";
    }

}

?>