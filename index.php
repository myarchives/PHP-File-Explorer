<?php 
$hiddenFilesWildcards = Array("*.php", "*~");
$allowSubDirs = true;
$allowPHPDownloads = false;
$useAutoThumbnails = true;
$cacheThumbnails = false;
$snifServer = $_SERVER['HTTP_HOST'];
//$snifServer = 'www.yourdomain.com';
$snifDateFormat = 'd-m-y';
$hiddenFilesRegex = Array();

$useDescriptionsFrom = "descript.ion";
$useDescriptionsFrom = "";  // en blanco para no usar

$separationString = "\t";
$useExternalImages = false;
$externalIcons = Array (
	"archive"	=> "",
	"binary"	=> "",
	"dirup"   => "",
	"folder"	=> "",
	"HTML"		=> "",
	"image"		=> "",
	"text"		=> "",
	"unknown"	=> "",
	"download"	=> "",   // 7x16 pixels
	"asc"		=> "",       // 5x3 pixels
	"desc"		=> ""      // 5x3 pixels
);

$externalStylesheet = "";

$externalConfig = "";

$descriptionFilenamesCaseSensitive = false;

$usePaging = 0;

$directDirectoryLinks = false;

$thumbnailHeight = 50;
$thumbnailWidth = 150;

$useBackForDirUp = true;

$displayColumns = Array(
	"download",
	"icon",
	"name",
	"type",
	"size",
	"date",
	"description"
);

$tableWidth100Percent = true;

$descriptionColumnWidth = 0;

$truncateLength = 30;

$protectDirsWithHtaccess = true;

$alwaysUseLanguage = "";

$languageStrings = Array(
	"en" => Array(
		// only serves as the default language, no translations needed
		// if you don't translate a string, the english version will be used
		
		"Index of" => "Indice de", // displayed in the page title
		"name" => "nombre", // column name in the file listing
		"type" => "tipo", // column name in the file listing
		"size" => "tama&ntilde;o", // column name in the file listing
		"date" => "fecha", // column name in the file listing
		"description" => "Descripci&oacute;n", // column name in the file listing
		"DATEFORMAT" => $snifDateFormat, // special string, sets the format of the date (see http://www.php.net/manual/en/function.date.php)
		"folder" => "directorio", // a folder in the file listing
		"archive" => "archivo", // an archive file in the file listing
		"image" => "imagen", // an image file in the file listing
		"text" => "texto", // a text file in the file listing
		"HTML" => "HTML", // an archive file in the file listing
		"unknown" => "desconocido", // an unknown file in the file listing
		"valid" => "valido", // used for "valid XHTML, valid CSS"
		"binary" => "binario", // a binary file
		"dirup" => "subir directorio", // tooltip of the .. folder icon
		"download" => "descargar", // tooltip of the download icon to the left
		"asc" => "ascendente", // sort in ascending order
		"desc" => "descendente", // sort in descending order
		"[ back ]" => "[ atras ]", // special name displayed for the .. folder
		"1 item" => "1 objeto", // displayed when a subdirectory contains exactly one file or directory
		"%d items" => "%d objetos", // 0 items, 42 items; displays the number of files and directories in a subdirectory. Leave %d as it is.
		"%s is not a subdirectory of the current directory." => "%s no es un subdirectorio del directorio actual.", // leave %s as it is, it is replaced by the directory name
		"File not found: %s" => "Archivo no encontrado: %s",  // leave %s as it is, it is replaced by the file name
		"Illegal characters detected in URL, ignoring." => "Caract&eacute;res ilegales en la URL ha sido ignorados.", // displayed when an URL parameter contains HTML special characters
		"Illegal path specified, ignoring." => "Ruta ilegal especificada ha sido ignorada", // displayed when the path URL parameter contains a potentially dangerous path
		"Bytes" => "", // appended to the exact file size in the tooltip ("462 Bytes")
		"B" => "B", // abbreviation of Bytes ("462 B")
		"KB" => "KB", // abbreviation of kilobyte ("12.4 KB")
		"MB" => "MB", // abbreviation of megabyte ("3.4 MB")
		"GB" => "GB", // abbreviation of gigabyte ("4.3 GB")
		"TB" => "TB",  // abbreviation of terabyte ("820 TB")
		"pages" => "p&aacute;ginas", // as in "4 pages"
		"previous" => "anterior", // as in "previous page"
		"next" => "siguiente" // as in "next page"
	),
	
	// Spanish translation by Martinp and Genaro Paez
	"es" => Array(
		"Index of" => "Indice de",
		"name" => "nombre", 
		"type" => "tipo", 
		"size" => "tama&ntilde;o", 
		"date" => "fecha", 
		"description" => "Descripci&oacute;n", 
		"DATEFORMAT" => $snifDateFormat, 
		"folder" => "directorio", 
		"archive" => "archivo", 
		"image" => "imagen", 
		"text" => "texto", 
		"HTML" => "HTML", 
		"unknown" => "desconocido", 
		"valid" => "valido", 
		"binary" => "binario", 
		"dirup" => "subir directorio", 
		"download" => "descargar", 
		"asc" => "ascendente", 
		"desc" => "descendente", 
		"[ back ]" => "[ atras ]", 
		"1 item" => "1 objeto", 
		"%d items" => "%d objetos", 
		"%s is not a subdirectory of the current directory." => "%s no es un subdirectorio del directorio actual.", 
		"File not found: %s" => "Archivo no encontrado: %s", 
		"Illegal characters detected in URL, ignoring." => "Caract&eacute;res ilegales en la URL ha sido ignorados.",
		"Illegal path specified, ignoring." => "Ruta ilegal especificada ha sido ignorada", 
		"Bytes" => "", 
		"B" => "B",
		"KB" => "KB",
		"MB" => "MB",
		"GB" => "GB",
		"TB" => "TB",
		"pages" => "p&aacute;ginas",
		"previous" => "anterior",
		"next" => "siguiente"
	)
);




/***************************************************************************/
/**  REAL CODE STARTS HERE, NO NEED TO CHANGE ANYTHING                    **/
/***************************************************************************/


