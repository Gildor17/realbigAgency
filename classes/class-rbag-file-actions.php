<?php

if (!defined("ABSPATH")) {exit;}

if (!class_exists('RBAG_FileActions')) {
    class RBAG_FileActions {
    	const PURPOSE_CUSTOM_PAGE = "customPage";

    	private $media_folder_path;
    	private $media_folder_url;
    	private $filesType;
    	private $purpose;

	    function __construct($media_folder_path, $media_folder_url, $filesType, $purpose) {
		    $this->media_folder_path = $media_folder_path;
		    $this->media_folder_url = $media_folder_url;
		    $this->filesType = $filesType;
		    $this->purpose = $purpose;
	    }

	    function load($url, $cookie = "", $post = "") {
		    $url = (strpos($url, "feeds.feedburner.com") !== false) ? $url."?format=xml" : $url;
		    $rez = "";

		    $method = "GET";
		    $data = null;
		    if(!empty($post)){
			    $method = "POST";
			    $data = array('content' => $post);
		    }
		    $opts = array(
			    'http'=>array(
				    'method'=>$method,
				    'header'=>"Accept-language: en\r\n" .
				              "Cookie: ".$cookie."\r\n",
				    "User-Agent: Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.6) Gecko/20071115 Firefox/2.0.0.6 LBrowser/2.0.0.6\r\n",
				    "Referer: http://www.yahoo.com/\r\n",
				    $data
			    ),
		    );
		    $context = stream_context_create($opts);

		    try {
			    $rez = file_get_contents($url, false, $context);
		    } catch (Exception $ex3) {
			    $rez = false;
		    } catch (Error $er3) {
			    $rez = false;
		    }

		    $is_gzip = 0 === mb_strpos($rez, "\x1f" . "\x8b" . "\x08", 0, "ASCII");
		    if($is_gzip) $rez = gzdecode($rez);

		    if($rez){
			    $rez = $this->fix_image_url($rez, $url);
			    return $rez;

		    } else return false;
	    }

	    /**
	     * @param $url
	     * @param $media_folder
	     * @param $upIndex
	     *
	     * @return array|bool
	     */
	    function upload_file($url) {
		    $path_parts = pathinfo(trim($url));
		    $approvedExtension = false;
		    $availableExt = ["jpg","png","jpeg","svg"];

		    if (!empty($path_parts['extension'])&&in_array(strtolower($path_parts['extension']), $availableExt)) {
			    $approvedExtension = true;
		    } else {
			    foreach ($availableExt AS $item) {
				    $matchRez = preg_match('~'.$item.'~', strtolower($path_parts['extension']), $mE);
				    if (!empty($matchRez)) {
					    $path_parts['extension'] = $mE[0];
					    $approvedExtension = true;
					    break;
				    }
			    }
		    }

		    if (!empty($approvedExtension)) {
			    $path_parts['basename'] = $path_parts['filename'].".".$path_parts['extension'];
			    $path_parts['basename'] = $this->clear_img_name($path_parts['basename']); // с этим именем файл сохраняется у нас
			    try {
				    if($this->download($url, $this->media_folder_path.$path_parts['basename'])) {
					    $result = $this->media_folder_url.$path_parts['basename'];
					    return $result; // return array with path and url to image
				    }
			    } catch (Exception $ex4) {}
		    }
		    return false;
	    }

	    function clear_img_name($imgName) {
		    $editedImgName = preg_replace("~\%~i", "", $imgName);
		    if (!empty($editedImgName)) {
			    $editedImgName = preg_replace("~[\\\/]~i", "", $editedImgName);
		    } else {
			    $editedImgName = preg_replace("~[\\\/]~i", "", $imgName);
		    }
		    if (!empty($editedImgName)) {
			    return $editedImgName;
		    } else {
			    return $imgName;
		    }
	    }

	    function fix_image_url($res, $usedUrl) {
		    if(preg_match_all("~src\s*=\s*[\"']([\S\s]+?)[\"']~i", $res, $matches)){
			    foreach ($matches[1] as $key => $mth) {
				    $url = $mth;
				    $src = $matches[0][$key];
				    $url = $this->_prepareUrl(trim($url), $usedUrl);

				    $src = str_replace($mth, $url, $src);
				    $res = str_replace($matches[0][$key], $src, $res);
			    }
		    }
		    return $res;
	    }

	    function _prepareUrl($furl, $usedUrl, $strip_get = false){
		    if($furl == "") return "";

		    // check current problem with "this"
		    $scheme = parse_url($usedUrl, PHP_URL_SCHEME);

		    $host = parse_url($usedUrl, PHP_URL_HOST);
		    if(substr( $furl, 0, 2 ) == "//"){
			    $furl = $scheme.":".$furl;
		    }

		    if($furl[0] == "/"){
			    $furl = $scheme."://".$host.$furl;
		    } else
			    if($furl[0] != "/" && strpos($furl, "http") === false && strpos($furl, "www") === false){
				    $furl = $scheme."://".$host."/".$furl;
			    }


		    if(strpos($furl, "http") === false) $furl = $scheme."://".$furl;
		    if(strpos($furl, "?") !== false && $strip_get != false){
			    $furl = explode("?", $furl);
			    $furl = $furl[0];
		    }

		    $host_img = parse_url($furl, PHP_URL_HOST);
		    $host_base = parse_url($usedUrl, PHP_URL_HOST);
		    if($host_img != "" && $host_img != $host_base){
			    return $furl;
		    }

		    return $furl;
	    }

	    function download($file_url, $s_fname){
		    //$data = file_get_contents($file_url);
		    $data = $this->load($file_url);
		    if($data === false) return false;
		    try {
			    $res = file_put_contents(trim($s_fname), $data);
		    } catch (Exception $ex2) {
			    $res = false;
		    } catch (Error $er2) {
			    $res = false;
		    }
		    //var_dump($file_url);
		    //var_dump($res);
		    if($res !== false && file_exists($s_fname)){
			    return $res;
		    }else{return false;}
	    }

	    function mt_rand_str($l, $c = 'abcdefghijklmnopqrstuvwxyz1234567890') {
		    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
		    return $s;
	    }

	    function image_search($content) {
		    try {
			    $matchesResult = [];
			    $newContent = "";
			    $prevContent = "";
			    if ($this->filesType==="images"&&$this->purpose===self::PURPOSE_CUSTOM_PAGE) {
				    $patterns = [
//	    			"~<img(?:[^><]*?|)src\s*=\s*[\"']([^><]+?)[\"'](?:[^><]*?)>(?:<\/img>|)~uis",
					    "src" => "~src\s*=\s*[\"']([^><\"']+?)[\"']~uis",
					    "url" => "~url\s*\([\"']?([^><\"']+?)[\"']?\)~uis",
				    ];
				    foreach ($patterns as $k => $pattern) {
					    preg_match_all($pattern, $content, $matches);
					    if (!empty($matches)) {
						    $matchesResult[$k] = $matches;
					    }
				    }
				    unset($k, $pattern);

				    if (!empty($matchesResult)) {
					    foreach ($matchesResult as $k => $item) {
						    if (!empty($item)&&!empty($item[1])) {
							    foreach ($item[1] as $k1 => $item1) {
								    if (empty($newContent)) {
									    if (!empty($prevContent)) {
										    $newContent = $prevContent;
									    } else {
										    $newContent = $content;
									    }
								    } else {
									    $prevContent = $newContent;
								    }
								    if (!empty($item1)) {
									    $resultedUrl = $this->upload_file($item1);
									    if (!empty($resultedUrl)) {
										    $newPart = $item[0][$k1];
										    $newPart = preg_replace('~'.$item1.'~', $resultedUrl, $newPart);
										    $newContent = preg_replace('~'.$item[0][$k1].'~', $newPart, $newContent);
									    }
								    }
							    }
							    unset($k1, $item1);
						    }
					    }
					    unset($k, $item);
					    if (!empty($newContent)) {
						    $content = $newContent;
					    }
				    }
			    }
		    }
		    catch (Exception $ex) {}
		    catch (Error $ex) {}

	    	return $content;
	    }
    }
}