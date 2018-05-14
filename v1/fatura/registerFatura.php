<?php 

require_once '../../includes/DBUserOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(empty($_POST['cpf']) || empty($_POST['consumo'])){
        $response['error'] = true; 
        $response['message'] = "Por favor preencha todos os campos";
        
    }else{

        $db = new DBUserOperations(); 

        if($db->userLogin($_POST['year'],  $_POST['month'], $_POST['cpf'], $_POST['consumo'])){
            $user = $db->getUserByCpf($_POST['cpf']);
            $response['error'] = false; 
            $response['cpf'] = $user['cpf'];
            $response['nome'] = $user['username'];
            $response['message'] = "Fatura gerada com sucesso!"; 
        }else{
            $response['error'] = true; 
            $response['message'] = "CPF Inexistente, verifique novamente";          
        }
    }
}

echo json_encode($response);