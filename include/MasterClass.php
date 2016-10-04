<?php
/**
 * Created by PhpStorm.
 * User: Arjun J S
 * Date: 04-10-2016
 * Time: 02:06 AM
 */

require_once ('config.php');


class MasterClass
{
    private $mysqli;

    function __construct()
    {
        $this->mysqli = new mysqli(DBHOST, DBUSER, DBPASSWORD, DATABASE);
    }

    function __destruct()
    {
        $this->mysqli->close();
    }

    
    public function distinctState(){  //list of distinct state

        $query = $this -> mysqli -> query("SELECT DISTINCT state FROM `students_details`");
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
               echo $row["state"]."<br/>";
            }
        }else {
            echo 'No Data';
        }
    }

    public function distinctStatus(){ //distinct Status List

        $distinctStatusArr=array();
        $query = $this -> mysqli -> query("SELECT DISTINCT status FROM `students_details`");
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
               $distinctStatusArr[]=$row['status'];
            }
            return $distinctStatusArr;
        }
    }

    public function StudentsDiscontinud(){ //no. of Students Discontinud vs completed
        $func=new MasterClass();
        $statuslist=$func->distinctStatus();
        $sql="SELECT";
        foreach ($statuslist as $key => $value) {                      
           $sql.="(SELECT COUNT(status) FROM `students_details` WHERE status='$value')as $value";
           if($key==(count($statuslist)-1)){
                $sql.="";
            }else{
                $sql.=",";
            }  
        }
        $query = $this -> mysqli -> query("$sql");
        $dataArray=array();
        if ($this -> mysqli -> affected_rows > 0) {
            $i=0;
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
                $dataArray[]=$row;
            }
        }
        return json_encode($dataArray);
    }

}