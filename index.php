<!doctype html>
<html lang="en">
  <head>
    <title>Empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body >
    
    
      <center><h2>Formulario Productos</h2></center>
      <div class="container">
          <form class="d-flex" action="crud_productos.php" method="post">

            <div class="col">
            <div class="mb-3">
                <label for="lbl_id" class="form-label"><b>ID</b></label>
                <input type="text" name="txt_id" id="txt_id" class="form-control" value="0"  readonly>
              </div>

              <div class="mb-3">
                <label for="lbl_producto" class="form-label"><b>Producto</b></label>
                <input type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="Producto: P001" required>
              </div>

                         
              <div class="mb-3">
                <label for="lbl_marca" class="form-label"><b>Marca</b></label>
                <select class="form-select" name="drop_marca" id="drop_marca">
                  <option value=0> ---- Marca ---- </option>
                  <?php 
                   include("conexion_bd.php");
                   $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                   $db_conexion -> real_query ("SELECT id_marca as id,marca FROM marcas;");
                  $resultado = $db_conexion -> use_result();
                  while ($fila = $resultado ->fetch_assoc()){
                    echo "<option value=". $fila['id'].">". $fila['marca']."</option>";

                  }
                  $db_conexion ->close();

                  ?>
                  
                </select>
              </div>   

              <div class="mb-3">
                <label for="lbl_descripcion" class="form-label"><b>Descripcion</b></label>
                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" placeholder="Descripcion: Patito" required>
              </div>

              <div class="mb-3">
                <label for="lbl_precio_costo" class="form-label"><b>Precio Costo</b></label>
                <input type="number" step="0.01" name="txt_precio_costo" id="txt_precio_costo" class="form-control" placeholder="Costo: 50.50 " required>
              </div>

              <div class="mb-3">
                <label for="lbl_precio_venta" class="form-label"><b>Precio Venta</b></label>
                <input type="number" step="0.01" name="txt_precio_venta" id="txt_precio_venta" class="form-control" placeholder="Venta: 74.99" required>
              </div>

              <div class="mb-3">
                <label for="lbl_existencia" class="form-label"><b>Existencia</b></label>
                <input type="text" name="txt_existencia" id="txt_existencia" class="form-control" placeholder="Existencia: 111111 " required>
              </div>

                  
              <div class="mb-3">
                <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value = "Agregar">
                <input type="submit" name="btn_modificar" id="btn_modificar" class="btn btn-success" value = "Modificar">
                <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" onclick="javascript:if(!confirm('¿Desea Eliminar?'))return false" value = "Eliminar">
              </div>
              
            </div>

          </form>
    <table class="table table-hover   table-responsive">
      <thead class="thead-inverse">
        <tr>
          <th>Producto</th>
          <th>Marca</th>
          <th>Descripcion</th>
          <th>Precio costo</th>
          <th>Precio venta</th>
          <th>Existencia</th>
        </tr>
        </thead>
        <tbody id="tbl_empleados">

         <?php 
         include("conexion_bd.php");
         $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
         $db_conexion -> real_query ("SELECT e.id_producto as id,e.producto,e.descripcion,e.precio_costo,e.precio_venta,p.marca,e.existencia,p.id_marca FROM productos as e inner join marcas as p on e.id_marca = p.id_marca;");
        $resultado = $db_conexion -> use_result();
        while ($fila = $resultado ->fetch_assoc()){
          echo "<tr data-id=". $fila['id']." data-idp=". $fila['id_marca'].">";
          echo "<td>". $fila['producto']."</td>";
          echo "<td>". $fila['marca']."</td>";
          echo "<td>". $fila['descripcion']."</td>";
          echo "<td>". $fila['precio_costo']."</td>";
          echo "<td>". $fila['precio_venta']."</td>";
          echo "<td>". $fila['existencia']."</td>";
          echo "</tr>";

        }
        $db_conexion ->close();
         ?>
        </tbody>
    </table>
          
      </div>
      
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript">
    function limpiar(){
        $("#txt_id").val(0);
        $("#txt_producto").val('');
        $("#drop_marca").val(1);
        $("#txt_descripcion").val('');
        $("#txt_precio_costo").val('');
        $("#txt_precio_venta").val('');
        $("#txt_existencia").val('');
    
        
    }
    $('#tbl_empleados').on('click','tr td',function(evt){
        var target,id,idp,producto,descripcion,precio_costo,precio_venta,existencia;
        target = $(event.target);
        id = target.parent().data('id');
        idp = target.parent().data('idp');
        producto = target.parent("tr").find("td").eq(0).html();
        descripcion =  target.parent("tr").find("td").eq(2).html();
        precio_costo = target.parent("tr").find("td").eq(3).html();
        precio_venta = target.parent("tr").find("td").eq(4).html();
        existencia  = target.parent("tr").find("td").eq(5).html();
        $("#txt_id").val(id);
        $("#txt_producto").val(producto);
        $("#drop_marca").val(idp);
        $("#txt_descripcion").val(descripcion);
        $("#txt_precio_costo").val(precio_costo);
        $("#txt_precio_venta").val(precio_venta);
        $("#txt_existencia").val(existencia);
        $("#modal_productos").modal('show');
        
    });
</script>
  </body>
</html>