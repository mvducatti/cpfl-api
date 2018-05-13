<?php 

require_once '../../includes/DBFaturaOperations.php';

$response = array(); 

    if($_SERVER['REQUEST_METHOD']=='GET'){

        $db = new DBNewsOperations();        
         
        $news = $db->getTaxes();
        
        $response['taxas'] =  $news;

    }else{
        $response['error'] = true; 
        $response['message'] = "Error ao tentar carregar lista!";          
    }
echo json_encode($response);