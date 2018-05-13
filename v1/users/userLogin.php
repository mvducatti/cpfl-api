<?php 

require_once '../../includes/DBUserOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(empty($_POST['cpf']) || empty($_POST['password'])){
        $response['error'] = true; 
        $response['message'] = "Por favor preencha todos os campos";
        
    }else{

        $db = new DBUserOperations(); 

        if($db->userLogin($_POST['cpf'], $_POST['password'])){
            $user = $db->getUserByCpf($_POST['cpf']);
            $response['error'] = false; 
            $response['user_id'] = $user['user_id'];
            $response['cpf'] = $user['cpf'];
            $response['user_type'] = $user['user_type'];
            $response['message'] = "Login Efetuado com sucesso!"; 
        }else{
            $response['error'] = true; 
            $response['message'] = "Email ou senha incorretos, por favor verifique se os dados estão corretos";          
        }
    }
}

echo json_encode($response);