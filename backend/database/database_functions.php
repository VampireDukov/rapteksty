<?php
    class DataBase{
        private function getConfig(){
            $file = 'config.ini';
            if (!file_exists($file)) {
                $file = 'config.ini';
            }
            $config = parse_ini_file($file, true);
            $config = json_encode($config);
            $config = json_decode($config);
            return $config;
        }
        private function DBConnect($login){
           
            try{
                $conn = new PDO("mysql:host=$login->host;dbname=$login->base", $login->login, $login->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               
                return $conn;
           }     
           catch(PDOException $e){
            echo $e;
           }  
        }
        private function checkExists($conn,$table,$what_to_check, $check_value){
            
            try{
                $stmt=$conn->prepare("SELECT COUNT(*) FROM $table WHERE $what_to_check = '$check_value'");
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_BOTH);
                
                if($result[0] <> 1){
                    print_r($result);
                    return true;
                }
                else{
                    return 'userexists';
                } 
            }
            catch(PDOEception $e){
                return 'error';
                
            }
        }
        public function regUser($conn,$login,$mail,$password,$ip,$date ){
            if($this->checkExists($conn,'users','login', $login) === true && $this->checkExists($conn,'users','mail', $mail) === true){
                try{
                    $stmt=$conn->prepare(file_get_contents('queries/addUser.mysql'));
                    $stmt->bindValue(':login', $login, PDO::PARAM_STR);
                        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
                    $stmt->bindValue(':password', $password , PDO::PARAM_STR);
                    $stmt->bindValue(':ip', $ip, PDO::PARAM_STR);
                    $stmt->bindValue(':date', $date , PDO::PARAM_STR);
                    $stmt->execute();
                    return true;
                
            }
            catch(PDOException $e){
                echo $e;
                die();
            }
            die();
            }
        }    
        public function Connect(){
            
            $login = $this->getConfig();
            $conn = $this-> DBConnect($login);
            return $conn;
        }
    }