/***************************************************************************/
/**  TRANSLATION                                                          **/
/***************************************************************************/

function translate($string) {
	GLOBAL $languageStrings, $alwaysUseLanguage;
	static $requestLanguage;
	
	if ($requestLanguage=="") {
		$validLanguages = array_keys($languageStrings);
		if ($alwaysUseLanguage!="" && in_array($alwaysUseLanguage, $validLanguages)) {
			$requestLanguage = $alwaysUseLanguage;
		} else {
			if ($requestLanguage == "") {
				$acceptLanguages = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
				for ($i=0; $i<count($acceptLanguages) AND $requestLanguage==""; $i++) {
					$al = substr($acceptLanguages[$i],0,2);
					if (in_Array($al,$validLanguages)) {
						$requestLanguage = $al;
					}
				}
				if ($requestLanguage=="") {
					$requestLanguage = $validLanguages[0];
				}
			}
		}
	}
	
	$stringTranslated = $languageStrings[$requestLanguage][$string];
	if ($stringTranslated!="") {
		return $stringTranslated;
	} else {
		return $string;
	}
}


/***************************************************************************/
/**  INITIALIZATION                                                       **/
/***************************************************************************/

// make sure all the notices don't come up in some configurations
error_reporting (E_ALL ^ E_NOTICE);

$displayError = Array();

// safify all GET variables
foreach($_GET AS $key => $value) {
	$_GET[$key] = strip_tags($value);
	if ($_GET[$key] != $value) {
		$displayError[] = translate("Illegal characters detected in URL, ignoring.");
	}
	if (!get_magic_quotes_gpc()) {
		$_GET[$key] = stripslashes($value);
	}
}


// read external config file
if ($externalConfig!="") {
	include($externalConfig);
}


// first of all, security: prevent any unauthorized paths
// if sub directories are forbidden, ignore any path setting
if (!$allowSubDirs) {
	$path = "";
} else {
	$path = $_GET["path"];
	
	// ignore any potentially malicious paths
	$path = safeDirectory($path);
}

// default sorting is by name
if ($_GET["sort"]=="") 
	$_GET["sort"] = "name";

// default order is ascending
if ($_GET["order"]=="") {
	$_GET["order"] = "asc";
} else {
	$_GET["order"] = strtolower($_GET["order"]);
}

// hide descriptions column if no description file is specified
if ($useDescriptionsFrom=="") {
	$index = array_search("description", $displayColumns);
	if ($index!==false && $index!==null) {
		unset($displayColumns[$index]);
	}
}
	
// add files used by snif to hidden file list
if ($useDescriptionsFrom!="") {
	$hiddenFilesWildcards[] = $useDescriptionsFrom;
}
if ($externalStylesheet!="") {
	$hiddenFilesWildcards[] = $externalStylesheet;
}
$hiddenFilesWildcards[] = ".";
$hiddenFilesWildcards[] = basename($_SERVER["PHP_SELF"]);

// build hidden files regular expression
for ($i=0;$i<count($hiddenFilesWildcards);$i++) {
	$translate = Array(
		"." => "\\.",
		"*" => ".*",
		"?" => ".?",
		"+" => "\\+",
		"[" => "\\[",
		"]" => "\\]",
		"(" => "\\(",
		")" => "\\)",
		"{" => "\\{",
		"}" => "\\}",
		"^" => "\\^",
		"\$" => "\\\$",
		"\\" => "\\\\",
	);
	$hiddenFilesRegex[] = "^".strtr($hiddenFilesWildcards[$i],$translate)."$";
}
// hide .*
$hiddenFilesRegex[] = "^\\.[^.].*$";
$hiddenFilesWholeRegex = "/".join("|",$hiddenFilesRegex)."/i";



/***************************************************************************/
/**  REQUEST HANDLING                                                     **/
/***************************************************************************/

// handle image requests
if ($_GET["getimage"]!="") {
	$imagesEncoded = Array(
		"archive"  => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI3lA+pxxgfUhNKPRAbhimu2kXiRUGeFwIlN47qdlnuarokbG46nV937UO9gDMHsMLAcSYU0GJSAAA7",
		"asc"      => "R0lGODlhBQADAIABAN3d3f///yH5BAEAAAEALAAAAAAFAAMAAAIFTGAHuF0AOw==",
		"binary"   => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI0lICZxgYBY0DNyfhAfROrxoVQBo5mpzFih5bsFLoX5iLYWK6xyur5ubPAbhPZrKhSKCmCAgA7",
		"desc"     => "R0lGODlhBQADAIABAN3d3f///yH5BAEAAAEALAAAAAAFAAMAAAIFhB0XC1sAOw==",
		"dirup"    => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAIulI+JwKAJggzuiThl2wbnT3WZN4oaA1bYRobXCLpkq5nnVr9xqe85C2xYhkRFAQA7",
		"folder"   => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAIplI+JwKAJggzuiThl2wbnT3UgWHmjJp5Tqa5py7bhJc/mWW46Z/V+UgAAOw==",
		"HTML"     => "R0lGODlhEAAQAKIHABsb/2ho/4CA/0BA/zY2/wAAAP///////yH5BAEAAAcALAAAAAAQABAAAANEeFfcrVAVQ6thUdo6S57b9UBgSHmkyUWlMAzCmlKxAZ9s5Q5AjWqGwIAS8OVsNYJxJgDwXrHfQoVLEa7Y6+Wokjq+owQAOw==",
		"image"    => "R0lGODlhEAAQAKIEAK6urmRkZAAAAP///////wAAAAAAAAAAACH5BAEAAAQALAAAAAAQABAAAANCSCTcrVCJQetgUdo6RZ7b9UBgSHnkAKwscEZTy74pG9zuBavA7dOanu+H0gyGxN0RGdClKEjgwvKTlkzFhWOLISQAADs=",
		"text"     => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI0lICZxgYBY0DNyfhAfXcuxnWQBnoKMjXZ6qUlFroWLJHzGNtHnat87cOhRkGRbGc8npakAgA7",
		"download" => "R0lGODlhBwAQAIABAAAAAP///yH5BAEAAAEALAAAAAAHABAAAAISjI+pywb6UkQzgHsPls3h2gUFADs=",
		"blank"    => "R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",
		"unknown"  => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI1lICZxgYBY0DNyfhAfXcuxnkI1nCjB2lgappld6qWdE4vFtprR+4sffv1ZjwdkSc7KJYUQQEAOw=="
	);
	$imageDataEnc = $imagesEncoded[$_GET["getimage"]];
	if ($imageDataEnc) {
		$maxAge = 31536000; // one year
		doConditionalGet($_GET["getimage"], gmmktime(1,0,0,1,1,2004));
		$imageDataRaw = base64_decode($imageDataEnc);
		Header("Content-Type: image/gif");
		Header("Content-Length: ".strlen($imageDataRaw));
		Header("Cache-Control: public, max-age=$maxAge, must-revalidate");
		Header("Expires: ".createHTTPDate(time()+$maxAge));
		echo $imageDataRaw;
	}
	
	die();
}

