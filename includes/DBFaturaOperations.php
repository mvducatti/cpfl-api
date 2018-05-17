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

    public function getAllFaturas($user_id){
        $stmt = $this->con->prepare("SELECT year, month, consumo
        FROM consumo WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        /* bind result variables */
        $stmt->bind_result($year, $month, $consumo);
        $arrayFaturas = array();                   
        /* fetch values */
        while ($stmt->fetch()) {

            $temp = array();
            $temp['year'] = $year; 
            $temp['month'] = $month; 
            $temp['consume'] = $consumo;
             
            array_push($arrayFaturas, $temp);

        }
        /* close statement */
        $stmt->close();
        return $arrayFaturas;
    }

}