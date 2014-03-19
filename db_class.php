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

function aes128Encrypt($key, $data) {
    if(16 !== strlen($key)) $key = hash('MD5', $key, true);
    $padding = 16 - (strlen($data) % 16);
    $data .= str_repeat(chr($padding), $padding);
    return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
}

/*
    Variable
*/
//BUG: Maybe NOT STORE
$source_key = $_POST['key'];
$source_content = $_POST['content'];


#printf("%s _ %s", $source_key, $source_content);
/*
    plaintext or ciphertext 
*/
if(!empty($source_content) && empty($source_key)){
    printf("plaintext");
    $sql = "INSERT INTO `hash_table`(`hash`) VALUES (?)";
    $stmt = $mysqli->stmt_init();
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $source_content);
}
elseif(!empty($source_content) && !empty($source_key)){
    printf("ciphertext");
    $cipher_content = bin2hex(aes128Encrypt($source_key, $source_content));
    $sql = "INSERT INTO `hash_table`(`hash`, `hash_key`) VALUES (?, ?)";
    $stmt = $mysqli->stmt_init();
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $cipher_content, $source_key);
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
    $mysqli -> close();
    header("Location:index.php");
}
catch (Exception $e){
    throw $e;
    $mysqli -> close();
    exit();
}