// handle thumbnail creation
if ($_GET["thumbnail"]!="") {
	GLOBAL $thumbnailHeight, $cacheThumbnails;
	$thumbnailCacheSubdir = ".snifthumbs";
	
	$file = safeDirectory(urldecode($_GET["thumbnail"]));
	doConditionalGet($_GET["thumbnail"],filemtime($file));

	$thumbDir = dirname($file)."/".$thumbnailCacheSubdir;
	$thumbFile = $thumbDir."/".basename($file);
	if ($cacheThumbnails) {
		if (file_exists($thumbDir)) {
			if (!is_dir($thumbDir)) {
				$cacheThumbnails = false;
			}
		} else {
			if (@mkdir($thumbDir)) {
				chmod($thumbDir, "0777");
			} else {
				$cacheThumbnails = false;
			}
		}
		if (file_exists($thumbFile)) {
			if (filemtime($thumbFile)>=filemtime($file)) {
				Header("Location: ".dirname($_SERVER["PHP_SELF"])."/".$thumbFile);
				die();
			}
		}
	}
	$contentType = "";
	$extension = strtolower(substr(strrchr($file, "."), 1));
	switch ($extension) {
		case "gif":		$src = imagecreatefromgif($file); $contentType="image/gif"; break;
		case "jpg":		// fall through
		case "jpeg":	$src = imagecreatefromjpeg($file); $contentType="image/jpeg"; break;
		case "png":		$src = imagecreatefrompng($file); $contentType="image/png"; break;
		default:	die(); break;
	}
	$srcWidth = imagesx($src);
	$srcHeight = imagesy($src);
	$srcAspectRatio = $srcWidth / $srcHeight;
	
	$maxAge = 3600; // one hour
	Header("Cache-Control: public, max-age=$maxAge, must-revalidate");
	Header("Expires: ".createHTTPDate(time()+$maxAge));

	if ($srcHeight<=$thumbnailHeight AND $srcWidth<=$thumbnailWidth) {
		Header("Content-Type: $contentType");
		readfile($file);
	} else {
		if ($srcWidth > $srcHeight) {
			$thumbWidth = $thumbnailWidth;
			$thumbHeight = $thumbWidth / $srcAspectRatio;
		} else {
			$thumbHeight = $thumbnailHeight;
			$thumbWidth = $thumbHeight * $srcAspectRatio;
		}
		if (function_exists('imagecreatetruecolor')) {
			$thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
		} else {
			$thumb = imagecreate($thumbWidth, $thumbHeight);
		} 
		imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $srcWidth, $srcHeight);
		Header("Content-Type: image/jpeg");
		if ($cacheThumbnails) {
			imagejpeg($thumb, $thumbFile);
			chmod($thumbFile, "0777");
			readfile($thumbFile);
		} else {
			imagejpeg($thumb);
		}
	}
	die();
}

// handle download requests
if ($_GET["download"]!="") {
	$download = stripslashes($_GET["download"]);
	$filename = safeDirectory($path.rawurldecode($download));
	if (
		!file_exists($filename)
		OR fileIsHidden($filename)
		OR (substr(strtolower($filename), -4)==".php" AND !$allowPHPDownloads)) {
		
		Header("HTTP/1.0 404 Not Found");
		$displayError[] = sprintf(translate("File not found: %s"), $filename);
	} else {
		//doConditionalGet($filename, filemtime($filename));
		Header("Content-Length: ".filesize($filename));
		Header("Content-Type: application/x-download");
		Header("Content-Disposition: attachment; filename=\"".rawurlencode($download)."\"");
		readfile($filename);
		die();
	}
}



/***************************************************************************/
/**  FUNCTIONS                                                            **/
/***************************************************************************/

// create a HTTP conform date
function createHTTPDate($time) {
	return gmdate("D, d M Y H:i:s", $time)." GMT";
}


// this function is from http://simon.incutio.com/archive/2003/04/23/conditionalGet
function doConditionalGet($file, $timestamp) {
	$last_modified = createHTTPDate($timestamp);
	$etag = '"'.md5($file.$last_modified).'"';
	// Send the headers
	Header("Last-Modified: $last_modified");
	Header("ETag: $etag");
	// See if the client has provided the required headers
	$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ?
		stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) :
		false;
	$if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ?
		stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : 
		false;
	if (!$if_modified_since && !$if_none_match) {
		return;
	}
	// At least one of the headers is there - check them
	if ($if_none_match && $if_none_match != $etag) {
		return; // etag is there but doesn't match
	}
	if ($if_modified_since && $if_modified_since != $last_modified) {
		return; // if-modified-since is there but doesn't match
	}
	// Nothing has changed since their last request - serve a 304 and exit
	Header('HTTP/1.0 304 Not Modified');
	die();
}


function safeDirectory($path) {
	GLOBAL $displayError;
	$result = $path;
	if (strpos($path,"..")!==false)
		$result = "";
	if (substr($path,0,1)=="/") {
		$result = "";
	}
	if ($result!=$path) {
		$displayError[] = translate("Illegal path specified, ignoring.");
	}
	return $result;
}


