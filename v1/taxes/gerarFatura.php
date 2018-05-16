<?php 

require_once '../../includes/DBFaturaOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

    $year = $_POST['year'];
    $month = $_POST['month'];
    $consumo = $_POST['consumo'];
    $user_id = $_POST['user_id'];

    if(empty($year) || empty($month) || empty($consumo) || empty($user_id)){
        $response['error'] = true;
        $response['message'] = "Por favor preencha todos os campos";
    }else{  

            $db = new DBNewsOperations(); 
            $result = $db->registerFatura($_POST['year'], $_POST['month'], $_POST['consumo'], $_POST['user_id']);

            if($result == 1){
                $response['error'] = false; 
                $response['message'] = "Fatura registrada com sucesso";
                $response['user_id'] = $user_id;
            }elseif($result == 2){
                $response['error'] = true; 
                $response['message'] = "Algum erro aconteceu, por favor tente novamente em alguns instantes. 
                Se o problema persistir procure o CTI"; 
            }
    }
    }else{
        $response['error'] = true; 
        $response['message'] = "Invalid Request";
    }

    echo json_encode($response);