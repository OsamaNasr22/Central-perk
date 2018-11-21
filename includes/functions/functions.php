<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//function gettitle() if the page has the var pagetitle , echo this value in the title otherwise echo the default valeu
function getTitle(){
    global $pageTitle;
    if(isset($pageTitle)){
        return $pageTitle;
    } else {
        return "defualt page";    
    }
}

function redirect($errorms,$page=null,$second=3){
    echo $errorms;
    if($page==null){
        $page="index.php";
    } else {
    $page=(isset($_SERVER["HTTP_REFERER"])&&$_SERVER["HTTP_REFERER"]!="")?$_SERVER["HTTP_REFERER"]:"index.php";    
    }
    header("refresh:$second;url=$page");
    exit();
}

function checkitem($select ,$from,$value){
    global $con;
    $stmm=$con->prepare("SELECT $select FROM $from WHERE $select=?");
    $stmm->execute(array($value));
    $count=$stmm->rowCount();
    return $count;
}
function  totalItem($item ,$table,$condition=""){
    global $con;
    $stmmm=$con->prepare("SELECT COUNT({$item}) FROM $table WHERE $condition");
    $stmmm->execute();
    
    return $stmmm->fetchColumn();
}
function latestItems($select,$table,$order,$limit=5){
    global $con;
    $stmmm=$con->prepare("SELECT $select FROM $table  WHERE GroupId!=1 ORDER BY $order LIMIT $limit");
    $stmmm->execute();
    $row=$stmmm->fetchAll();
    return $row;
}
function autoload($class){
    $directory=array('', './includes/classes/', 'classes/', '../includes/classes/', '../classes/');
    $nameFormat=array('%s.php');
    foreach ($directory as $dir){
        foreach ($nameFormat as $format) {
            $path= $dir.sprintf($format,$class);
            if(file_exists($path)){
                include $path;
                return;
            }
        }        
    }
}
spl_autoload_register('autoload');

