<?php


$ip = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
$lastlogin = file_get_contents('lastlogin.encrypt');
if($ip == $lastlogin){
    

$path_header = "index.php";
include('../config.php');
$path_data = "../$database_path";    
$blacklist = $_GET['id'];

file_put_contents(
$path_data,
implode(
"",
array_map(function ($data) {
global $blacklist;
return stristr($data, "$blacklist")
? ''
: $data;
}, file($path_data))
)
);
$string = file_get_contents($path_data);
$stringgg = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);

file_put_contents($path_data,$stringgg);


$string = file_get_contents($path_data);
$stringgg = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);

file_put_contents($path_data,$stringgg);



//unlink("../database/image/$blacklist.png");

$blacklist = filter_input(INPUT_GET, 'blacklist', FILTER_SANITIZE_STRING);

// Whitelist the allowed characters in the filename
$blacklist = preg_replace('/[^a-zA-Z0-9\.]/', '', $blacklist);

// Concatenate the fixed path and filename
$file = "../database/image/" . $blacklist . ".png";

// Check if the file exists before trying to delete it
if (file_exists($file)) {
    unlink($file);
}

}
else{
    $path_header = "login.php";
}

header("Location: ./$path_header");

?>