<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set('display_errors', 'on');
  	define("SITE_NAME" , "Anak Beken");
	  define("COMPANY_NAME" , "Daihatsu");
	  define("SUPERADMIN_EMAIL" , "contact@thofikwiranata.com");
  	define("SITEURL", "/anakbeken/");
  	define("SITEPATH", $_SERVER['DOCUMENT_ROOT'] . "/anakbeken/");

  	/* database config */
  	define("DATABASE_LOCATION", "localhost");
    define("DATABASE_USERNAME", "root");
    define("DATABASE_PASS", "");
    define("DATABASE_NAME", "commonwealth");

    //require_once(SITEPATH.'libs/con_open.php');
?>