/**
 * Formats a file's size nicely (750 B, 3.4 KB etc.)
 **/
function niceSize($size) {
	define("SIZESTEP", 1024.0);
	static $sizeUnits = Array();
	if (count($sizeUnits)==0) {
		$sizeUnits[] = "&nbsp;".translate("B");
		$sizeUnits[] = translate("KB");
		$sizeUnits[] = translate("MB");
		$sizeUnits[] = translate("GB");
		$sizeUnits[] = translate("TB");
	}
	
	if ($size==="")
		return "";
	
	$unitIndex = 0;
	while ($size>SIZESTEP) {
		$size = $size / SIZESTEP;
		$unitIndex++;
	}
	
	if ($unitIndex==0) {
		return number_format($size, 0)."&nbsp;".$sizeUnits[$unitIndex];
	} else {
		return number_format($size, 1, ".", ",")."&nbsp;".$sizeUnits[$unitIndex];
	}
}

/**
 * Compare two strings or numbers. Return values as strcmp().
 **/
function myCompare($arrA, $arrB, $caseSensitive=false) {
	$a = $arrA[$_GET["sort"]];
	$b = $arrB[$_GET["sort"]];
	
	// sort .. first
	if ($arrA["isBack"]) return -1;
	if ($arrB["isBack"]) return 1;
	// sort directories above everything else
	if ($arrA["isDirectory"]!=$arrB["isDirectory"]) {
		$result = $arrB["isDirectory"]-$arrA["isDirectory"];
	} else if ($arrA["isDirectory"] && $arrB["isDirectory"] && ($_GET["sort"]=="type" || $_GET["sort"]=="size")) {
		$result = 0;
	} else {
		if (is_string($a) OR is_string($b)) {
			if (!$caseSensitive) {
				$a = strtoupper($a);
				$b = strtoupper($b);
			}
			$result = strcoll($a,$b);
		} else {
			$result = $a-$b;
		}
	}
	
	if (strtolower($_GET["order"])=="desc") {
		return -$result;
	} else {
		return $result;
	}
}


/**
 * URLEncodes some characters in a string. PHP's urlencode and rawurlencode
 * produce very unsatisfying results for special and reserved characters in
 * filenames.
 **/
function myEncode($path, $filename) {
	// % must be the first, as it is the escape character
	/*
	$from = Array("%"," ","#","&");
	$to = Array("%25","%20","%23","%26");
	return str_replace($from, $to, $string);
	*/
	return $path.rawurlencode($filename);
}


/**
 * Build a URL using new sorting settings.
 **/
function getNewSortURL($newSort) {
	GLOBAL $path;
	$base = $_SERVER["PHP_SELF"];
	$url = $base."?sort=$newSort";
	if ($newSort==$_GET["sort"]) {
		if ($_GET["order"]=="asc" OR $_GET["order"]=="") {
			$url.= "&amp;order=desc";
		}
	}
	if ($path!="") {
		$url.= "&amp;path=$path";
	}
	return $url;
}

/**
 * Determine a file's file type based on its extension.
 **/
function getFileType($fileInfo) {
	// put any additional extensions in here
	$extension = $fileInfo["type"];
	static $fileTypes = Array(
		"HTML"		=> Array("html","htm"),
		"image"		=> Array("gif","jpg","jpeg","png","tif","tiff","bmp","art"),
		"text"		=> Array("asp","c","cfg","cpp","css","csv","conf","cue","diz","h","inf","ini","java","js","log","nfo","php","phps","pl","py","rdf","rss","rtf","sql","txt","vbs","xml"),
		//"code"		=> Array("asp","c","cpp","h","java","js","php","phps","pl","py","sql","vbs"),
		//"xml"			=> Array("rdf","rss","xml"),
		"binary"	=> Array("asf","au","avi","bin","class","divx","doc","exe","mov","mpg","mpeg","mp3","ogg","ogm","pdf","ppt","ps","rm","swf","wmf","wmv","xls"),
		//"document"=> Array("doc","pdf","ppt","ps","rtf","xls"),
		"archive"	=> Array("ace","arc","bz2","cab","gz","lha","jar","rar","sit","tar","tbz2","tgz","z","zip","zoo")
	);
	static $extensions = null;

	if ($extensions==null) {
		$extensions = Array();
		foreach($fileTypes AS $keyType => $value) {
			foreach($value AS $ext) $extensions[$ext] = $keyType;
		}
	}

	if ($fileInfo["isDirectory"]) {
		if ($fileInfo["isBack"]) {
			return "dirup";
		} else {
			return "folder";
		}
	}
	
	$type = $extensions[strtolower($extension)];
	if ($type=="") {
		return "unknown";
	} else {
		return $type;
	}
}

function getIcon($fileType) {
	GLOBAL $useExternalImages, $externalIcons;
	if ($useExternalImages && $externalIcons[$fileType]!="") {
		return $externalIcons[$fileType];
	} else {
		return $_SERVER["PHP_SELF"]."?getimage=$fileType";
	}
}

function dirContainsHtAccess($dirname) {
	if(is_dir($dirname)) {
		if ($dirname=="." || $dirname=="..") return false;
		$d = dir($dirname);
		while($f = $d->read()) {
			if ($f==".htaccess")
				return true;
		}
	}
	return false;
}

// checks if a file is hidden from view
function fileIsHidden($filename) {
	GLOBAL $hiddenFilesWholeRegex,$protectDirsWithHtaccess;
	
	if (is_dir($filename) && $protectDirsWithHtaccess) {
		if (!($filename=="." || $filename=="..")) {
			$d = dir($filename);
			while($f = $d->read()) {
				if ($f==".htaccess")
					return true;
			}
		}
	}
	return preg_match($hiddenFilesWholeRegex,$filename);
}


function getVersion($filename) {
	$version = "&ndash;";
	$contents = file_get_contents($filename);
	$no_matches = preg_match("/Id: (\S+) (\d+.\d+)/i", $contents, $matches);
	if ($no_matches>0) $version = $matches[2];
	return $version;
}


/**
 * Gets a file's description from the description array.
 **/
