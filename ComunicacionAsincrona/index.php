


<!DOCTYPE html>
<html>
 <head>
  <title>POKEDEX</title>

     
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="functions.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">POKEDEX</h2>
    <div class="col-md-4">
        
        <input type="text" id="textId" placeholder="ID"/> 
        <input type="text" id="textName" placeholder="Nombre"/> 
        </br>
        <button id="loadJson"/> Cargar JSON </button>
     <button type="button" name="mostrar" id="mostrar" class="btn btn-info">Mostrar</button>
    <div id="selected_pokemon">
        <table class="table-bordered" id="table-bordered" style="width:200px;">
    
  
   </table>
   </div>
   </div>
   <br />

   
     
   
 </body>
</html>


