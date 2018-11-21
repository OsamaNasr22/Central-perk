<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function lang($phrase){
    $lang =array(
        "BRAND"=>"Home",
        "SECTIONS"=>"Categories",
        "ITEMS"=>"Items",
        "MEMBERS"=>"Members",
        "STAT"=>"Banners",
        "LOG"=>"Comments",
        "ADMIN_NAME"=>$_SESSION['admin'],
        "Edit_profile"=>"Edit Profile",
        "SETTINGS"=>"Settings",
        "LOGOUT"=>"Logout",
        ""=>"",
    );
    if(key_exists($phrase, $lang)){
           return $lang["$phrase"];
    } else {
        return FALSE;    
    }
 
}
