<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dns="mysql:host=localhost;dbname=restaurant";
$user="root";
$password="";
$option =array(
PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"
    
);

try {
   $con = new PDO($dns,$user,$password,$option);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

} catch (Exception $ex) {
    echo 'Falied to connect '.$ex->getPrevious();
}


