<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload
 *
 * @author OSAMANASR
 */
class upload {
    private $file;
    private $extentionallowed;
    private $maxSize;
    private $directory;
    private $urlFile;
    function __construct($file,$extentionallowed,$maxSize,$directory) {
        if(is_array($extentionallowed)&& is_int($maxSize)){
            $this->file=$file;
            $this->maxSize= $maxSize;
            $this->extentionallowed= $extentionallowed;
            $this->directory= $directory;
        } else {
            if(!is_array($extentionallowed)){throw new Exception("error this is not array");}
            if(!is_int($maxSize)){ throw new Exception("the max size must be integer");}
        }
    }
    
    function upload(){
        $file= $this->file;
        $maxsize= $this->maxSize;
        $dir= $this->directory;
        $ext= $this->extentionallowed;
        
            $errors=array();
            $filename=$file['name'];
            $array= str_split($filename);
            $array2= array_diff($array,array("-","_","#","+","/"));
           $name= implode($array2, "");
            $filetmpname=$file['tmp_name'];
            $strext=explode(".", $name);
            $fileext= strtolower(end($strext));
            $fileSize=$file['size'];
            if(!in_array($fileext, $ext)){$errors[]="Sorry,Extention not allowed";}
            if($fileSize >$maxsize){$errors[]="The Size must be at most {$maxsize}";}
            if(empty($errors)){
                $rand= rand(0, 500000);
               $url= $this->urlFile=$rand.$name;
                $distenation=$dir.$url;
               move_uploaded_file($filetmpname, $distenation);
         
            } else {
                foreach ($errors as $value) {
                    throw new Exception(redirect("<div class='alert alert-danger'>$value</div>","back",2));
                }    
            }
        
        return TRUE;
    }
    function geturl(){
        return $this->urlFile;
    }}
