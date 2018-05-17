<?php 

require_once '../../includes/DBFaturaOperations.php';

$response = array(); 

    if($_SERVER['REQUEST_METHOD']=='GET'){

    	$user_id = $_GET['user_id'];

        $db = new DBNewsOperations();        
         
        $faturas = $db->getAllFaturas($user_id);
        
        $response['faturas'] =  $faturas;

    }else{
        $response['error'] = true; 
        $response['message'] = "Error ao tentar carregar lista!";          
    }
echo json_encode($response);