<?php 

require_once '../../includes/DBUserOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

    $cpf = $_POST['cpf'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $street = $_POST['street'];
    $house_number = $_POST['house_number'];
    $neighborhood = $_POST['neighborhood'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $user_type = $_POST['user_type'];

    if(empty($cpf) || empty($username) || empty($password) || empty($street) || empty($house_number) || 
    empty($neighborhood) || empty($city) || empty($state) || empty($user_type)){
        $response['error'] = true;
        $response['message'] = "Por favor preencha todos os campos";
    }else{  

            $db = new DBUserOperations(); 
            $result = $db->createUser($_POST['cpf'], $_POST['username'], $_POST['password'], $_POST['street'],
            $_POST['house_number'], $_POST['neighborhood'], $_POST['city'], $_POST['state'], $_POST['user_type']);

            if($result == 1){
                $response['error'] = false; 
                $response['message'] = "Usuario registrado com sucesso";
            }elseif($result == 2){
                $response['error'] = true; 
                $response['message'] = "Algum erro aconteceu, por favor tente novamente em alguns instantes. 
                Se o problema persistir procure o CTI";          
            }elseif($result == 0){
                $response['error'] = true; 
                $response['message'] = "Essa conta ja esta cadastrada, por favor escolha outro usuario ou email";                     
            }
    }
    }else{
        $response['error'] = true; 
        $response['message'] = "Invalid Request";
    }

    echo json_encode($response);