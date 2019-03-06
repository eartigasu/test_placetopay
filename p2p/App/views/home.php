<?php

use \Core\App;


 $config = App::getConfig();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Test PlaceToPay</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="/p2p/public/placetopay/index">Realizar Pago</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Test Ingeniero De Desarrollo</h1>
        <p>Template en bootstrap para la parte visual del test (Pago y Listado).</p>
        <h6>Desarrollado por Emilio Artigas</h6>
      </div>
      
      <div class="page-header">
        <h1>Registro Intentos de Pago</h1>
      </div>


      <div class="row">
        <div class="col-md-12 col-sm-4">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Status</th>
                <th>Reason</th>
                <th>Message</th>
                <th>Date</th>
                <th>RequestId</th>
                <th>ProcessUrl</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $cont = 1;
            	foreach($payments as $pay){
                if($pay["status"] == "FAILED"){
                  $class = "danger";
                }elseif ($pay["status"] == "OK") {
                  $class = "success";
                }else{
                  $class = "warning";
                }
                ?>
                <tr>
                  <td><?php echo $cont ?></td>
                  <td><h4><span class="label label-<?php echo $class ?>"><?php echo $pay["status"] ?></span></h4></td>
                  <td><?php echo $pay["reason"] ?></td>
                  <td><?php echo $pay["message"] ?></td>
                  <td><?php echo $pay["date"] ?></td>
                  <td><?php echo $pay["requestId"] ?></td>
                  <td><?php echo $pay["processUrl"] ?></td>
                </tr>

                <?php
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>        
      


    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

