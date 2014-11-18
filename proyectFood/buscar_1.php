<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

  <title>Results | food.ec</title>
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
              Results
          </h3>
      </div>
      <div data-role="content">
        <?php 
if (!isset($_GET['name'])){ 
      echo "Debe especificar una cadena a bucar"; 
      echo "</html></body> \n"; 
      exit; 
} 
$name = $_GET['name'];
$db = mysql_connect("localhost", "root",""); 
$mydb = mysql_select_db("youneedisfood");
mysql_query("SET NAMES 'utf8'");
$sql = "SELECT * FROM restaurantes WHERE Nombre like '%". $name ."%' OR tag like '%".$name."%'";
$sql2 ="SELECT foto FROM platos WHERE nombre like '%".$name."%'";
$result2 = mysql_query($sql2);
                              
$result = mysql_query($sql); 
$row2 = mysql_fetch_array($result2 );
if ($row = mysql_fetch_array($result)){ 
      echo '<table class="table table-hover table-bordered table-responsive"> '; 
//Mostramos los nombres de las tablas 
      echo '<img src ="img/'.$row2["foto"].'" class="img-responsive">';
do { 
            echo "<tr> "; 
            echo '<td><img src ="img/'.$row["Logo"].'" class="img-responsive"> </td> '; 
            echo "<td><b>".$row["Nombre"]."</b><br> Address: ".$row["Direccion"]."</td> "; 
            echo '<td><a data-role="button" href="page4.php?&id='.$row['idRestaurantes'].'">Go</a></td> '; 
            echo "</tr> "; 
      } while ($row = mysql_fetch_array($result)); 
            echo "</table> "; 
} else { 
echo "¡ No se ha encontrado ningún registro !"; 
} 
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
