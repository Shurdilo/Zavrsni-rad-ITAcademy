<?php  
    class Database{  
        public $db_user;
        public $db_password;
        public $db_name;
        public $db;
            
        function __construct() {  
              
            $this->db_user = "root";
            $this->db_password = "";
            $this->db_name = "wizardprint";

            $this->db = new PDO('mysql:host=localhost;dbname=' . $this->db_name . ';charset=utf8', $this->db_user, $this->db_password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               
        } 
        public function UserRegister($firstname, $lastname, $email, $password, $phone){  
            $sql = "INSERT INTO users (firstname, lastname, email, password, phone) VALUES (?,?,?,?,?)";
            $stmtinsert = $this->db->prepare($sql);
            $result = $stmtinsert->execute([$firstname, $lastname, $email, $password, $phone]);
            if($result){
                $_SESSION['message'] = "Uspješno ste se registrovali!";
                $_SESSION['icon'] = "success";
            }else{
                $_SESSION['message'] = "Registracija nije uspjela, dogodila se greška.";
                $_SESSION['icon'] = "error";
            }
        }  
        public function Login($email, $password){  
            $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
            $q = $this->db->query($sql);
            $user = $q->fetchAll(PDO::FETCH_ASSOC);
            $sqlc = "SELECT COUNT(*) FROM users WHERE email = '$email' LIMIT 1";
            $num_rows = $this->db->query($sqlc);
            $count = $num_rows->fetchColumn();
            if($count != 0){
                if($user[0]['email'] == $email && $user[0]['password'] == $password){
                    if($user[0]['status'] == '0'){
                        $_SESSION['message'] = "Vaš nalog je deaktiviran. Za sva pitanja kontaktirajte admin tim.";
                        $_SESSION['icon'] = "error";
                    }else{
                        $_SESSION['userlogin'] = $user;
                        header("Location: index");
                    }
                }else{
                    $_SESSION['message'] = "E-mail ili lozinka nisu tačni.";
                    $_SESSION['icon'] = "error";
                }
            }else{
                $_SESSION['message'] = "E-mail ili lozinka nisu tačni.";
                $_SESSION['icon'] = "error";
            }
        }  
    }  
?>  