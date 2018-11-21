<?php

$tem="includes/tempelates/";
$css="layout/css/";
$js="layout/js/";
$fun="includes/functions/";
$img="layout/images/";
$lang="includes/lang/";
include './connect.php';
include $fun."functions.php";
include $lang.'english.php';
include $tem.'header.php';
if(!isset($nonavbar)){
    include $tem.'navbar.php';
}