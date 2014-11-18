<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
  <title>Home | food.ec</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <link href="css/codiqa.ext.min.css" rel="stylesheet">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/jquery.mobile.theme-1.3.1.min.css" rel="stylesheet">
  <link href="css/jquery-mobile.css" rel="stylesheet">
  <link href="css/jquery.mobile.structure-1.3.1.min.css" rel="stylesheet">

  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="js/jquery.mobile-1.3.1.min.js"></script>
  <script src="js/codiqa.ext.min.js"></script>
  <script src="js/food.ec.js"></script>
  
  <link href="css/jquery.bxslider.css" rel="stylesheet" />
  <script src="js/jquery.bxslider.min.js"></script>
   
        
  
        
    </head>
    <body>
        
  <div data-role="page" data-control-title="Home" id="page1">
     <!-- <div data-theme="b" data-role="header">
           <h2>
                    Food.ec
          </h2>
      
      </div>
     -->
      <div data-role="content">
          <img src="img/logo_big.png" class="img-responsive" alt=""/>
          <header class="jumbotron">
                <h3>
              Search some food:
          </h3>
          
              <form method="GET" action="buscar_1.php">
          <div data-role="fieldcontain" data-controltype="searchinput">
              <input name="name" id="searchinput2" placeholder="Write a dish or a category "value="" type="text"/>
          </div>
              <input type="submit" data-theme="c" data-icon="search" data-iconpos="left" value="Search" name="submit"/>
          
          </form>
            </header>
          
          
           
          
          
          
          
          
          
          
          
          
          
          <h2>
              Recomendations:
          </h2>
          <?php
        if(!($iden = mysql_connect("localhost", "root", ""))) 
        {   die("Error: No se pudo conectar");
        }
  // Selecciona la base de datos 
        if(!mysql_select_db("youneedisfood", $iden)) 
        {   die("Error: No existe la base de datos");
        }
  // Sentencia SQL: muestra todo el contenido de la tabla "books" 
  mysql_query("SET NAMES'utf8'"); 
        $sentencia = "SELECT * FROM restaurantes WHERE Rating = 5 LIMIT 6 "; 
  // Ejecuta la sentencia SQL 
         $resultado = mysql_query($sentencia, $iden); 
        if(!$resultado){ 
            die("Error: no se pudo realizar la consulta");
        }
        echo '<table class="table table-hover table-bordered table-responsive">'; 
         while($fila = mysql_fetch_assoc($resultado)) 
    { 
        echo '<tr>'; 
        echo '<td> <img src= "img/'.$fila['Logo'].'" class="img-responsive"> </td>'
                . '<td><b>' .$fila['Nombre'].'</b><br>Address:'. $fila['Direccion'] . '</td><td>
          <form action="page4.php" method="get">
              
              <a data-role="button" href="page4.php?id='.$fila['idRestaurantes'].'">GO</a>
              
          </form>  </td>'; 
        echo '</tr>'; 
    } 
        echo '</table>';
  
  // Libera la memoria del resultado
  mysql_free_result($resultado);
  
  // Cierra la conexión con la base de datos 
  mysql_close($iden); 
        // put your code here
        ?>

      </div>
      <div data-role="tabbar" data-iconpos="top" data-theme="e">
          <ul>
              <li>
                  <a href="index.php" data-transition="fade" data-theme="" data-icon="search">
                      Search
                  </a>
              </li>
              <li>
                  <a href="categorias.php" data-transition="fade" data-theme="" data-icon="bars">
                      Categories
                  </a>
              </li>
              <li>
                  <a href="cerca.php" data-transition="fade" data-theme="" data-icon="star">
                      Next to me
                  </a>
              </li>
          </ul>
      </div>
  </div>
        
          
        
        
    </body>
</html>