function getDescription($filename) {
	GLOBAL $descriptions, $descriptionFilenamesCaseSensitive;
	
	if (!$descriptionFilenamesCaseSensitive) {
		$filename = strtolower($filename);
	}
	return $descriptions[$filename];
}

function getPageLink($startNumber, $linkText, $linkTitle="") {
	GLOBAL $snifServer, $path;
	$url = "http://".$snifServer.$_SERVER["PHP_SELF"]."?path=".$path."&sort=".$_GET["sort"]."&order=".$_GET["order"]."&start=".$startNumber;
	if ($linkTitle!="") {
		$titleAttribute = " title=\"$linkTitle\"";
	} else {
		$titleAttribute = "";
	}
	return "<a href=\"$url\"$titleAttribute>$linkText</a>&nbsp;";
}

function getPagingHeader() {
	GLOBAL $pageStart, $usePaging, $pagingNumberOfPages, $pagingActualPage, $pageNumber, $files;
	static $displayPages = Array();
	if (count($displayPages)==0) {
		$displayPages[] = 0;
		for ($i=$pagingActualPage-1; $i<$pagingActualPage+3; $i++) {
			if ($i>=0 && $i<$pagingNumberOfPages) {
				$displayPages[] = $i;
			}
		}
		$displayPages[] = $pagingNumberOfPages-1;
		$displayPages = array_unique($displayPages);
	}
	
	$header = translate("pages")."&nbsp;&nbsp;";
	if ($pageStart>0) {
		$header.= getPageLink($pageStart-$usePaging, "&laquo;", translate("previous"));
	}
	if ($pageStart+$usePaging<count($files)) {
		$header.= getPageLink($pageStart+$usePaging, "&raquo;", translate("next"));
	}
	foreach($displayPages as $i => $pageNumber) {
		if ($pageNumber-$displayPages[$i-1] > 1) {
			$header.= ".. ";
		}
		if ($pageNumber==$pagingActualPage) {
			$header.= "<span class=\"snWhite\">".($pageNumber+1)."&nbsp;</span>";
		} else {
			$header.= getPageLink($pageNumber*$usePaging, $pageNumber+1);
		}
	}
	
	return $header;
}

function getPathLink($directory) {
	GLOBAL $directDirectoryLinks;
	if ($directDirectoryLinks) {
		return $directory."/";
	} else {
		return $_SERVER["PHP_SELF"]."?path=".urlEncode($directory)."/";
	}
}

/**
 * Truncates a string to a certain length at the most sensible point.
 * First, if there's a '.' character near the end of the string, the string is truncated after this character.
 * If there is no '.', the string is truncated after the last ' ' character.
 * If the string is truncated, " ..." is appended.
 * If the string is already shorter than $length, it is returned unchanged.
 * 
 * @static
 * @param string    string A string to be truncated.
 * @param int        length the maximum length the string should be truncated to
 * @return string    the truncated string
 */
function iTrunc($string, $length) {
	if ($length==0) {
		return $string;
	}
	if (strlen($string)<=$length) {
		return $string;
	}
	
	$pos = strrpos($string,".");
	if ($pos>=$length-4) {
		$string = substr($string,0,$length-4);
		$pos = strrpos($string,".");
	}
	if ($pos>=$length*0.4) {
		return substr($string,0,$pos+1)."...";
	}
	
	$pos = strrpos($string," ");
	if ($pos>=$length-4) {
		$string = substr($string,0,$length-4);
		$pos = strrpos($string," ");
	}
	if ($pos>=$length*0.4) {
		return substr($string,0,$pos)."...";
	}
	
	return substr($string,0,$length-4)."...";
}


function getDirSize($dirname) {
	$dir = dir($dirname);
	$fileCount = 0;
	while ($filename = $dir->read()) {
		if (!fileIsHidden($dirname."/".$filename)) 
			$fileCount++;
	}
	return $fileCount-2; // . and .. do not count
}


/***************************************************************************/
/**  LIST BUILDING                                                        **/
/***************************************************************************/

// change directory
// must be done before description file is parsed
if ($path!="") {
	$hidden = fileIsHidden(substr($path,0,-1));
	if ($hidden || !@chdir($path)) {
		$displayError[] = sprintf(translate("%s is not a subdirectory of the current directory."), $path);
		$path = "";
	}
} 
$dir = dir(".");

// parsing description file
$descriptions = Array();
if ($useDescriptionsFrom!="") {
	$descriptionsFile = @file($useDescriptionsFrom);
	if ($descriptionsFile!==false) {
		for ($i=0;$i<count($descriptionsFile);$i++) {
			$d = explode($separationString,$descriptionsFile[$i]);
			if (!$descriptionFilenamesCaseSensitive) {
				$d[0] = strtolower($d[0]);
			}
			$descriptions[$d[0]] = htmlentities(join($separationString, array_slice($d, 1)));
		}
	}
}

