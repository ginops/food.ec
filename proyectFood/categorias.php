<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
         <meta charset="utf-8">
  <title>Categories | food.ec</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  
 <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="css/codiqa.ext.min.css" rel="stylesheet">
  <link href="css/jquery.mobile.theme-1.3.1.min.css" rel="stylesheet">
  <link href="css/jquery-mobile.css" rel="stylesheet">
  <link href="css/jquery.mobile.structure-1.3.1.min.css" rel="stylesheet">

  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="js/jquery.mobile-1.3.1.min.js"></script>
  <script src="js/codiqa.ext.min.js"></script>
  <script src="js/food.ec.js"></script>
    </head>
    <body>
        <div data-role="page" data-control-title="categorias" id="page3">
      <div data-theme="b" data-role="header">
          <h3>
              Categories
          </h3>
      </div>
      <div data-role="content">
              <?php
        if(!($iden = mysql_connect("localhost", "root", ""))) 
        {   die("Error: No se pudo conectar");
        }
  // Selecciona la base de datos 
        if(!mysql_select_db("youneedisfood", $iden)) 
        {   die("Error: No existe la base de datos");
        }
        mysql_query("SET NAMES'utf8'");
         $sentencia = "SELECT nombre,foto,idcategoria FROM Categoria "; 
         
  // Ejecuta la sentencia SQL 
         $resultado = mysql_query($sentencia, $iden); 
         
        if(!$resultado){ 
            die("Error: no se pudo realizar la consulta");
        }
        echo '<div data-role="collapsible-set" data-theme="c" data-content-theme="e">'; 
         while($fila = mysql_fetch_assoc($resultado)) 
    { 
        echo '<div data-role="collapsible" data-collapsed="false">'; 
        echo '<h3>' . $fila['nombre'] . '</h3>';
        echo ' <div style="width: 100%; height: 200px; position: relative; background-color: #fbfbfb; border: 1px solid #b8b8b8;"
                data-controltype="image"><img src="img/'.$fila['foto'].'" class="img-responsive" >
                </div>';

        $sentencia2= "SELECT r.idRestaurantes, r.Nombre,r.Latitud,r.Longitud FROM restaurantes r WHERE r.idcategoria =".$fila['idcategoria']."";        
        $resultado2 = mysql_query($sentencia2,$iden);
        
        if(!$resultado2){
            die("Error");
        }
        while($f = mysql_fetch_assoc($resultado2))
                {
        echo ' <a data-role="button" href="page4.php?&id='.$f['idRestaurantes'].'">'.$f['Nombre'].'</a>';
            
        }
        echo '</div>'; 
    } 
        echo '</div>';
        mysql_free_result($resultado);
  
  // Cierra la conexión con la base de datos 
  mysql_close($iden); 
          
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
