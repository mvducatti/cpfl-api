<?php 

class DBNewsOperations{
   
    private $con; 
    private $res;

    function __construct(){
       
        require_once dirname(__FILE__).'/DBConnect.php';
        
        $db = new DBConnect();
        
        $this->con = $db->connect();
        
    }

    public function getTaxes(){
        $stmt = $this->con->prepare("SELECT `flag_color`, `kwh`, `percentage` FROM `taxas`");
        $stmt->execute();
        /* bind result variables */
        $stmt->bind_result($flag_color, $kwh, $percentage);
        $arrayTaxas = array();                   
        /* fetch values */
        while ($stmt->fetch()) {

            $temp = array();
            $temp['flag_color'] = $flag_color; 
            $temp['kwh'] = $kwh; 
            $temp['percentage'] = $percentage;
             
            array_push($arrayTaxas, $temp);

        }
        /* close statement */
        $stmt->close();
        return $arrayTaxas;
    }

    public function updateTaxes($flag_color, $kwh, $percentage){    
        $stmt = $this->con->prepare("UPDATE taxas SET flag_color = $flag_color, kwh = $kwh, percentage = $percentage 
        WHERE flag_color IS NOT NULL;");     

        if($stmt->execute()){
            return 1; 
        }else{
            return 2; 
        }
    }

    public function registerFatura($year, $month, $consumo, $user_id){    
        $stmt = $this->con->prepare("INSERT INTO consumo (year, month, consumo, user_id) VALUES (?, ?, ?, ?);");
        $stmt->bind_param("ssss", $year, $month, $consumo, $user_id);       

        if($stmt->execute()){
            return 1; 
        }else{
            return 2; 
        }
    }

    public function getAllNews(){
        $stmt = $this->con->prepare("SELECT `news_id`, `news_post`, `news_date_created`, `news_poster`, 
        users.user_profile_pic, users.username, users.email  
        FROM `news` 
        INNER JOIN users on news.news_poster = users.user_id");
        $stmt->execute();
        /* bind result variables */
        $stmt->bind_result($news_id, $news_post, $news_date_created, $news_poster, 
        $users_user_profile_pic, $users_username, $users_email);
        $arrayNews = array();                   
        /* fetch values */
        while ($stmt->fetch()) {

            $temp = array();
            $temp['news_id'] = $news_id; 
            $temp['news_post'] = $news_post; 
            $temp['news_poster'] = $news_poster;
            $temp['news_date_created'] = $news_date_created;
            $temp['users.username'] = $users_username;
            $temp['users.email'] = $users_email;
            $temp['users.user_profile_pic'] = $users_user_profile_pic;
             
            array_push($arrayNews, $temp);

        }
        /* close statement */
        $stmt->close();
        return $arrayNews;
    }

}