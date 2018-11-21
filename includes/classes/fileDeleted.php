<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fileDeleted
 *
 * @author OSAMA
 */
class fileDeleted {
    
    function delete($file){
        
            if(file_exists($file)){
                unlink($file);
            }else{
                throw new Exception(redirect("<div class='alert alert-danger>'This file is not found</div>","back",2));
            } 
       
        return TRUE;
    }
}
