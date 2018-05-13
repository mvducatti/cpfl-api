<?php 

class DBUserOperations{
   
    private $con; 
    private $res;

    function __construct(){
       
        require_once dirname(__FILE__).'/DBConnect.php';
        
        $db = new DBConnect();
        
        $this->con = $db->connect();
        
    }

    public function createUser($cpf, $username, $password, $street, $house_number, $neighborhood, $city, $state, $user_type){
        if($this->isUserRegistered($cpf)){
            return 0; 
        }else{
            
            $stmt = $this->con->prepare("INSERT INTO users (cpf, username, password, street, house_number, neighborhood, city, state,
             user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);"); 
            $stmt->bind_param("ssssisssi", $cpf, $username, $password, $street, $house_number, $city, $state, 
            $neighborhood, $user_type);

            if($stmt->execute()){
                return 1;
            }else{
                return 2; 
            }
        }
    }

    public function userLogin($cpf, $password){
        $stmt = $this->con->prepare("SELECT user_id FROM users WHERE cpf = ? AND password = ?");
        $stmt->bind_param("ss", $cpf, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt-> num_rows > 0;
    }

    public function getUserByCpf($cpf){
        $stmt = $this->con->prepare("SELECT * FROM users WHERE cpf = ?");
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    
    private function isUserRegistered($cpf){
        $stmt = $this->con->prepare("SELECT user_id FROM users WHERE cpf = ?");
        $stmt->bind_param("s", $cpf);
        $stmt->execute(); 
        $stmt->store_result(); 
        return $stmt->num_rows > 0; 
    }

}