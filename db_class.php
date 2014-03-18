<?php
error_reporting(7);
require_once("dbconn.php");
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

/*
    Check mysql server connection
*/
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


/*
    Variable
*/
$source_content = $_POST['content'];
$source_key = $_POST['key'];


/*
    plaintext or ciphertext 
*/
if(!empty($source_content) && empty($source_key)){
    /*plaintext*/
    $sql = "INSERT INTO `hash_table`(`hash`) VALUES (?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $source_content);
}
elseif(!empty($source_content) && !empty($source_key)){
    /*ciphertext*/
    $sql = "INSERT INTO `hash_table`(`hash`, `key`) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $source_content, $source_key);
}
else{
    printf("Please type something");
    exit();
}

/*
    Protect
*/
try{
    $stmt -> execute();
}
catch (Exception $e){
    throw $e;
    $mysqli -> close();
    exit();
}
