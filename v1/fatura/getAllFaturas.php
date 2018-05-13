<?php 

require_once '../../includes/DBNewsOperations.php';

$response = array(); 

    if($_SERVER['REQUEST_METHOD']=='GET'){

        $db = new DBNewsOperations();        
         
        $news = $db->getAllNews();
        
        $response['news'] =  $news;

    }else{
        $response['error'] = true; 
        $response['message'] = "Error ao tentar carregar lista!";          
    }
echo json_encode($response);