<?php 
     
     require_once '../../includes/DBFaturaOperations.php';
      
     $response = array(); 
      
     if($_SERVER['REQUEST_METHOD']=='POST'){
 
     $flag_color = $_POST['flag_color'];
     $kwh = $_POST['kwh'];
     $percentage = $_POST['percentage'];
 
         if (empty($flag_color) | empty($kwh) | empty($percentage)){
         $response['error'] = true; 
         $response['message'] = "Por favor preencha todos os campos";
     } else {
 
         $db = new DBNewsOperations(); 
      
         $result = $db->updateTaxes($_POST['flag_color'], $_POST['kwh'], 
         $_POST['percentage']);
         
         if($result == 1 ){
             $response['error'] = false; 
             $response['message'] = "Taxas atualizadas com sucesso";
        }elseif($result == 2){
            $response['error'] = true; 
            $response['message'] = "Some error occurred please try again";          
        }
        }
     }else{
        $response['error'] = true; 
        $response['message'] = "Invalid Request";
    }
      
     echo json_encode($response);