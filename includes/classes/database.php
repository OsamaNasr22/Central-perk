<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author OSAMA
 */
class database{
    private $con;
    private $data;
    function __construct() {
        $this->connect();
    }
            
    function connect(){
        $dns="mysql:host=localhost;dbname=restaurant";
        $user="root";
        $password="";
        $option =array(
        PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"

        );

        try {
            $this->con = new PDO($dns,$user,$password,$option);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        } catch (Exception $ex) {
            echo 'Falied to connect '.$ex->getMessage();
        }
        }
        
        function select($select,$tablename,$query="",$data=""){
            $stm= $this->con->prepare("SELECT $select FROM $tablename $query");
            if (is_array($data)) {
            $stm->execute($data);
        } else {
            $stm->execute();
        }
            $rows=$stm->fetchAll();
        
            return $rows;
        }
        function totalItem($select,$tablename,$query="",$data=""){
            
            $stm= $this->con->prepare("SELECT $select FROM $tablename $query");
           if (is_array($data)) {
            $stm->execute($data);
        } else {
            $stm->execute();
        }
            $rows=$stm->rowCount();
            return $rows;
        }
        function latestItems($select,$table,$order,$query="",$limit=5){
            $stm= $this->con->prepare("SELECT $select FROM $table $query  ORDER BY $order DESC LIMIT $limit");
            $stm->execute();
            $row=$stm->fetchAll();
            return $row;
                }
                function  Delete($tablename,$id){
                    $stm= $this->con->prepare("DELETE FROM $tablename WHERE id=? ");
                    $stm->execute(array($id));
                    $row=$stm->rowCount();
                    return $row;
                }
                function activateMembers($tablename,$id,$set="regStatus=1"){
         $stm= $this->con->prepare("UPDATE $tablename SET $set WHERE id=?");
        $stm->execute(array($id));
        $row=$stm->rowCount();
        return $row;
                }
                function Add($table,$data){
//                    $arrkey= array_keys($data);
//                    $arrvalues= array_values($data);
//                    $query="";
//                    $quaryaar="";
//                    $test="xxx";
//                    $ass= implode(",",$arrkey);
//                    foreach ($arrkey as $val){
//                        $query.= sprintf(":z%s,",$val);
//                    }
//                    $query.=$test;
//                    $query= str_replace(",xxx","", $query);
//
//                  foreach ($arrkey as $vals){
//                        $quaryaar.=sprintf("z%s,",$vals);
//                    }
//                    $quaryaar.=$test;
//                    $quaryaar= str_replace(",xxx"," ",$quaryaar);
//                    $finalkeys= explode(",", $quaryaar);
//                     
//                     $input="INSERT INTO $tablename($ass) VALUES($query)";
//                     
//                      $stm= $this->con->prepare($input);
//                      for($i=0;$i<count($finalkeys);$i++){
//                           $stm->bindValue($finalkeys[$i],$arrvalues[$i]);
//                      }
//                     
//                        $stm->execute();
//                            $row=$stm->rowCount();
//                                 return $row;
                         $columns = "";  
                         $holders = "";
                    foreach ($data as $column => $value)
                    {  
                       $columns .= ($columns == "") ? "" : ", ";  
                       $columns .= $column;  
                       $holders .= ($holders == "") ? "" : ", ";  
                       $holders .= ":$column";
                   }  
                    $sql = "INSERT INTO $table ($columns) VALUES ($holders)";  
                    $stmt = $this->con->prepare($sql);
   
                    foreach ($data as $placeholder => $value)
                    {
                    $stmt->bindValue(":$placeholder", $value);        
                     }
                    $stmt->execute();
                    $row=$stmt->rowCount();
                    return $row;
                }
                
                function Update($tablename,$data,$id){
                    $query="";
                    $test="xxx";
                    $ara1= array_values($data);
                    foreach ($data as $key => $value) {
                        $query .="$key=?,";
                        
                    }
                    $query.=$test;
                    $query= str_replace(",xxx", "", $query);
                    $query.=" WHERE id=?";
                    $ara1[]=$id;
                    $sql=" UPDATE $tablename SET $query";
                    $stm= $this->con->prepare($sql);
                    $stm->execute($ara1);
                    return $stm->rowCount();
                }
        
            
}