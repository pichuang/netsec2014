<?php
error_reporting(7);
?>
<!DOCTYPE html>
<html lang="en">
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
          <a class="navbar-brand" href="#">NETSEC2014</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <form action="encrypt.php" method="POST">
          <textarea name="content" cols="50" rows="10"></textarea><br>
          Enter your key: <input type="text" name="key"><br>
          <input type="submit" value="POST">
        </form>
      </div>
      <div class="table-responsive">
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="netsec2014_data" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Hash</th>
                <th>DECRYPT ME</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Hash</th>
                <th>DECRYPT ME</th>
            </tr>
        </tfoot>
        <tbody>
<?php
    require_once("query.php");
?>
        </tbody>
      </table>
    
      </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $().ready(function(){
            //Datatable Config
            $('#netsec2014_data').dataTable({
                "bJQueryUI": true,
                "iDisplayLength": 20,
                "aLengthMenu": [[25, 50, -1], [25, 50, "All"]],
                "bProcessing": true,
            });

    </script>
  </body>
</html>