// build a two dimensional array containing the files in the chosen directory and their meta data
$files = Array();
while($entry = $dir->read()) {
	// if the filename matches one of the hidden files wildcards, skip the file
	if (fileIsHidden($entry))
		continue;
		
	// if the file is a directory and if directories are forbidden, skip it
	if (!$allowSubDirs AND is_dir($entry))
		continue;
	
	$f = Array();

	$f["name"] = $entry;
	$f["isDownloadable"] = (substr(strtolower($entry), -4)!=".php") || $allowPHPDownloads;
	$f["isDirectory"] = is_dir($entry);
	$fDate = @filemtime($entry);
	$f["date"] = $fDate;
	$f["fullDate"] = date("r", $fDate);
	$f["shortDate"] = date(translate("DATEFORMAT"), $fDate);
	//setlocale(LC_ALL,"German");
	//$f["shortDate"] = strftime("%x");
	$f["description"] = getDescription($entry);
	if ($f["isDirectory"]) {
		$f["type"] = "&lt;DIR&gt;";
		$f["size"] = "";
		$f["niceSize"] = "";
		
		// building the link
		if ($entry=="..") {
			// strip the last directory from the path
			$pathArr = explode("/",$path);
			$link = implode("/",array_slice($pathArr,0,count($pathArr)-2));
			
			// if there is no path set, don't add it to the link
			if ($link=="") {
				// we're already in $baseDir, so skip the file
				if ($path=="")
					continue;
				$f["link"] = $_SERVER["PHP_SELF"];
			} else {
				$link.= "/";
				$f["link"] = $_SERVER["PHP_SELF"]."?path=".urlEncode($link);
			}
			$f["isBack"] = true;
			if ($useBackForDirUp) {
				$f["displayName"] = translate("[ back ]");
			}
		} else {
			$filesInDir = getDirSize($entry);
			if ($filesInDir==1) {
				$f["niceSize"] = translate("1 item");
			} else {
				$f["niceSize"] = sprintf(translate("%d items"),$filesInDir);
			}
			$f["link"] = getPathLink($path.$entry);
		}
	} else {
		if (is_link($entry)) {
			$linkTarget = readlink($entry);
			$pi = pathinfo($linkTarget);
			$scriptDir = dirname($_SERVER["SCRIPT_FILENAME"]);
			if (strpos($pi["dirname"], $scriptDir)===0) {
				$f["type"] = "&lt;LINK&gt;";
				// links have no date, so take the target's date
				$f["date"] = filemtime($linkTarget);
				$f["link"] = $path.urlencode(substr($linkTarget, strlen($scriptDir)+1));
			} else {
				// link target is outside of script directory, so skip it
				continue;
			}
		} else {
			$fSize = @filesize($entry);
			$f["size"] = $fSize;
			$f["fullSize"] = number_format($fSize,0,".",",");
			$f["niceSize"] = nicesize($fSize);
			$pi = pathinfo($entry);
			$f["type"] = $pi["extension"];
			$f["link"] = myEncode($path,$entry);
			if (in_array("cvsversion", $displayColumns)) {
				$f["cvsversion"] = getVersion($entry);
			}
		}
	}
	if (!$f["isBack"]) {
		$f["displayName"] = htmlentities(iTrunc($f["name"], $truncateLength));
	}
	$f["filetype"] = getFileType($f);
	$f["icon"] = getIcon($f["filetype"]);
	if ($useAutoThumbnails && $f["filetype"]=="image") {
		$f["thumbnail"] = "<a href=\"".urldecode($f["link"])."\"><img src=\"".$PHP_SELF."?thumbnail=".urlencode($path.$f["name"])."\" style=\"text-align: left;\" alt=\"\"/></a>";
	}

	$files[] = $f;
}

usort($files, "myCompare");


$pagingInEffect = $usePaging>0 && count($files)>$usePaging;
if ($usePaging>0) {
	$pageStart = $_GET["start"];
	if ($pageStart=="" || $pageStart<0 || $pageStart>count($files))
		$pageStart = 0;
	$pagingActualPage = floor($pageStart / $usePaging);
	$pagingNumberOfPages = ceil(count($files) / $usePaging);
} else {
	$pageStart = 0;
	$usePaging = count($files);
}
$pageEnd = min(count($files),$pageStart+$usePaging);



/***************************************************************************/
/**  HTML OUTPUT                                                          **/
/***************************************************************************/

$columns = count($displayColumns);

