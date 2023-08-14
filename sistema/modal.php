<?php
include("../conexion.php");
session_start();
//print_r($_POST);
if (!empty($_POST)) {

// Extraer datos del producto
if ($_POST['action'] == 'infoProducto') {
    $data = "";
  $producto_id = $_POST['producto'];
  $query = mysqli_query($conectar, "SELECT idproducto as codproducto, descripcion, precioventa as precio, stock as existencia FROM productos WHERE idproducto = $producto_id");

  $result = mysqli_num_rows($query);
  if ($result > 0) {
    $data = mysqli_fetch_assoc($query);
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    exit;
  }else {
    $data = 0;
  }
}

// Buscar Cliente
if ($_POST['action'] == 'searchCliente') {
  if (!empty($_POST['cliente'])) {
    $id_cliente = $_POST['cliente'];

    $query = mysqli_query($conectar, "SELECT * FROM clientes WHERE idcliente = '$id_cliente'");
    mysqli_close($conectar);
    $result = mysqli_num_rows($query);
    $data = '';
    if ($result > 0) {
      $data = mysqli_fetch_assoc($query);
    }else {
      $data = 0;
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

// registrar cliente = ventas
if ($_POST['action'] == 'addCliente') {
  $idcliente = $_POST['dni_cliente'];
  $nombre = $_POST['nom_cliente'];
  $direccion = $_POST['tel_cliente'];
  $telefono = $_POST['dir_cliente'];
  $email = $_POST['email_cliente'];

  $query_insert = mysqli_query($conectar, "INSERT INTO clientes(idcliente, nombre, direccion, telefono, email) VALUES ('$idcliente','$nombre','$direccion','$telefono','$email')");
  if ($query_insert) {
    $codCliente = mysqli_insert_id($conectar);
    $msg = $codCliente;
  }else {
    $msg = 'error';
  }
  mysqli_close($conectar);
  echo $msg;
  exit;
}

// agregar producto a detalle temporal
if ($_POST['action'] == 'addProductoDetalle') {
  if (empty($_POST['producto']) || empty($_POST['cantidad'])){

    echo 'error';
  }else {
    $codproducto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $token = md5($_SESSION['idUser']);
    $query_iva = mysqli_query($conectar, "SELECT iva FROM configuracion");
    $result_iva = mysqli_num_rows($query_iva);
    $query_detalle_temp = mysqli_query($conectar, "CALL add_detalle_temp ($codproducto,$cantidad,'$token')");
    $result = mysqli_num_rows($query_detalle_temp);

    $detalleTabla = '';
    $sub_total = 0;
    $iva = 0;
    $total = 0;
    $arrayData = array();
    if ($result > 0) {
        
    if ($result_iva > 0) {
      $info_iva = mysqli_fetch_assoc($query_iva);
      $iva = $info_iva['iva'];
    }
    while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
      $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
      $sub_total = round($sub_total + $precioTotal, 2);
      $total = round($total + $precioTotal, 2);

        $detalleTabla .='<tr>
            <td>'.$data['codproducto'].'</td>
            <td colspan="2">'.$data['descripcion'].'</td>
            <td class="textcenter">'.$data['cantidad'].'</td>
            <td class="textright">'.$data['precio_venta'].'</td>
            <td class="textright">'.$precioTotal.'</td>
            <td>
                <a href="#" class="btn btn-danger" onclick="event.preventDefault(); del_product_detalle('.$data['correlativo'].');"><i class="fas fa-trash-alt"></i> Eliminar</a>
            </td>
        </tr>';
    }
    $impuesto = round($sub_total / $iva, 2);
    $tl_sniva = round($sub_total - $impuesto, 2);
    $total = round($tl_sniva + $impuesto, 2);
    $detalleTotales ='<tr>
        <td colspan="5" class="textright">Sub_Total S/.</td>
        <td class="textright">'.$impuesto.'</td>
    </tr>
    <tr>
        <td colspan="5" class="textright">IVA ('.$iva.'%)</td>
        <td class="textright">'. $tl_sniva.'</td>
    </tr>
    <tr>
        <td colspan="5" class="textright">Total S/.</td>
        <td class="textright">'.$total.'</td>
    </tr>';
    $arrayData['detalle'] = $detalleTabla;
    $arrayData['totales'] = $detalleTotales;
    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
  }else {
    echo 'error';
  }
  mysqli_close($conectar);

  }
  exit;
}

// extrae datos del detalle tem
if ($_POST['action'] == 'searchForDetalle') {

  if (empty($_POST['user'])){
    echo 'error';
  }else {
    $token = md5($_SESSION['idUser']);

    $query = mysqli_query($conectar, "SELECT tmp.correlativo, tmp.token_user,
      tmp.cantidad, tmp.precio_venta, p.idproducto, p.descripcion
      FROM detalle_temp tmp INNER JOIN productos p ON tmp.codproducto = p.idproducto
      where token_user = '$token'");
    $result = mysqli_num_rows($query);

    $query_iva = mysqli_query($conectar, "SELECT iva FROM configuracion");
    $result_iva = mysqli_num_rows($query_iva);


    $detalleTabla = '';
    $sub_total = 0;
    $iva = 0;
    $total = 0;
    $data = "";
    $arrayDatadata = array();
    if ($result > 0) {
    if ($result_iva > 0) {
      $info_iva = mysqli_fetch_assoc($query_iva);
      $iva = $info_iva['iva'];
    }
    while ($data = mysqli_fetch_assoc($query)) {
      $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
      $sub_total = round($sub_total + $precioTotal, 2);
      $total = round($total + $precioTotal, 2);

        $detalleTabla .= '<tr>
            <td>'.$data['codproducto'].'</td>
            <td colspan="2">'.$data['descripcion'].'</td>
            <td class="textcenter">'.$data['cantidad'].'</td>
            <td class="textright">'.$data['precio_venta'].'</td>
            <td class="textright">'.$precioTotal.'</td>
            <td>
                <a href="#" class="link_delete" onclick="event.preventDefault(); del_product_detalle('.$data['correlativo'].');"><i class="fas fa-trash-alt"></i> Eliminar</a>
            </td>
        </tr>';
    }
    $impuesto = round($sub_total / $iva, 2);
    $tl_sniva = round($sub_total - $impuesto, 2);
    $total = round($tl_sniva + $impuesto, 2);

    $detalleTotales = '<tr>
        <td colspan="5" class="textright">Sub_Total S/.</td>
        <td class="textright">'.$impuesto.'</td>
    </tr>
    <tr>
        <td colspan="5" class="textright">IVA ('.$iva.')</td>
        <td class="textright">'. $tl_sniva.'</td>
    </tr>
    <tr>
        <td colspan="5" class="textright">Total S/.</td>
        <td class="textright">'.$total.'</td>
    </tr>';

    $arrayData['detalle'] = $detalleTabla;
    $arrayData['totales'] = $detalleTotales;

    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
    exit;
  }else {
    $data = 0;
    exit;
  }
  mysqli_close($conectar);

  }
  exit;
}

// extrae datos del detalle temp
if ($_POST['action'] == 'delProductoDetalle') {
  if (empty($_POST['id_detalle'])){
    echo 'error';
  }else {
    $id_detalle = $_POST['id_detalle'];
    $token = md5($_SESSION['idUser']);


    $query_iva = mysqli_query($conectar, "SELECT iva FROM configuracion");
    $result_iva = mysqli_num_rows($query_iva);

    $query_detalle_tmp = mysqli_query($conectar, "CALL del_detalle_temp($id_detalle,'$token')");
    $result = mysqli_num_rows($query_detalle_tmp);

    $detalleTabla = '';
    $sub_total = 0;
    $iva = 0;
    $total = 0;
      $data = "";
    $arrayDatadata = array();
    if ($result > 0) {
    if ($result_iva > 0) {
      $info_iva = mysqli_fetch_assoc($query_iva);
      $iva = $info_iva['iva'];
    }
    while ($data = mysqli_fetch_assoc($query_detalle_tmp)) {
      $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
      $sub_total = round($sub_total + $precioTotal, 2);
      $total = round($total + $precioTotal, 2);

        $detalleTabla .= '<tr>
            <td>'.$data['codproducto'].'</td>
            <td colspan="2">'.$data['descripcion'].'</td>
            <td class="textcenter">'.$data['cantidad'].'</td>
            <td class="textright">'.$data['precio_venta'].'</td>
            <td class="textright">'.$precioTotal.'</td>
            <td>
                <a href="#" class="link_delete" onclick="event.preventDefault(); del_product_detalle('.$data['correlativo'].');">Eliminar</a>
            </td>
        </tr>';
    }
    $impuesto = round($sub_total / $iva, 2);
    $tl_sniva = round($sub_total - $impuesto, 2);
    $total = round($tl_sniva + $impuesto, 2);

    $detalleTotales = '<tr>
        <td colspan="5" class="textright">Sub_Total S/.</td>
        <td class="textright">'.$impuesto.'</td>
    </tr>
    <tr>
        <td colspan="5" class="textright">IVA ('.$iva.')</td>
        <td class="textright">'. $tl_sniva.'</td>
    </tr>
    <tr>
        <td colspan="5" class="textright">Total S/.</td>
        <td class="textright">'.$total.'</td>
    </tr>';

    $arrayData['detalle'] = $detalleTabla;
    $arrayData['totales'] = $detalleTotales;

    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
  }else {
    $data = 0;
  }
  mysqli_close($conectar);

  }
  exit;
}

// Anular Ventas
if ($_POST['action'] == 'anularVenta') {
    $data = "";
  $token = md5($_SESSION['idUser']);
  $query_del = mysqli_query($conectar, "DELETE FROM detalle_temp WHERE token_user = '$token'");
  mysqli_close($conectar);
  if ($query_del) {
    echo 'ok';
  }else {
    $data = 0;
  }
  exit;
}


//procesarVenta
if ($_POST['action'] == 'procesarVenta') {
  if (empty($_POST['codcliente'])) {
    $codcliente = 1;
  }else{
    $codcliente = $_POST['codcliente'];

    $token = md5($_SESSION['idUser']);
    $usuario = $_SESSION['idUser'];
    $query = mysqli_query($conectar, "SELECT * FROM detalle_temp WHERE token_user = '$token' ");
    $result = mysqli_num_rows($query);
  }

  if ($result > 0) {
    $query_procesar = mysqli_query($conectar, "CALL procesar_venta($usuario,$codcliente,'$token')");
    $result_detalle = mysqli_num_rows($query_procesar);
    if ($result_detalle > 0) {
      $data = mysqli_fetch_assoc($query_procesar);
      echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }else {
      echo "error";
    }
  }else {
    echo "error";
  }
  mysqli_close($conectar);
  exit;
}

// Cambiar contraseña
if ($_POST['action'] == 'changePasword') {
  if (!empty($_POST['passActual']) && !empty($_POST['passNuevo'])) {
    $password = md5($_POST['passActual']);
    $newPass = md5($_POST['passNuevo']);
    $idUser = $_SESSION['idUser'];
    $code = '';
    $msg = '';
    $arrayData = array();
    $query_user = mysqli_query($conectar, "SELECT * FROM usuarios WHERE contrasena = '$password' AND idusuario = $idUser");
    $result = mysqli_num_rows($query_user);
    if ($result > 0) {
      $query_update = mysqli_query($conectar, "UPDATE usuarios SET contrasena = '$newPass' where idusuario = $idUser");
      mysqli_close($conectar);
      if ($query_update) {
        $code = '00';
        $msg = "Su contraseña se ha actualizado con exito";
        header("Refresh:1; URL=salir.php");
      }else {
        $code = '2';
        $msg = "No es posible actualizar su contraseña";
      }
    }else {
      $code = '1';
      $msg = "La contraseña actual es incorrecta";
    }
    $arrayData = array('cod' => $code, 'msg' => $msg);
    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
  }else {
    echo "error";
  }
  exit;
  }

}
exit;
?>