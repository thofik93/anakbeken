<?php session_start(); 
function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s'
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

//ob_start("sanitize_output");
?>
<?php include('libs/config.php');?>
<?php include('libs/function.php');?>
<?php include('libs/class/Pagination.class.php');?>
<?php
  error_reporting(1);
  $uri = str_replace("/anakbeken","",$_SERVER['REQUEST_URI']);
  $alias = $uri;
  $varelement = explode('/',$alias);
  include "front/route.php";

  include('libs/con_close.php');
//ob_end_flush();
?>
