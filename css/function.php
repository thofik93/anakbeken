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

function paging($reload, $hal, $thals, $adjacents) {
	$prevlabel 	= '&lsaquo; Prev';
	$nextlabel 	= 'Next &rsaquo;';
	$output 	= '<ul class="pagination">';

	if ($hal === 1) {
		$output.= '<li class="disabled"><a href="#">'.$prevlabel.' </a></li>';
		$output.= '<li><a href="#">1</a></li>';
	} else if($hal === 2) {
		$output.= '<li><a href="'.$reload.'/page/'.($hal-1).'">'.$prevlabel.'</a></li>';
	}else {
		$output.= '<li><a href="'.$reload.'/page/'.($hal-1).'">'.$prevlabel.'</a></li>';
	}
	
	
	if($hal > ($adjacents + 1)) {
		$output.= '<li><a href="'.$reload.'/page/1">1</a></li>';
	}
	
	if($hal > ($adjacents + 2)) {
		$output.= '...\n';
	}

	$pmin = ($hal > $adjacents) ? ($hal - $adjacents) : 1;
	$pmax = ($hal < ($thals-$adjacents)) ? ($hal + $adjacents) : $thals;
	for($i = $pmin; $i <= $pmax; $i++) {
		if($i === $hal) {
			//$output.= "&nbsp;<span>$i</span>";
			//$number = '<span>'.$i.'</span>';
		}else if($i === 1) {
			$output.= '<li><a href="'.$reload.'/page/'.$i.'">'.$i.'</a></li>';
		}else {
			$output.= '<li><a href="'.$reload.'/page/'.$i.'">'.$i.'</a></li>';
		}
	}

	if($hal < ($thals-$adjacents - 1)) {
		$output.= '...\n';
	}

	if($hal < ($thals - $adjacents)) {
		$output.= '<li><a href="'.$reload.'/page/$thals">'.$thals.'</a></li>';
	}

	if($hal < $thals) {
		$output.= '<li><a href="'.$reload.'/page/'.($hal+1).'">'.$nextlabel.'</a></li>';
	}else {
		$output.= '<li class="disabled"><a href="#">'.$nextlabel.'</a></li>';
	}
	$output.= '</ul>';
	return $output;

}

// kalo ubah cryptKey berarti data yang di database harus diubah
// sebaiknya jangan di ganti jika sistem telah berjalan
function encrypt_password($q) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded  = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
    return($qEncoded);
}

function decrypt_password($q) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded  = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))),"\0");
    return($qDecoded);
}

function alert($message) {
	echo '<script>alert("'.$message.'")</script>';
}

function date_readable ($origin_date) {
	$explode = explode(' ', $origin_date);
	$origin_date = $explode[0];
	$date = date('d/m/Y',strtotime($origin_date));
	return $date;

}

function get_thumbnail_youtube($url) {
	$explode_url = explode('=', $url);
	$get_id_youtube = $explode_url[1];
	return $get_id_youtube;
}

function print_permalink($varelement, $default_uri = 'detail') {
	if(!is_array($varelement)) {
		throw new Exception("Parameter harus array", 1);
	}
 
	if($varelement[2] == $default_uri) {
		$uri_title = !empty($varelement[4]) ? $varelement[4] . ' | ' : '';
		$res = generate_title_permalink($uri_title);
		return $res;
	} else {
		return null;
	}
}

function generate_title_permalink($str) 
{
	if(is_string($str)) {
		$str = str_replace('-', ' ', $str);
		$str = ucwords($str);
		return $str;
	} else {
		throw new Exception("Parameter must string", 1);
	}
}

function generate_permalink($segmen) 
{
	if(!empty($segmen)) {
		$segmen = trim($segmen);
		$segmen = str_replace(array('?', '&', '=', ',', '.', '!'), '', $segmen);
		$segmen = str_replace(' ', '-', $segmen);
		$segmen = strtolower($segmen);

	} else {
		throw new Exception("Parameter tidak boleh kosong", 1);
	}

	return $segmen;
}

?>