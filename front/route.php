<?php
	$varelement = explode('/', $alias);
	define("URI","/");

	if( $uri== URI.'index.php' || $uri== URI ){
		include "front/home.php";
	}else{
		switch($varelement[1]){
			case 'home':
				require_once 'front/home.php';
				break;	
			case 'detail':
				require_once 'front/detail_article.php';
				break;
			case 'category':
				require_once 'front/detail_category.php';
				break;		
			default :
				include "front/home.php";
				break;
		}
	}
?>