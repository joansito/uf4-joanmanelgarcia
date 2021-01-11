<?php

include 'dbconn.php';

class Client extends dbconn{

    private $dominio=false;
    private $date=false;
    function getClients(){
        
        global $dominio,$date;
        validateGets();
        if($dominio){
            $result =$this->connect()->query("SELECT*FROM clients WHERE clientEmail LIKE '%".$_GET["domain"]."%'");
        }else if($date){
            $result =$this->connect()->query("SELECT*FROM clients WHERE DATE(date) >= '".$_GET["date"]."'");  
        }else{
            $result =$this->connect()->query("SELECT*FROM clients");
        }

        return $result;
    }

}
function validateGets()
{
    global $dominio,$date;
    if (isset($_GET["date"])) {
        if (validateDate($_GET["date"])) {
            $date=true;
            return false;
        } else {
            echo "formato no correcto"."<br>";
        }

    }
    if (isset($_GET["domain"])) {
        if(($_GET["domain"]=="yahoo")||($_GET["domain"]=="gmail")||($_GET["domain"]=="hotmail")){
        $dominio=true;
        return false;
    }else{
        echo "dominio no valido"."<br>";
    }
    }
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

