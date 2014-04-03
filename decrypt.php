<?php
error_reporting(7);

function aes128Decrypt($key, $data) {
    if(16 !== strlen($key)) $key = hash('MD5', $key, true);
    $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
    $padding = ord($data[strlen($data) - 1]); 
    return substr($data, 0, -$padding); 
}

$source_hash = $_GET['hash'];
$source_key = $_GET['key'];

?>

<!DOCTYPE html>                                                                                                                                  
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="netsec2014 project1">
    <meta name="author" content="pichuang@cs.nctu.edu.tw">
 
    <title>NETSEC2014 Project1</title>
 
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/demo_table.css" rel="stylesheet">
 
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
 
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">NETSEC2014</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  <div class="container"> 
    <div class="starter-template">
        <form action="decrypt.php" method="GET">
          <input type="hidden" name="hash" value="<?php echo $source_hash;?>">
          Enter your key: <input type="text" name="key"><br>
          <input type="submit" value="POST">
        </form>
    </div>
    <div class="page-header">
        <h1>Answer</h1>
    </div>
    <div class="well">
        <div>
<?php
if(!empty($source_hash && $source_hash != "0")){
    $binbin = hex2bin($source_hash); 
    $answer = aes128Decrypt($source_key, $binbin); //if null, return "0"
    printf($answer);
}
?>
        </div>
    </div>
  </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
  </body>
</html>
