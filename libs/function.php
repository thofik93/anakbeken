<?php 

function __autoload($class_name) 
{
	$class_name	= strtolower($class_name);
	$path 		= dirname(__FILE__)."/class/{$class_name}.php";
	if(file_exists($path)){
		require_once $path;
	}else{
		die("File {$class_name}.php tidak dapat ditemukan.");
	}
}

function getUriSegments()
{
	$siteurl 		= "//" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	$getRequestUri 	= "/" . ltrim(str_replace(SITEURL, "", $siteurl));
    return explode("/", parse_url($getRequestUri, PHP_URL_PATH));
}
 
function getUriSegment($n) 
{
    $segs = getUriSegments();
    return count($segs)>0&&count($segs)>=($n-1)?$segs[$n]:'';
}

function replace_text($text)
{
	$text=strtolower(preg_replace('/[^A-Za-z0-9_]/', '-', $text));
	return $text;
}

function redirect($url=null)
{
    if(!is_null($url)){ 
    	echo '<meta http-equiv="refresh" content="0; url='.$url.'"/>'; die; 
	}else{ 
		echo '<meta http-equiv="refresh" content="0; url='.SITEURL.'"/>'; die; 
	}
}

function load_view($filename, $data) 
{
	if(is_array($data) AND count($data) > 0){
		foreach ($data as $key => $value) {
			$$key = $value;
		}
	}

	require_once(SITEPATH.'views/'.$filename.".php");
}

function load_template ()
{
	global $DB, $facebook, $twitter, $bitly;
	$controller = getUriSegment(1);
	/* untuk menampilkan file yang di minta di dalam template */
	if(trim($controller) == "" OR $controller == "home" OR $controller == "index" OR $controller == "default"){
		if(file_exists(SITEPATH . "controllers/default.php")){
			require_once("controllers/default.php");
		}else{
			error404();
		}
	}else{
		$files = $controller . ".php";	
		if(file_exists(SITEPATH . "controllers/" . $files)){
			require_once("controllers/" . $files);
		}else{
			error404();
		}
	}
}

function error404 ()
{
	header('HTTP/1.0 404 Not Found');
	echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}

function custError ($code, $message)
{
	header("HTTP/1.0 {$code} Not Found");
	echo "<h1>Error {$code}</h1>";
    echo $message;
    exit();
}

function array_debug($array)
{
	echo '<pre>'; print_r($array); echo'</pre>';
}

/* facebook & twitter helpers */
function hasHashtag ($string){
	global $listHashtag;

	$tmpString = explode(" ", strtolower($string));
	foreach($listHashtag as $hashtag){
		if(in_array(strtolower($hashtag), $tmpString)){
			return 1;
		}
	}

	return 0;
}

function getDataUser($key) {
	$users = $_SESSION['rtiims_datauser'];
	if(isset($users[$key]))
		return $users[$key];

	return NULL;
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

function getLinkTitle($title){
	$link	= str_replace(" ","-",strtolower($title));
	return $link;
}

function flash_message ($message_name = null, $message_value = null) {
	
	if(!is_null($message_name) && !is_null($message_value)) 
	{
		setcookie($message_name, $message_value, (time() - (60 * 6.5)) + 5);
	} 
	elseif(!is_null($message_name)) 
	{
		echo $_COOKIE[$message_name];
	} 
	else 
	{
		trigger_error('invalid or bad arguments');
	}
}

function alert($message) {
	return '<script>alert("'.$message.'")</script>';
}

function set_tag_title_name($uri, $default_uri = 'Home') 
{
	if(!empty($uri)) {
		$uri = ucwords(str_replace('-', ' ', $uri));
	} else {
		$uri = $default_uri;
	}
	return $uri;
}

function print_permalink($varelement, $default_uri = 'detail') {
	if(!is_array($varelement)) {
		throw new Exception("Parameter harus array", 1);
	}
 
	if($varelement[1] == $default_uri) {
		return $varelement[2] . ' | ';
	} else {
		return null;
	}
}

function generate_permalink($segmen) 
{
	if(!empty($segmen)) {
		$segmen = trim($segmen);
		$segmen = str_replace(array('?', '&', '=', ',', '.'), '', $segmen);
		$segmen = str_replace(' ', '-', $segmen);
		$segmen = strtolower($segmen);

	} else {
		throw new Exception("Parameter tidak boleh kosong", 1);
	}

	return $segmen;
}

function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
       
        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
       
        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="first"><a href="'.$page_url.'?page=1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="'.$page_url.'?page='.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
                    }
                }  
            $first_link = false; //set first link to false
        }
       
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="active">'.$current_page.'</li>';
        }
               
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){
                $next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li><a href="'.$page_url.'?page='.$next_link.'" >&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="'.$page_url.'?page='.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }
       
        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}
?>