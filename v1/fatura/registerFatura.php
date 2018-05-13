    <?php 
     
    require_once '../../includes/DBNewsOperations.php';
     
    $response = array(); 
     
    if($_SERVER['REQUEST_METHOD']=='POST'){

    $news_post = $_POST['news_post'];
    $user_FK = $_POST['user_FK'];

        if(empty($news_post) || empty($user_FK)){
        $response['error'] = true; 
        $response['message'] = "Por favor preencha todos os campos";
    } else {

        $db = new DBNewsOperations(); 
     
            $result = $db->registerNews($_POST['news_post'], $_POST['user_FK']);
            if($result == 1 ){
                $response['error'] = false; 
                $response['message'] = "Noticia Registrada com sucesso";
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