Header("Content-Type: text/html; charset=UTF-8");
echo "<?php xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>VirtualDisk - Unixlandia.com</title>
		<?php 
		if ($externalStylesheet!="") {
			?>
			<link rel="stylesheet" type="text/css" href="<?php echo $externalStylesheet?>" />
			<?php 
		}
		?>
		<style type="text/css">
		
			/*** COLORS ***/
			<?php 
			if ($externalStylesheet=="") {
			?>
			body.snif {
				background: #344556;             /* background behind table */
			}

			table.snif {
				border: 1px solid #444444;       /* main table border style */
			}
			table.snif2 {
				border: 1px solid Gray;       /* main table border style */
				background-color: #455667;       /* main table border style */
			}
			td.snDir {
				color: #ffffff;                  /* table header text color */
				background-color: #000000;       /* table header background color */
			}
			td.snDir a {
				color:white;                     /* link text color within table header */
			}
			tr.snHeading, td.snHeading, td.snHeading a {
				color: #dddddd;                  /* column headings text color */
				background-color: #444444;       /* column headings background color */
			}
			tr.snF td a {
				color: #000000;                  /* file listing link text color (filename)*/
			}
			tr.snF td a:hover, a.snif:hover {
				background-color: #bbbbee;       /* file listing link hover background color */
			}
			tr.snEven {
				background-color: #eeeeee;       /* file listing background color for even numbered rows */
			}
			tr.snOdd {
				background-color: #dddddd;       /* file listing background color for odd numbered rows */
			}
			tr.snF td {
				color: #444444;                  /* file listing text color */
			}
			.snCopyright * {
				color: #bbbbbb;                  /* copyright notice text color */
			}
			.snWhite {
				color: white;                    /* active page in paging header */
			}
			<?php 
			}
			?>
			
			/*** FONTS ***/
			.snif * {
				font-family: Tahoma, Sans-Serif;
				font-size: 10pt;
			}
			.snif a, a.snif {
				text-decoration: none;
			}
			.snif a:hover, a.snif:hover {
				text-decoration: underline;
			}
			.snCopyright * {
				font-size: 8pt;
			}
			.snifSmaller {
				font-weight: normal;
				font-size: 8pt;
			}
			td.snDir {
				font-weight: bold;
			}
			tr.snHeading, td.snHeading, td.snHeading a {
				font-weight: bold;
			}
			
			
			/*** MARGINS AND POSITIONS ***/
			table.snif {
				<?php 
				if ($tableWidth100Percent) {
					echo "width:100%;";
				}
				?>
			}
			table.snif td {
				padding-left: 10px;
				padding-right: 10px;
			}
			table.snif td.littlepadding {
				padding-left: 4px;
				padding-right: 0px;
			}
			td.snDir {
				padding-top: 3px;
				padding-bottom: 3px;
			}
			tr.snHeading, td.snHeading, td.snHeading a {
				padding-top: 3px;
				padding-bottom: 3px;
			}
			tr.snF td {
				padding-top: 2px;
				padding-bottom: 2px;
				vertical-align: top;
				padding-left: 10px;
				padding-right: 10px;
				white-space: nowrap;
			}
			.snif img {
				border:none;
			}
			.snW {
				white-space: normal;
			}
		</style>

		<link   href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css"       rel="stylesheet" type="text/css">
		<link   href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
		<link   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"         rel="stylesheet" type="text/css">

		<style type="text/css">
			html,body{background:#272727}.navbar-xs{min-height:27px;height:27px;font-size:13px}.navbar-xs .navbar-brand{padding:0 12px;font-size:15px;line-height:27px}.navbar-xs .navbar-nav>li>a{padding-top:0;padding-bottom:0;line-height:27px}.navbar-xs .navbar-nav>li>ul>li{font-size:13px}.navbar-xs .navbar-nav>li>ul{background:darkgray}.navbar-nav>li>a,.navbar-brand{padding-top:0 !important;padding-bottom:0 !important;height:27px}.navbar{min-height:27px !important}.tooltip-inner{max-width:none;white-space:nowrap;font-size:10px}::-webkit-scrollbar{width:10px;height:10px}::-webkit-scrollbar-button:start:decrement,::-webkit-scrollbar-button:end:increment{display:none}::-webkit-scrollbar-track-piece{background-color:#3b3b3b;-webkit-border-radius:6px}::-webkit-scrollbar-thumb:vertical{-webkit-border-radius:6px;background:#666 no-repeat center}::-webkit-scrollbar-thumb:horizontal{-webkit-border-radius:6px;background:#666 no-repeat center}::-webkit-scrollbar-corner{display:none}::-webkit-resizer{display:none}
		</style>



		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	</head>
<body oncontextmenu="return false;">






<!-- ################# INICIO DE LA MAQUETACION ################ -->


		<div class="row">
			<div class="col-md-12">

				<div id="panel_superior" >
					
					<nav class="navbar navbar-default navbar-inverse navbar-xs" style="margin:0px; padding:0px;"> <!-- navbar-fixed-top navbar-fixed-bottom navbar-static-top navbar-inverse -->
						<div class="container-fluid">
							<!-- Logo y boton colapsable -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra_menu_superior" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
								<div class="navbar-brand text-primary"><b><i class="text-primary"><i class="fa fa-search text-primary">&nbsp;&nbsp;</i>Practico File Explorer</i></b></div>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="barra_menu_superior">
								<ul class="nav navbar-nav">

									<!-- MENU DE PAGINAS -->
									<li class="dropdown">
										<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Archivo <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<!--<li role="separator" class="divider"></li>-->
											<li><a style="cursor:pointer;" OnClick="self.close();"><i class="fa fa-sign-out fa-fw"></i> Cerrar</a></li>
										</ul>
									</li>

									<!-- BOTONES INDEPENDIENTES
									<li><a style="cursor:pointer;" OnClick="EstadoPausa=1;" data-toggle="tooltip" data-placement="bottom" title="Pausa en esta ventana / Pause this window"><i class="fa fa-pause fa-fw text-danger "></i> <?php echo $MULTILANG_Pausar; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="document.formulario_monitoreo.Pagina.value='<?php echo $PaginaMonitoreo; ?>'; document.formulario_monitoreo.PaginaRecuerrente.value='<?php echo $PaginaMonitoreo; ?>';" data-toggle="tooltip" data-placement="bottom" title="Permanecer y actualizar solo esta pagina / Stay and upgrade only this page"><i class="fa fa-refresh fa-fw text-warning "></i> <?php echo $MULTILANG_Recurrente; ?></a></li>
									<li><a style="cursor:pointer;" OnClick="document.formulario_monitoreo.Pagina.value=(document.formulario_monitoreo.Pagina.value)*1-1; EstadoPausa=0; document.formulario_monitoreo.PaginaRecuerrente.value=''; actualizar();" data-toggle="tooltip" data-placement="bottom" title="Continuar monitoreo / Resume monitoring"><i class="fa fa-play fa-fw text-success"></i> <?php echo $MULTILANG_Continuar; ?></a></li>
									<li><a data-toggle="tooltip" data-placement="bottom" title="Tiempo antes de saltar / Time before jump"><i class="fa fa-clock-o fa-fw text-info"></i> <div id="MarcoCronometro" style="display: inline!important;">0s</div></a></li>
									-->
								</ul>

								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown">
										<a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question-circle text-info"></i> <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a style="cursor:pointer;"><i class="fa fa-info fa-fw"></i> Acerca de</a></li>
										</ul>
									</li>
								</ul>

							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>

				</div><!-- /.contenedor -->

			</div>
		</div>




		<DIV class="row">
			<div class="col-md-12" style="margin:0px;">

				<!-- INICIA LA TABLA PRINCIPAL -->
				<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:white;">
					<tr>
						<td align="right">
							<!-- NOTA COPYRIGHT	 -->
							<font color="#CACACA" size=1><i><?php echo $MULTILANG_MonAcerca; ?></i>&nbsp;&nbsp;<br><br></font>
						</td>
					</tr>
					<tr>
						<td width="100%" height="100%" valign="TOP" align="center">



				<!-- FINALIZA LA TABLA PRINCIPAL -->
				</td></tr></table>

			</div>
		</DIV>
	<!-- ################## FIN DE LA MAQUETACION ################## -->










<div class="snif">


<?php 
if (count($displayError)>0) {
	foreach($displayError AS $error) {
		echo "<b style=\"color:red\">$error</b><br/>";
	}
	echo "<br/>";
}
?>
<table cellpadding="0" cellspacing="0" class="snif">
	<tr>
		<td class="snDir" colspan="<?php echo count($displayColumns)?>">
			<?php 
			$baseDirname = $snifServer.htmlentities(dirname($_SERVER["PHP_SELF"]));
			$pathToSnif = explode("/",$baseDirname);
			//echo "http://".join("/",array_slice($pathToSnif, 0, -1))."/";
			echo "<a href=\"".dirname($_SERVER["PHP_SELF"])."/\">".join("/",array_slice($pathToSnif, -1))."</a>";
			$pathArr = explode("/",$path);
			for ($i=0; $i<count($pathArr)-1; $i++) {
				$dirLink = getPathLink(join("/",array_slice($pathArr, 0, $i+1)));
				echo "/<a href=\"$dirLink\">".htmlentities($pathArr[$i])."</a>";
			}
			?><br/>
			<span class="snifSmaller"><?php echo $descriptions["."];?></span>
		</td>
	</tr>
	<?php 
	if ($pagingInEffect) {
	?>
	<tr class="snHeading">
		<td class="snHeading" colspan="<?php echo count($displayColumns)?>">
			<?php 
			echo getPagingHeader();
			?>
		</td>
	</tr>
<?php 
	}
?>
	<tr class="snHeading">
		<?php 
		foreach($displayColumns AS $column) {
			switch ($column) {
				case "download":
					?>
					<td class="snHeading littlepadding">&nbsp;</td>
					<?php 
					break;
				case "icon":
					?>
					<td class="snHeading littlepadding">&nbsp;</td>
					<?php 
					break;
				case "name":
					?>
					<td class="snHeading">
						<!--<img src="<?php echo $PHP_SELF?>?getimage=blank" alt="" width="30" height="16" style="vertical-align:middle;"/>--><a href="<?php echo getNewSortURL("name");?>"><?php echo translate("name");?></a>
						<?php 
						$sort = $_GET["sort"];
						if ($sort=="name")
							echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".translate($_GET["order"])."\"/>";
						?>
					</td>
					<?php 
					break;
				case "type":
					?>
					<td class="snHeading">
						<a href="<?php echo getNewSortURL("type");?>"><?php echo translate("type");?></a>
						<?php 
						if ($sort=="type")
							echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".translate($_GET["order"])."\"/>";
						?>
					</td>
					<?php 
					break;
				case "size":
					?>
					<td class="snHeading" align="right">
						<?php 
						if ($sort=="size")
							echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".translate($_GET["order"])."\"/>";
						?>
						<a href="<?php echo getNewSortURL("size");?>"><?php echo translate("size");?></a>
					</td>
					<?php 
					break;
				case "date":
					?>
					<td class="snHeading">
						<a href="<?php echo getNewSortURL("date");?>"><?php echo translate("date");?></a>
						<?php 
						if ($sort=="date")
							echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:20%;\" alt=\"".translate($_GET["order"])."\"/>";
						?>
					</td>
					<?php 
					break;
				case "description":
					?>
					<td class="snHeading"<?php if ($descriptionColumnWidth>0) echo " style=\"width:".$descriptionColumnWidth."px;\"";?>><?php echo translate("description");?></td>
					<?php 
					break;
				case "cvsversion":
					?>
					<td class="snHeading"><?php echo translate("CVS");?></td>
					<?php 
					break;
			}
		}
		?>
	</tr>
	<?php 
	for ($i=$pageStart;$i<$pageEnd;$i++) {
	?>
	<tr class="snF <?php echo ($i%2==0) ? "snEven" : "snOdd"?>">
		<?php 
		foreach($displayColumns AS $column) {
			switch ($column) {
				case "download":
					echo "<td class=\"littlepadding\">";
					if ($files[$i]["isDirectory"] OR !$files[$i]["isDownloadable"]) {
					?>
						<img src="<?php echo $PHP_SELF?>?getimage=blank" alt="" width="7" height="16" style="vertical-align:middle;"/>
					<?php 
					} else {
					?>
						<a href="<?php echo $PHP_SELF?>?path=<?php echo rawurlencode($path)?>&amp;download=<?php echo rawurlencode($files[$i]["name"]);?>"><img src="<?php echo getIcon("download")?>" alt="<?php echo translate("download");?>" title="<?php echo translate("download");?>" width="7" height="16" style="vertical-align:middle;"/></a>
					<?php 
					}
					echo "</td>";
					break;
				case "icon":
					echo "<td class=\"littlepadding\">";
					?>
					<a href="<?php echo $files[$i]["link"];?>" title="<?php echo htmlentities($files[$i]["name"]);?>"><img src="<?php echo $files[$i]["icon"]?>" alt="" title="<?php echo translate($files[$i]["filetype"])?>" width="16" height="16" style="vertical-align:middle;"/></a>
					<?php 
					echo "</td>";
					break;
				case "name":
					echo "<td>";
					?><a href="<?php echo $files[$i]["link"];?>" title="<?php echo htmlentities($files[$i]["name"]);?>"><?php 
					echo $files[$i]["displayName"]."&nbsp;</a>";
					echo "</td>";
					break;
				
				case "type":
					echo "<td>";
					echo $files[$i]["type"];
					echo "</td>";
					break;
				
				case "size":
					echo "<td align=\"right\">";
					if ($files[$i]["fullSize"]!="") echo "	<span title=\"".$files[$i]["fullSize"]." ".translate("Bytes")."\">";
					echo $files[$i]["niceSize"];
					if ($files[$i]["fullSize"]!="") echo "  </span>";
					echo "</td>";
					break;
				
				case "date":
					echo "<td>";
					echo "<span title=\"".$files[$i]["fullDate"]."\">".$files[$i]["shortDate"]."</span>";
					echo "</td>";
					break;
				
				case "description":
					?><td class="snW" style="white-space: normal;">
					<?php 
					if ($files[$i]["filetype"]=="image") {
						echo $files[$i]["thumbnail"];
					}
					?>
					<?php echo $files[$i]["description"];?>
					</td><?php 
					break;
				
				case "cvsversion":
					echo "<td>";
					echo $files[$i]["cvsversion"];
					echo "</td>";
					break;
			}
		}
		?>
	</tr><?php 
	}
	if ($pagingInEffect) {
	?>
	<tr class="snHeading">
		<td class="snHeading" colspan="<?php echo $columns?>">
			<?php 
			echo getPagingHeader();
			?>
		</td>
	</tr>
<?php 
	}
?>
</table>
</div>





	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
